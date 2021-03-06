<?php
namespace app\admin\controller;
use think\Validate;
use mpdf\mPDF;
use think\db\Query;

class Delivery extends Base {
    
    protected $rule = [
        'order_id' => 'require',
        'order_dn' => 'require',
        'delivery_date' => 'require',
        'po_sn' => 'require',
        //'purchase_date' => 'require',
        //'purchase_money' => 'require',
        'order_sn' => 'require',
        'cus_name' => 'require',
        'contacts' => 'require',
        'contacts_tel' => 'require',
        'delivery_address' => 'require',
        'delivery_sn' => 'require',
        'delivery_way' => 'require',
        'delivery_driver' => 'require',
        'driver_tel' => 'require',
    ];
    
    protected $message = [
        'order_id.require' => '订单ID不能为空',
        'order_dn.require' => '送货单号不能为空',
        'delivery_date.require' => '送货日期不能为空',
        'po_sn.require' => '采购单不能为空',
        //'purchase_date.require' => '采购日期不能为空',
        //'purchase_money.require' => '采购金额不能为空',
        'order_sn.require' => '关联订单不能为空',
        'cus_name.require' => '送货公司不能为空',
        'contacts.require' => '联系人不能为空',
        'contacts_tel.require' => '联系电话不能为空',
        'delivery_address.require' => '送货地址不能为空',
        'delivery_sn.require' => '物流单号不能为空',
        'delivery_way.require' => '交货方式不能为空',
        'delivery_driver.require' => '司机不能为空',
        'driver_tel.require' => '司机电话不能为空',
    ];
    
    protected $scene = [
        'add' => [],
        'edit' => ['delivery_date',//'purchase_money',
            'cus_name','contacts','contacts_tel',
            'delivery_address','delivery_sn','delivery_way',
            'delivery_driver','driver_tel']
    ];
    
    public function index(){
        $cus_name = $this->request->param('cus_name');
        $start_time = strtotime($this->request->param('start_time'));
        $end_time = strtotime($this->request->param('end_time'));
        $db = db('delivery_order do');
        $db->where(['do.status' => ['neq','-1']]);
        if (!empty($cus_name)) {
            $db->where(['do.cus_name' => ['like',"%{$cus_name}%"]]);
        }
        if ($start_time && $end_time){
            $end_time = strtotime($this->request->param('end_time').' 23:59:59');
            $db->where(['do.create_time' => ['>=',$start_time]]);
            $db->where(['do.create_time' => ['<=',$end_time]]);
        }
        $result = $db->join('__DELIVERY_GOODS__ dg','do.id=dg.delivery_id')
		             ->join('__ORDER__ or','do.order_id=or.id')
        ->field('do.*,or.company_short,dg.goods_name,dg.unit,dg.current_send_number,dg.add_number')
        ->order('do.create_time desc')->paginate(config('page_size'),FALSE,['query' => $this->request->param()]);
        
        $this->assign('page',$result->render());
        $this->assign('list',$result);
        $this->assign('current_page', $result->getCurrentPage());
        $this->assign('total_page', $result->lastPage());
        $this->assign('params', $this->request->query());
        if ($this->request->isMobile()){
        	$this->assign('title','送货管理');
        	if ($this->request->isAjax()) {
        	    if (empty($result)) $this->success('ok','');
        	    return $this->fetch('load');
        	}
        }else{
        	$this->assign('title','送货单');
        }
        return $this->fetch();
    }
    
    public function info(){
        $id = $this->request->param('id',0,'intval');
        if ($id <= 0) $this->error('参数错误');
		//$delivery_order =db('delivery_order do')->join('__ORDER__ o','do.order_id=o.id')->where(['do.id' => $id])->find();
       $delivery_order = db('delivery_order do')->where(['id' => $id])->find();
		
        if (empty($delivery_order)) $this->error('送货单不存在');
//         $goods_info = db('delivery_order d')->where(['d.delivery_id' => $id])
//           ->join('__DELIVERY_GOODS__ dg','d.id=dg.delivery_id')
//         ->join('__GOODS__ g','dg.goods_id=g.goods_id')
//         ->join('__GOODS_CATEGORY__ gc','g.category_id=gc.category_id')
//         ->field($field)->paginate(config('page_size'));

        //管理订单表获取客户订单号
        $cus_order_sn = db('order')->where(['id' => $delivery_order['order_id']])->value('cus_order_sn'); 
		
        $goods_info = db('delivery_goods')->where(['delivery_id' => $id])->select();
        
        $db = db('order_goods og');
        $db->where(['og.order_id' => $delivery_order['order_id']]);
        $db->join('__GOODS__ g','og.goods_id=g.goods_id');
        $db->join('__GOODS_CATEGORY__ gc','g.category_id=gc.category_id');
        $goodslist = $db->field('og.*,g.store_number,gc.category_name')->select();
        
		$templist = [];
        $totalMoney = 0;
        foreach ($goodslist as $key => $value){
        	$value['diff_number'] = $value['goods_number'] - $value['send_num']; //未交数量
            foreach ($goods_info as $val){
                if ($value['goods_id'] == $val['goods_id']){
                	$value['current_send_number'] = $val['current_send_number']; //本次送货数量
                	$value['add_number'] = $val['add_number']; //入库数量
                	$value['remark'] = $val['remark'];
                	$templist[] = $value;
                }
            }
            $totalMoney += $value['goods_number']*$value['goods_price'];
        }
        
        $input_sn = db('input_store')->where(['id' => ['in',$delivery_order['relation_input_id']]])
        ->field('store_sn')->select();
        $input_sn_list = '';
        foreach ($input_sn as $value){
        	$input_sn_list .= $value['store_sn'].',';
        }
        $input_sn_list = trim($input_sn_list,',');
        $delivery_order['input_sn_list'] = $input_sn_list;
        
        $this->assign('goodslist',json_encode($templist));
        $this->assign('goodslistArr',$templist);
        $this->assign('delivery',$delivery_order);
		$this->assign('cus_order_sn',$cus_order_sn);
        $this->assign('title','送货单详情');
        return $this->fetch();
    }
    
    public function input_order(){
    	//$order_id = $this->request->param('order_id',0,'intval');
    	//if ($order_id <= 0) $this->error('参数错误');
    	$cus_order_sn = $this->request->param('cus_order_sn');
    	$supplier_name = $this->request->param('supplier_name');
    	$goods_name = $this->request->param('goods_name');
    	$category_id = $this->request->param('category_id',0,'intval');
    	$db = db('input_goods ig');
    	$db->join('__INPUT_STORE__ i','i.id=ig.input_id');
    	$db->join('__SUPPLIER__ s','i.supplier_id=s.id');
    	$db->join('__GOODS__ g','ig.goods_id=g.goods_id');
    	$db->join('__PURCHASE__ p','i.po_id=p.id');
    	if ($cus_order_sn != '') {
    	    $db->where(['p.cus_order_sn' => ['like',"%{$cus_order_sn}%"]]);
    	}
    	if ($supplier_name != '') {
    	    $db->where('s.supplier_name|s.supplier_short','like',"%{$supplier_name}%");
    	}
    	if ($goods_name != '') {
    	    $db->where('ig.goods_name','like',"%{$goods_name}%");
    	}
    	if ($category_id > 0) {
    	    $db->where(['g.category_id' => $category_id]);
    	}
    	//$db->where(['i.is_cancel' => 0]);
    	$db->where('i.is_cancel=0 and (ig.goods_number>ig.out_number)');
    	$db->field('i.*,p.order_id,p.delivery_type,p.cus_order_sn,g.category_id,ig.goods_id,ig.goods_name,ig.goods_price,ig.unit,ig.goods_number,ig.out_number,ig.remark,s.supplier_name,s.supplier_short');
    	$result = $db->order('i.create_time asc')->paginate(config('page_size'),false,['query' => $this->request->param()]);
    	$data = $result->all();
    	$categoryModel = db('goods_category');
    	$purchaseGoods = db('purchase_goods');
    	foreach ($data as $key => $value) {
    	    $data[$key]['category_name'] = $categoryModel->where(['category_id' => $value['category_id']])->value('category_name');
    	    $data[$key]['purchase_number'] = $purchaseGoods->where(['purchase_id' => $value['po_id'],'goods_id' => $value['goods_id']])->value('goods_number');
    	    $data[$key]['create_format_date'] = date('Y-m-d H:i:s',$value['create_time']);
    	}
    	$cate_lists = db('goods_category')->select();
    	$this->assign('lists',$cate_lists);
    	$this->assign('page',$result->render());
    	$this->assign('data',$data);
    	$this->assign('pojson',json_encode($data));
    	$this->assign('current_page', $result->getCurrentPage());
    	$this->assign('total_page', $result->lastPage());
    	$this->assign('query', $this->request->query());
    	$this->assign('title','查找入库单');
    	if ($this->request->isMobile() && $this->request->isAjax()){
    		$this->success('','', $data);
    	}
    	return $this->fetch();
    }
    
    public function delete(){
        if ($this->request->isAjax()){
            $id = $this->request->param('id',0,'intval');
            if ($id <= 0) $this->error('参数错误');
            if (db('delivery_order')->where(['id' => $id])->setField('status','-1')){
                db('delivery_goods')->where(['delivery_id' => $id])->delete();
                $this->success('删除成功');
            }
            $this->error('删除失败');
        }
    }
    
    public function confirm(){
        if ($this->request->isAjax()){
            $id = $this->request->param('id',0,'intval');
            if ($id <= 0) $this->error('参数错误');
            $delivery_order = db('delivery_order')->where(['id' => $id])->find();
            if (empty($delivery_order)) $this->error('送货单不存在');
            $order = db('order')->where(['id' => $delivery_order['order_id']])->find();
            $delivery_goods = db('delivery_goods')->where(['delivery_id' => $id])->select();
            /*
            $purchase_goods = db('purchase_goods')->where(['purchase_id' => $delivery_order['purchase_id']])->select();
            foreach ($delivery_goods as $key => $value){
                foreach ($purchase_goods as $k => $val){
                	if ($value['goods_id'] == $val['goods_id']){
	                    if ($value['current_send_number'] + $value['add_number'] > $val['goods_number'] - $val['send_num']){
	                        $this->error('“'.$value['goods_name'].'”大于采购单的未交数量');
	                    }
                	}
                }
            }
            */
            $goods_info = $this->request->post('goods_info/a');
            foreach ($goods_info as $key => $value){
            	if ($value['current_send_number'] <= 0){
            		$this->error('“'.$value['goods_name'].'”本次送货数量不能小于1');
            	}
            	if ($value['current_send_number'] != $value['add_number']){
            		$this->error('“'.$value['goods_name'].'”出库数量和本次出货数量必须等于！');
            	}
            }
            
            if ($value['current_send_number'] <= 0){
            	$this->error('“'.$value['goods_name'].'”本次送货数量不能小于1');
            }
            if ($value['current_send_number'] != $value['add_number']){
            	$this->error('“'.$value['goods_name'].'”出库数量和本次出货数量必须等于！');
            }
            
            db()->startTrans();
            if (db('delivery_order')->where(['id' => $id])->setField('is_confirm',1)){
                //1入库，2出库，3报溢，4报损
                $failed_row = 0;
                $tempInput = [];
                $tempInputNumber = [];
                foreach ($delivery_goods as $key => $value){
                    db('store_log')->insert([
                        'goods_id' => $value['goods_id'],
                        'goods_name' => $value['goods_name'],
                        'delivery_id' => $id,
                    	'purchase_id' => $delivery_order['purchase_id'],
                        'order_id' => $delivery_order['order_id'],
                        'type' => 2,
                        'number' => $value['current_send_number'],
                        'create_time' => time()
                    ]);
                    if ($value['current_send_number'] > 0){
                    	//db('goods')->where(['goods_id' => $value['goods_id']])->setInc('store_number',$value['add_number']);
                    	//库存数量=5采购入库数量  - 2出库数量  + 3盘点报溢数量  - 4盘点报损数量
                    	$purchase_number = db('store_log')->where(['goods_id' => $value['goods_id'],'type' => 5])->sum('number');
                    	$out_number = db('store_log')->where(['goods_id' => $value['goods_id'],'type' => 2])->sum('number');
                    	$stocktaking_number = db('store_log')->where(['goods_id' => $value['goods_id'],'type' => 3])->sum('number');
                    	$inventory_loss_number = db('store_log')->where(['goods_id' => $value['goods_id'],'type' => 4])->sum('number');
                    	$store_number = $purchase_number-$out_number+$stocktaking_number-$inventory_loss_number;
                    	db('goods')->where(['goods_id' => $value['goods_id']])->setField('store_number',$store_number);
                    }
                    $a = db('order_goods')->where(['order_id' => $delivery_order['order_id'],'goods_id' => $value['goods_id']])->setInc('send_num',$value['current_send_number']);
                    $b = db('purchase_goods')->where(['purchase_id' => $delivery_order['purchase_id'],'goods_id' => $value['goods_id']])->setInc('send_num',$value['current_send_number']);
                    if (!$a || !$b){
                        $failed_row++;
                    }
                    $relation_input_arr = explode(',', $delivery_order['relation_input_id']);
                    //一个送货单商品多个入库单商品
                    foreach ($relation_input_arr as $k => $val){
                        //10 8
                        $that_goods = db('input_goods')->where(['input_id' => $val,'goods_id' => $value['goods_id']])->find();
                        if ($that_goods['goods_number'] < $value['current_send_number']){
                            db('input_goods')->where(['input_id' => $val,'goods_id' => $value['goods_id']])->setInc('out_number',$that_goods['goods_number']);
                        }else{
                        db('input_goods')->where(['input_id' => $val,'goods_id' => $value['goods_id']])->setInc('out_number',$value['current_send_number']);
                        }
                    }
                    
                }
                $order_goods = db('order_goods')->where(['order_id' => $delivery_order['order_id']])->select();
                $count = 0;
                foreach ($order_goods as $value){
                    if ($value['goods_number'] == $value['send_num']){
                        $count += 1;
                    }
                }
                if ($count == count($order_goods)){
                    $c = db('order')->where(['id' => $delivery_order['order_id']])->update(['status' => 2,'update_time' => time()]); //已送货
                }else{
                	$c = db('order')->where(['id' => $delivery_order['order_id']])->update(['status' => 6,'update_time' => time()]);//部分送货
                }
                
                $d = true;
                if (empty($order['deliver_time'])){
                	$d = db('order')->where(['id' => $delivery_order['order_id']])->setField('deliver_time',strtotime($delivery_order['delivery_date']));
                }
                
                //db()->rollback();
                
//              p($tempInput);
//              p($tempInputNumber);
                
                if ($failed_row == 0 && $c && $d){
                    db()->commit();
                    $this->success('确认成功');
                }else{
                    db()->rollback();
                    $this->error('确认失败，事务回滚...');
                }
            }
            db()->rollback();
            $this->error('确认失败，事务回滚...');
        }
    }
    
    public function edit(){
        if ($this->request->isAjax()){
            $data = $this->request->param();
            $validate = new Validate($this->rule,$this->message);
            $validate->scene('edit',$this->scene['edit']);
            if (!$validate->scene('edit')->check($data)){
                $this->error($validate->getError());
            }
            $update = [
                'id' => $data['id'],
                'delivery_date' => $data['delivery_date'],
                //'purchase_money' => $data['purchase_money'],
                'cus_name' => $data['cus_name'],
                'contacts' => $data['contacts'],
                'contacts_tel' => $data['contacts_tel'],
                'delivery_address' => $data['delivery_address'],
                'delivery_sn' => $data['delivery_sn'],
                'delivery_way' => $data['delivery_way'],
                'delivery_driver' => $data['delivery_driver'],
                'driver_tel' => $data['driver_tel'],
            	'order_remark' => $data['order_remark'],
                'update_time' => time()
            ];
            if (db('delivery_order')->where(['id' => ['neq',$data['id']],'delivery_sn' => $data['delivery_sn']])->find()){
                $this->error('送货单号已存在');
            }
            $goods_info = $this->request->param('goods_info/a');
            if (empty($goods_info)) $this->error('商品信息不能为空');
            foreach ($goods_info as $key => $value){
            	if ($value['goods_price'] <= 0){
            		$this->error('“'.$value['goods_name'].'”商品价格必须大于0');
            	}
            	if ($value['current_send_number'] <= 0){
            		$this->error('“'.$value['goods_name'].'”本次送货数量不能小于1');
            	}
            	if ($value['current_send_number'] != $value['add_number']){
            		$this->error('“'.$value['goods_name'].'”出库数量和本次出货数量必须等于！');
            	}
            }
            if (db('delivery_order')->update($update)){
                $delivery_id = $data['id'];
                $in = db('delivery_goods')->where(['delivery_id' => $delivery_id])->field('id')->select();
                $ids = [];
                foreach ($in as $val){
                    $ids[] = $val['id'];
                }
                $postIds = [];
                foreach ($goods_info as $value){
                    if (isset($value['id']) && intval($value['id']) > 0){
                        $postIds[] = $value['id'];
                    }
                }
                $tempArr = array_count_values(array_merge($ids,$postIds));
                foreach ($tempArr as $key => $count){
                    if ($count == 1){
                        db('delivery_goods')->where(['id' => $key,'delivery_id' => $delivery_id])->delete();
                    }
                }
                
                foreach ($goods_info as $key => $value){
                    db('delivery_goods')->where(['id' => $value['id'],'delivery_id' => $delivery_id])->update([
                        'goods_id' => $value['goods_id'],
                        'goods_name' => $value['goods_name'],
                        'goods_price' => $value['goods_price'],
                    	'unit' => $value['unit'],
                        'goods_attr' => $value['goods_attr'],
                        'current_send_number' => $value['current_send_number'],
                        'add_number' => $value['add_number'],
                        'remark' => $value['remark']
                    ]);
                }
                $this->success('保存成功',url('index'));
            }
            $this->error('保存失败');
            return;
        }
        $id = $this->request->param('id',0,'intval');
        if ($id <= 0) $this->error('参数错误');
        $delivery_order = db('delivery_order')->where(['id' => $id])->find();
        if (empty($delivery_order)) $this->error('送货单不存在');
        
        $goods_info = db('delivery_goods')->where(['delivery_id' => $id])->select();
        
        $db = db('order_goods og');
        $db->where(['og.order_id' => $delivery_order['order_id']]);
        $db->join('__GOODS__ g','og.goods_id=g.goods_id');
        $db->join('__GOODS_CATEGORY__ gc','g.category_id=gc.category_id');
        $goodslist = $db->field('og.*,g.store_number,gc.category_name')->select();
        $tempList = [];
        $totalMoney = 0;
        foreach ($goodslist as $key => $value){
        	$value['diff_number'] = $value['goods_number'] - $value['send_num']; //未交数量
            foreach ($goods_info as $val){
                if ($value['goods_id'] == $val['goods_id']){
                	$value['current_send_number'] = $val['current_send_number']; //本次送货数量
                	$value['add_number'] = $val['add_number']; //入库数量
                	$value['id'] = $val['id'];
                	$value['remark'] = $val['remark'];
                	$tempList[] = $value;
                }
            }
            $totalMoney += $value['goods_number']*$value['goods_price'];
        }
        $cus_order_sn = db('order')->where(['id' => $delivery_order['order_id']])->value('cus_order_sn');
        $this->assign('goodslist',json_encode($tempList));
        $delivery_order['cus_order_sn'] = $cus_order_sn;
        $input_sn = db('input_store')->where(['id' => ['in',$delivery_order['relation_input_id']]])
        ->field('store_sn')->select();
        $input_sn_list = '';
        foreach ($input_sn as $value){
        	$input_sn_list .= $value['store_sn'].',';
        }
        $input_sn_list = trim($input_sn_list,',');
        $delivery_order['input_sn_list'] = $input_sn_list;
        
        $this->assign('delivery',$delivery_order);
        $this->assign('title','编辑送货单');
        return $this->fetch();
    }
    
    private $send_email = '';
    
    public function prints(){
            $id = $this->request->param('id',0,'intval');
            if ($id <= 0) $this->error('参数错误');
            $delivery = db('delivery_order')->where(['id' => $id,'status' => ['neq','-1']])->find();
            if (empty($delivery)) $this->error('送货单不存在');
            $title = '送货单';
            $goodsInfo = db('delivery_goods')->where(['delivery_id' => $delivery['id']])->order('id asc')->select();
            $cus = db('customers')->where(['cus_id' => $delivery['cus_id']])->find();
            $this->assign('client',$cus);
            $this->assign('data',$delivery);
            
            //$this->send_email = $delivery['email'];
            
            if (!$delivery['is_print']){
                db('delivery_order')->where(['id' => $id])->setField('is_print',1);
            }
            $order = db('order')->where(['id' => $delivery['order_id']])->find();
            $mpdf = new mPDF('zh-CN/utf-8','A4', 0, '宋体', 0, 0);
            $mpdf->SetWatermarkText(getTextParams(14),0.1);
            $logo = getFileParams(12);
            if (empty($logo)) {
                $logo = './assets/img/crm_logo.png';
            }
            $strContent = '<div style="width:90%;margin:0 auto;height:90px;">';
            $strContent .= '<h1 style="padding-top:10px;text-align:center;font-size:32px;">'.getTextParams(14).'</h1>';
            $strContent .= '<p class="entitle" style="font-size:22px;">'.getTextParams(15).'</p>';
            $strContent .= '</div>';
            $strContent .= '<h2 style="text-align:center;padding:20px 0;">'.$title.'</h2>';
            
            $strContent .= '<table class="noborder">
<tbody>
    <tr>
    <td style="width:50%;">送货单号：'.$delivery['order_dn'].'</td>
	<td>客户订单号：'.$order['cus_order_sn'].'</td>
    </tr>
    <tr>
    <td style="width:50%;">送货时间：'.$delivery['delivery_date'].'</td>
    <td>下单时间：'.date('Y-m-d',$order['create_time']).'</td>
    </tr>
    <tr>
    <td style="width:50%">收货单位：'.$delivery['cus_name'].'</td>
    <td>收货人：'.$delivery['contacts'].'</td>
    </tr>
    <tr>
    <td style="width:50%;">联系电话：'.$delivery['contacts_tel'].'</td>
    <td>收货地址：'.$delivery['delivery_address'].'</td>
    </tr>
    <tr>
    <td style="width:50%;">送货司机：'.$delivery['delivery_driver'].'</td>
    <td>司机电话：'.$delivery['driver_tel'].'</td>
    </tr>
</tbody>
</table>';
            
            $strContent .= '<table class="table">
        <tbody>
            <tr>
            <td width="10%">序号</td>
            <td width="15%">产品名称</td>
			<td width="30%">产品规格</td>
            <td width="10%">单位</td>
			<td width="10%">数量</td>
            <td width="25%">备注</td>
            </tr>';
            $count_goods = 0;
            foreach ($goodsInfo as $k => $val){
                $count_goods += $val['current_send_number'];
                $goods_attr_text = '';
                $goods_attr = json_decode($val['goods_attr'],true);
                if (!empty($goods_attr)){
                    foreach ($goods_attr as $attr){
                        $goods_attr_text .= $attr['attr_value'].'&nbsp;';
                    }
                }
                $val['type_name'] = db('goods g')->join('__GOODS_TYPE__ gt','g.goods_type_id=gt.goods_type_id')
                ->where(['g.goods_id' => $val['goods_id']])->value('type_name');
                $strContent .= '<tr>
        <td>'.($k+1).'</td>
    <td>'.$val['type_name'].'</td>
	<td>'.$val['goods_name'].'</td>
    <td>'.$val['unit'].'</td>
<td>'.$val['current_send_number'].'</td>
<td>'.$val['remark'].'</td>
    </tr>
    ';
            }
            
            $strContent .= '</tbody></table>';
            $img = getFileParams(20);
            $strContentFooter = '<table class="noborder" style="margin-top:20px;height:100px;">
<tbody>
    <tr>
    <td width="10%" align="left">发货人签章：</td>
	<td width="30%" align="left"><img src="'.$img.'" alt="" width="100px"/></td>
    <td width="30%" align="left">承运人：</td>
    <td width="30%" align="left">客户签章：</td>
    </tr>
</tbody>
</table>';
            
            $mpdf->showWatermarkText = true;
            $mpdf->SetTitle($title);
            // 	   $mpdf->SetHTMLHeader( '头部' );
            //$mpdf->SetHTMLFooter( $strContentFooter );
            $stylesheet='
body{padding:0;margin:0;font-family:"宋体";}
h1,h2,h3,p,div,span{padding:0;margin:0;}
.entitle{text-align:center;}
.noborder{font-size: 13px;background: #FFF;width:95%;margin: 0 auto;border-spacing: 0;border-collapse: collapse;}
.noborder tbody tr td{padding:5px 0;}
.table{
    width:95%;
    margin: 0 auto;
    border-spacing: 0;
    border-collapse: collapse;
}
.table{
    background: #FFF;
    font-size: 12px;
    border-top: 1px solid #000;
    margin-top: 8px;
    border: 1px solid #000;
}
.table tbody tr td{
    padding: 12px 8px;
    border-top: 0px;
    border-bottom: 1px solid #000;
    border-right: 1px solid #000;
    vertical-align: middle;
}
';
            $mpdf->WriteHTML($stylesheet, 1);
            $mpdf->WriteHTML($strContent.$strContentFooter);
            $type = 0;
            if ($type == 1){
                $savePath = './pdf/P'.str_replace('/', '-', $order['order_sn']).'.pdf';
                $mpdf->Output($savePath,'F');
                return $savePath;
            }
         $mpdf->Output();
         exit;
    }
    
    public function add(){
        if ($this->request->isAjax()){
            $data = $this->request->param();
            $validate = new Validate($this->rule,$this->message);
            if (!$validate->check($data)){
                $this->error($validate->getError());
            }
            $goods_info = $this->request->param('goods_info/a');
            if (empty($goods_info)) $this->error('商品信息不能为空');
            foreach ($goods_info as $key => $value){
            	if ($value['current_send_number'] <= 0){
            		$this->error('“'.$value['goods_name'].'”本次送货数量不能小于1');
            	}
            	if ($value['current_send_number'] != $value['out_number']){
            	    $this->error('“'.$value['goods_name'].'”出库数量和本次出货数量必须等于！');
            	}
            }
            $data['relation_input_id'] = $data['input_id'];
            unset($data['input_id'],$data['input_sn'],$data['goods_info'],$data['type'],$data['current_send_number'],$data['remark'],$data['out_number']);
            $data['admin_uid'] = $this->userinfo['id'];
            $data['create_time'] = time();
            $data['update_time'] = time();
            if (db('delivery_order')->where(['delivery_sn' => $data['delivery_sn']])->find()){
                $this->error('物流单号已存在');
            }
            $isExist = db('delivery_order')->where(['order_dn' => $data['order_dn']])->find();
            if (!empty($isExist)){
                //$this->error('送货单号已存在');
            	$data['order_dn'] = self::create_sn('DN', 'delivery_order');
            }
            db()->startTrans();
            $delivery_id = db('delivery_order')->insertGetId($data);
            if ($delivery_id){
                $success_num = 0;
                foreach ($goods_info as $key => $value){
                    if(db('delivery_goods')->insert([
                        'delivery_id' => $delivery_id,
                        'goods_id' => $value['goods_id'],
                        'goods_name' => $value['goods_name'],
                    	'goods_price' => $value['goods_price'],
                        'unit' => $value['unit'],
                        'goods_attr' => $value['goods_attr'],
                        'current_send_number' => $value['current_send_number'],
                        'add_number' => $value['out_number'],
                        'remark' => $value['remark']
                    ])){
                    	/*
                        $store_log = db('store_log')->insert([
                            'goods_id' => $value['goods_id'],
                            'goods_name' => $value['goods_name'],
                            'type' => 1,
                            'number' => $value['out_number'],
                            'create_time' => time()
                        ]);
                        $update_send_num = db('order_goods')->where(['goods_id' => $value['goods_id'],'order_id' => $data['order_id']])
                        ->setInc('send_num',$value['out_number']);
                        
                        if ($update_send_num && $store_log){
                            $success_num++;
                        }else{
                            db()->rollback();
                            $this->error('保存失败');
                        }
                        */
                    	$success_num++;
                    }
                }
                if ($success_num == count($goods_info)) {
                    db()->commit();
                    $this->success('保存成功',url('index'));
                }
            }
            db()->rollback();
            $this->error('保存失败');
            return;
        }
        $this->assign('title','送货单');
        $this->assign('order_dn',self::create_sn('DN', 'delivery_order'));
        return $this->fetch();
    }
    
    public function search_purchase(){
		$cus_order_sn = $this->request->param('cus_order_sn');
        $supplier_name = $this->request->param('supplier_name');
        $start_time = $this->request->param('start_date');
        $end_time = $this->request->param('end_date');
        $db = db('purchase p');
        $db->field('p.*,p.id as purchase_id,s.supplier_name,s.supplier_short,pg.unit,pg.goods_price,pg.goods_id,pg.send_num,pg.goods_number,pg.goods_name');
        $where = ['p.status' => ['>=','1']];
		
		if ($cus_order_sn != ''){
            $db->where('p.cus_order_sn','like',"%{$cus_order_sn}%");
        }
		
        if ($supplier_name != ''){
            $db->where('s.supplier_short|s.supplier_name','like',"%{$supplier_name}%");
        }
		
        $db->where($where);
        if ($start_time != '' && $end_time != ''){
            $start_time = strtotime($start_time);
            $end_time = strtotime($end_time.' 23:59:59');
            if ($start_time && $end_time){
                $db->where("p.create_time",'>=',$start_time);
                $db->where("p.create_time",'<=',$end_time);
            }
        }
        $db->join('__PURCHASE_GOODS__ pg','p.id=pg.purchase_id');
        //$db->join('__ORDER_GOODS__ og','pg.goods_id=og.goods_id AND og.order_id=p.order_id');
        $db->where("(pg.goods_number-pg.send_num) > 0");
        $db->join('__SUPPLIER__ s','p.supplier_id=s.id');
        //$db->join('__ORDER__ o','o.id=p.order_id');
        $result = $db->order('p.create_time desc')->paginate(config('PAGE_SIZE'), false, ['query' => $this->request->param() ]);
        $data = $result->all();
        foreach ($data as $key => $value){
            $category_name = db('goods g')->join('__GOODS_CATEGORY__ gc','gc.category_id=g.category_id')->where(['g.goods_id' => $value['goods_id']])->value('gc.category_name');
            $data[$key]['category_name'] = $category_name;
            $data[$key]['purchase_date'] = date('Y-m-d',$value['create_time']);
            if (!$value['create_type']){
                $require_time = db('order')->where(['id' => $value['order_id']])->value('require_time');
                $data[$key]['require_time'] = date('Y-m-d',$require_time);
            }else{
                $data[$key]['require_time'] = '--';
            }
			
			//added by wei on 2018-9-30 beign
			
			 $data[$key]['cus_name'] = $value['delivery_company'];
			 $data[$key]['contacts'] = $value['receiver'];
			 $data[$key]['contacts_tel'] = $value['receivernum'];
			
			//end
			
        }
        
        //og.send_num,o.order_sn,o.require_time
        
        $this->assign('page',$result->render());
        $this->assign('data',$data);
        $this->assign('pojson',json_encode($data));
        return $this->fetch();
    }
    
    public function relation_order(){
    	$purchase_id = $this->request->param('purchase_id',0,'intval');
    	$purchase = db('purchase')->where(['id' => $purchase_id])->find();
        $supplier_name = $this->request->param('supplier_name');
        $cus_order_sn = $this->request->param('cus_order_sn');
        $start_time = $this->request->param('start_date');
        $end_time = $this->request->param('end_date');
        $db = db('order o');
        $db->field('o.*,o.id as orderid,og.*');
        //$where = ['o.is_create' => 1,'o.status' => ['>=',1]];
        $where = "o.status=1 OR o.status=5 OR o.status=6";
        if ($supplier_name != ''){
            $db->where('o.company_short|o.company_name','like',"%{$supplier_name}%");
        }
        if ($cus_order_sn != ''){
            $db->where(['o.cus_order_sn' => ['like',"%{$cus_order_sn}%"]]);
        }
        //判断采购单是否取消关联订单
        //if ($purchase['is_cancel']){
        //	$db->where(['o.id' => ['neq',$purchase['order_id']]]);
        //}
        $db->where($where);
        if ($start_time != '' && $end_time != ''){
            $start_time = strtotime($start_time);
            $end_time = strtotime($end_time.' 23:59:59');
            if ($start_time && $end_time){
                $db->where("o.require_time",'>=',$start_time);
                $db->where("o.require_time",'<=',$end_time);
            }
        }
        
        $db->join('__ORDER_GOODS__ og','o.id=og.order_id');
        $db->where("(og.goods_number-og.send_num) > 0");
        $result = $db->paginate(config('PAGE_SIZE'), false, ['query' => $this->request->param() ]);
        $data = $result->all();
        foreach ($data as $key => $value){
            $category_name = db('goods g')->join('__GOODS_CATEGORY__ gc','gc.category_id=g.category_id')->where(['g.goods_id' => $value['goods_id']])->value('gc.category_name');
            $data[$key]['category_name'] = $category_name;
            $data[$key]['require_time'] = date('Y-m-d',$value['require_time']);
            $data[$key]['purchase_date'] = date('Y-m-d',$value['create_time']);
            $data[$key]['diff_number'] = $value['goods_number'] - $value['send_num'];
            $data[$key]['show_input'] = true;
        }
        $this->assign('page',$result->render());
        $this->assign('data',$data);
        $this->assign('pojson',json_encode($data));
        if ($this->request->isMobile() && $this->request->isAjax()) {
        	$this->success('ok','',$data);
        }
        $this->assign('current_page', $result->getCurrentPage());
        $this->assign('total_page', $result->lastPage());
        $this->assign('query', $this->request->query());
        $this->assign('title','查找订单');
        return $this->fetch();
    }
    
    public function goods_merge(){
        $order_id = $this->request->param('order_id');
        $input_id = $this->request->param('input_id');
        $po_id = $this->request->param('po_id');
        $order_goods = db('order_goods')->where(['order_id' => $order_id])->order('id asc')->select();
        $input_goods = db('input_goods')->where(['input_id' => ['in',$input_id]])->order('id asc')->select();

        $goods_list = [];
        foreach ($order_goods as $key => $value){
        	$value['diff_number'] = $value['goods_number'] - $value['send_num'];
        	$value['current_send_number'] = $value['goods_number'] - $value['send_num'];
            foreach ($input_goods as $k => $val) {
                if ($value['goods_id'] == $val['goods_id']) {
                	$value['input_number'] = $val['goods_number']-$val['out_number'];
                    $goods_list[$value['goods_id']] = $value;
                }
            }
        }

        $goods_db = db('goods g');
        foreach ($goods_list as $key => $value) {
        	$goodsInfo = $goods_db->join('__GOODS_CATEGORY__ gc','g.category_id=gc.category_id')
            ->where(['g.goods_id' => $value['goods_id']])->field('g.store_number,gc.category_name')->find();
            $goods_list[$key]['show_input'] = true;
            $goods_list[$key]['category_name'] = $goodsInfo['category_name'];
            $store_number = $goodsInfo['store_number'];
            
            //库存数量大于未交货数量，本次送货数量和出库数量就是未交货数量
            if ($store_number >= $value['diff_number']){
                $goods_list[$key]['out_number'] = $value['input_number'];
                $goods_list[$key]['current_send_number'] = $value['input_number'];
            }else{
            	//库存数量小于未交货数量，本次送货数量和出库数量就是实际库存数量
                $goods_list[$key]['out_number'] = $store_number;
                $goods_list[$key]['current_send_number'] = $store_number;
            }
            
        }
        
        $this->ajaxReturn($goods_list);
    }
    
    public function rel_order(){
        if ($this->request->isAjax()){
        	$purchase_id = $this->request->param('purchase_id',0,'intval');
        	//$purchase = db('purchase')->where(['id' => $purchase_id])->find();
        	//if (empty($purchase)) $this->error('参数错误');
            $order_id = $this->request->param('order_id',0,'intval');
            $order = db('order')->where(['id' => $order_id])->find();
            if (empty($order)) $this->error('订单不存在');
            $db = db('order_goods og');
            $db->where(['og.order_id' => $order_id]);
            $db->join('__GOODS__ g','og.goods_id=g.goods_id');
            $db->join('__GOODS_CATEGORY__ gc','g.category_id=gc.category_id');
            $goodslist = $db->field('og.*,g.store_number,gc.category_name')->select();
            
            $totalMoney = 0;
            /*
            $purchase_goods = db('purchase_goods')->where(['purchase_id' => $purchase_id])->select();
            if ($purchase['create_type'] == 1){
            	$templist = [];
            	foreach ($goodslist as $key => $value){
            		foreach ($purchase_goods as $k => $val){
            			if ($value['goods_id'] == $val['goods_id']){
            				$value['goods_number'] = $val['goods_number'];
            				$diff_number = $val['goods_number'] - $val['send_num']; //订单未交数量
            				$value['diff_number'] = $diff_number;
            				$value['current_send_number'] = $diff_number; //本次送货数量
            				$value['add_number'] = 0; //入库数量
            				$value['show_input'] = true;
            				$value['purchase_number'] = $val['goods_number']-$val['send_num']; //采购单;
            				$templist[] = $value;
            				$totalMoney += $val['goods_number']*$value['goods_price'];
            			}
            		}
            	}
            	$goodslist = $templist;
            }else{
            	if (empty($purchase_goods)){
		            foreach ($goodslist as $key => $value){
		            	$diff_number = $value['goods_number'] - $value['send_num'];
		                $goodslist[$key]['diff_number'] = $diff_number; //未交数量
		                $goodslist[$key]['current_send_number'] = $diff_number; //本次送货数量
		                $goodslist[$key]['add_number'] = 0; //入库数量
		                $goodslist[$key]['show_input'] = true;
		                $goodslist[$key]['purchase_number'] = $value['goods_number'];
		                $totalMoney += $value['goods_number']*$value['goods_price'];
		            }
            	}else{
            		$templist = [];
            		foreach ($goodslist as $key => $value){
            			foreach ($purchase_goods as $k => $val){
            				if ($value['goods_id'] == $val['goods_id']){
		            			$diff_number = $value['goods_number'] - $value['send_num'];
		            			$value['diff_number'] = $diff_number; //订单未交数量
		            			$value['current_send_number'] = $diff_number; //本次送货数量
		            			$value['add_number'] = 0; //入库数量
		            			$value['purchase_number'] = $val['goods_number']-$val['send_num']; //采购单;
		            			$value['show_input'] = true;
		            			$templist[] = $value;
		            			$totalMoney += $value['goods_number']*$value['goods_price'];
            				}
            			}
            		}
            		$goodslist = $templist;
            	}
            }
            */
            
            $data['total_money'] = _formatMoney($totalMoney);
            
            $cus = db('customers')->where(['cus_id' => $order['cus_id']])->find();
            $data['delivery_address'] = $cus['cus_prov'].$cus['cus_city'].$cus['cus_dist'].$cus['cus_street'];
            $data['cus_phome'] = $cus['cus_mobile'];
            $data['contacts_tel'] = $cus['cus_phome'];
            $data['contacts'] = $order['contacts'];
            $data['order_sn'] = $order['order_sn'];
            
            $data['goodslist'] = $goodslist;
            $data['cus_name'] = $order['company_name'];
            $data['cus_id'] = $order['cus_id'];
            $data['cus_order_sn'] = $order['cus_order_sn'];
            
            $this->success('','',$data);
        }
    }
    
    public function order(){
        if ($this->request->isAjax()){
            $purchase_id = $this->request->param('purchase_id',0,'intval');
            $purchase = db('purchase')->where(['id' => $purchase_id,'is_cancel' => 0])->find();
            if (empty($purchase)) $this->error('该采购单已取消关联订单，请选择关联订单');
            if ($purchase['create_type'] == 1) $this->error('请选择关联订单');
            $purchase_goods = db('purchase_goods pg')->join('__GOODS__ g','g.goods_id=pg.goods_id')
            ->join('__ORDER_GOODS__ og','og.goods_id=pg.goods_id')->field('pg.*,g.store_number,og.send_num,gc.category_name,og.remark')
            ->join('__GOODS_CATEGORY__ gc','g.category_id=gc.category_id')
            ->where(['pg.purchase_id' => $purchase_id,'og.order_id' => $purchase['order_id']])->select();
            
            $goodsList = [];
            foreach ($purchase_goods as $key => $value){
                $diff_number = $value['goods_number'] - $value['send_num']; //未交数量
                if ($diff_number > 0){
                    $value['diff_number'] = $diff_number;
                    $value['current_send_number'] = $diff_number; //本次送货数量
                    $value['add_number'] = 0; //入库数量
                    $value['show_input'] = true;
                    $value['purchase_number'] = $diff_number;
                    $goodsList[] = $value;
                }
            }
            if (empty($goodsList)) $this->error('采购单关联的订单数量已送完，请取消关联库存');
            $data['goodslist'] = $goodsList;
            $data['cus_id'] = $purchase['cus_id'];
            
            $cus = db('customers')->where(['cus_id' => $purchase['cus_id']])->find();
            $data['cus_name'] = $cus['cus_name'];
            $data['contacts'] = $cus['cus_duty'];
            $data['contacts_tel'] = $cus['cus_phome'];
            $data['cus_phome'] = $cus['cus_mobile'];
            
            $this->success('','',$data);
        }
    }
    
}