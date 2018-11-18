<?php
namespace app\admin\controller;
class Store extends Base {
 
    public function index(){
        $cate_lists = db('goods_category')->select();
        $this->assign('lists',$cate_lists);
        $supplier_name = $this->request->param('supplier_name');
        $category_id = $this->request->param('category_id',0,'intval');
        $goods_name = $this->request->param('goods_name');
        $db = db('purchase p');
        $where = ['g.status' => ['neq','-1']];
        if ($supplier_name != ''){
            $db->where('s.supplier_name|s.supplier_short','like',"%{$supplier_name}%");
        }
        if ($goods_name != ''){
            $db->where('g.goods_name','like',"%{$goods_name}%");
        }
        if ($category_id > 0){
            $where['g.category_id'] = $category_id;
        }
        
        $db->where($where);
        $db->field('g.goods_id,g.goods_name,g.unit,g.store_number,gc.category_name,s.supplier_name');
        $db->join('__PURCHASE_GOODS__ pg','p.id=pg.purchase_id');
        $db->join('__GOODS__ g ','pg.goods_id=g.goods_id');
        $db->join('__GOODS_CATEGORY__ gc','g.category_id=gc.category_id');
        $db->join('__SUPPLIER__ s','s.id=g.supplier_id');
        
        //$db->join('__DELIVERY_ORDER__ do','p.order_id=do.order_id');
        //$db->where(['do.is_confirm' => 1]);
        
        $result = $db->group('g.goods_id')->paginate(config('PAGE_SIZE'),false, ['query' => $this->request->param()]);
        
        $this->assign('page',$result->render());
        $this->assign('list',$result);
        $this->assign('title','库存盘点');
        return $this->fetch();
    }
    
    public function log(){
        //1入库，2出库，3报溢，4报损
        $goods_id = $this->request->param('goods_id',0,'intval');
        $order_id = $this->request->param('order_id',0,'intval');
        $delivery_order = db('delivery_order')->where(['order_id' => $order_id])->find();
        //['l.order_id' => $order_id,'l.goods_id' => $goods_id]
        $result = db('store_log l')->where("(l.order_id={$order_id} OR type=3 OR type=4 OR type=5) and l.goods_id=".$goods_id)
        ->join('__GOODS__ g','l.goods_id=g.goods_id')
        ->join('__GOODS_CATEGORY__ gc','g.category_id=gc.category_id')
        ->field('l.*,gc.category_name,g.unit')->order('l.create_time desc')->paginate(config('page_size'), false, ['query' => $this->request->param()]);
        $data = $result->all();
        $this->assign('page',$result->render());
        $this->assign('title','库存变动记录');
        $this->assign('data',$data);
        $this->assign('current_page', $result->getCurrentPage());
        $this->assign('total_page', $result->lastPage());
        $this->assign('params', $this->request->query());
        if ($this->request->isMobile() && $this->request->isAjax()) {
        	if (empty($data)) $this->success('ok','');
        	
        	return $this->fetch('load');
        }
        return $this->fetch();
    }
    
    public function relation(){
        $cate_lists = db('goods_category')->select();
        $this->assign('lists',$cate_lists);
        $supplier_name = $this->request->param('supplier_name');
        $category_id = $this->request->param('category_id',0,'intval');
        $goods_name = $this->request->param('goods_name');
        
        $db = db('purchase p');
        $where = ['p.status' => ['neq','-1']];
        if ($supplier_name != ''){
            $db->where('s.supplier_name|s.supplier_short','like',"%{$supplier_name}%");
        }
        if ($goods_name != ''){
            $db->where('g.goods_name|pg.goods_name','like',"%{$goods_name}%");
        }
        if ($category_id > 0){
            $where['gc.category_id'] = $category_id;
        }
        
        $db->where($where);
        $db->field('p.*,p.id as purchase_id,g.store_number,pg.goods_id,pg.goods_name,pg.unit,pg.goods_number,pg.goods_price,gc.category_name,s.supplier_name');
        $db->join('__PURCHASE_GOODS__ pg','p.id=pg.purchase_id');
        $db->join('__GOODS__ g ','pg.goods_id=g.goods_id');
        $db->join('__GOODS_CATEGORY__ gc','g.category_id=gc.category_id');
        $db->join('__SUPPLIER__ s','s.id=p.supplier_id');
        
        //$db->join('__DELIVERY_ORDER__ do','p.order_id=do.order_id');
        //$db->where(['do.is_confirm' => 1]);
        
        $result = $db->order('p.create_time desc')->paginate(config('PAGE_SIZE'),false, ['query' => $this->request->param()]);
        $list = $result->all();
        foreach ($list as $key => $value){
        	if ($value['create_type'] == 1){
        		$list[$key]['order_id'] = db('delivery_order')->where(['purchase_id' => $value['id']])->value('order_id');
        	}
        }
        $this->assign('current_page', $result->getCurrentPage());
        $this->assign('total_page', $result->lastPage());
        $this->assign('params', $this->request->query());
        $this->assign('page',$result->render());
        $this->assign('list',$list);
        if ($this->request->isMobile()){
        	$this->assign('title','订单管理');
        	if ($this->request->isAjax()) {
        		if (empty($list)) $this->success('ok','');
        		return $this->fetch('load');
        	}
        }else{
        	$this->assign('title','关联库存');
        }
        return $this->fetch();
    }
    
    public function cancel(){
        if ($this->request->isAjax()){
            $id = $this->request->param('id',0,'intval');
            if ($id <= 0) $this->error('参数错误');
            if (db('purchase')->where(['id' => $id])->setField('is_cancel',1)){
            	$info = db('purchase')->where(['id' => $id])->find();
            	if ($info['order_id']){
            		db('order')->where(['id' => $info['order_id']])->setField('is_create',0);
            	}
                $this->success('取消成功');
            }
            $this->error('取消失败');
        }
    }
    
    public function update_store(){
        if ($this->request->isAjax()){
            $goods_id = $this->request->param('goods_id',0,'intval');
            $store_number = $this->request->param('store_number',0,'intval');
            $goods = db('goods')->where(['goods_id' => $goods_id])->find();
            if ($goods['store_number'] == $store_number){
            	$this->success('更新成功');
            }
            if (db('goods')->where(['goods_id' => $goods_id])->update(['store_number' => $store_number,'update_time' => time()])){
                //1入库，2出库，3报溢，4报损
                $type = 0;
                if ($goods['store_number'] > $store_number){
                    $diff_number = $goods['store_number'] - $store_number;
                    $type = 4;
                }
                if ($goods['store_number'] < $store_number){
                    $diff_number = $store_number - $goods['store_number'];
                    $type = 3;
                }
                db('store_log')->insert([
                    'goods_id' => $goods['goods_id'],
                    'goods_name' => $goods['goods_name'],
                    'type' => $type,
                    'number' => $diff_number,
                    'create_time' => time()
                ]);
                $this->success('更新成功');
            }
            $this->error('更新失败');
        }
    }
    
    public function purchase(){
        $start_time = strtotime($this->request->param('start_time'));
        $end_time = $this->request->param('end_time');
        $po_sn = $this->request->param('po_sn');
        $store_sn = $this->request->param('store_sn');
        $supplier_name = $this->request->param('supplier_name');
        $cus_name = $this->request->param('delivery_company');
        $db = db('input_store i');
        if ($start_time && strtotime($end_time)){
            $db->where(['i.create_time' => ['egt',$start_time]]);
            $db->where(['i.create_time' => ['elt',strtotime($end_time.' 23:59:59')]]);
        }
        if ($po_sn != '') {
            $db->where(['i.po_sn' => $po_sn]);
        }
        if ($store_sn != ''){
            $db->where(['i.store_sn' => $store_sn]);
        }
        if ($cus_name != '') {
            $db->where(['i.cus_name' => $cus_name]);
        }
        if ($supplier_name != ''){
            $db->where(['s.supplier_name',['like',"%{$supplier_name}%"]]);
            $db->where(['s.supplier_short', ['like',"%{$supplier_name}%"]]);
        }
        $result = $db->join('__INPUT_GOODS__ g','i.id=g.input_id')
        ->join('__SUPPLIER__ s','s.id=i.supplier_id')->field('i.*,s.supplier_name,g.goods_id,g.goods_name,g.unit,g.goods_price,g.goods_number,g.remark as goods_remark')
        ->paginate(config('page_size'),false,['query' => $this->request->param()]);
        $list = $result->all();
        foreach ($list as $key => $value){
        	$list[$key]['category_name'] = db('goods g')->join('__GOODS_CATEGORY__ c','g.category_id=c.category_id')->value('c.category_name');
        }
        $this->assign('title','采购入库');
        $this->assign('list',$list);
        $this->assign('page',$result->render());
        $this->assign('current_page', $result->getCurrentPage());
        $this->assign('total_page', $result->lastPage());
        $this->assign('params', $this->request->query());
        if ($this->request->isMobile()) {
        	if ($this->request->isAjax()) {
        		if (empty($list)) $this->success('ok','');
        		return $this->fetch('load_purchase');
        	}
        }
        return $this->fetch();
    }
    
    public function cancelpur(){
        if ($this->request->isAjax()){
            $id = $this->request->param('id',0,'intval');
            if ($id <= 0) $this->error('参数错误');
            if (db('input_store')->where(['id' => $id])->setField('is_cancel',1)){
                $info = db('input_store')->where(['id' => $id])->find();
                if ($info['po_id']){
                    $goodslist = db('input_goods')->where(['input_id' => $id])->select();
                    foreach ($goodslist as $key => $value){
                       db('purchase_goods')->where([
                           'goods_id' => $value['goods_id'],
                           'purchase_id' => $info['po_id']
                       ])->setDec('input_store',$value['goods_number']);
                    }
                }
                $this->success('取消成功');
            }
            $this->error('取消失败');
        }
    }
    
    public function deletepur(){
        if ($this->request->isAjax()){
            $id = $this->request->param('id',0,'intval');
            if ($id <= 0) $this->error('参数错误');
            if (db('input_store')->where(['id' => $id])->delete()){
                db('input_goods')->where(['input_id' => $id])->delete();
                $this->success('删除成功');
            }
            $this->error('删除失败');
        }
    }
    
    public function add(){
        if ($this->request->isAjax()){
            $data = [
                'admin_uid' => $this->userinfo['id'],
                'po_id' => $this->request->post('po_id'),
                'store_sn' => $this->request->post('store_sn'),
                'po_sn' => $this->request->post('po_sn'),
                'cus_name' => $this->request->post('cus_name'),
                'supplier_id' => $this->request->post('supplier_id'),
                'remark' => $this->request->post('store_remark'),
                'purchase_date' => $this->request->post('purchase_date'),
                'update_time' => time(),
                'create_time' => time()
            ];
            if (empty($data['store_sn'])) $this->error('入库单号不能为空');
            if (empty($data['po_sn'])) $this->error('采购单号不能为空');
            if (empty($data['cus_name'])) $this->error('送货公司不能为空');
            $goods = $this->_get_goods($data['po_id']);
            $input_store = $this->request->post('input_store/a');
            $remark = $this->request->post('remark/a');
            foreach ($goods as $key => $value){
                if (isset($input_store[$value['goods_id']])){
                    $x = $input_store[$value['goods_id']][0];
                    if ($x > $value['goods_number'] && $value['input_store']!=0) {
                        $this->error('“'.$value['goods_name'].'”入库数量不能大于采购数量');
                    }
                    if ($value['goods_number'] < $x+$value['input_store']) {
                        $this->error('“'.$value['goods_name'].'”本次入库数量+已入库数量不能大于采购数量');
                    }
                }else{
                    $this->error('“'.$value['goods_name'].'”不存在');
                }
            }
            
            db()->startTrans();
            $input_id = db('input_store')->insertGetId($data);
            if ($input_id && !empty($goods)){
                $temp = [];
                foreach ($goods as $key => $value){
                    $m = [
                        'input_id' => $input_id,
                        'goods_id' => $value['goods_id'],
                        'goods_name' => $value['goods_name'],
                        'unit' => $value['unit'],
                        'goods_price' => $value['goods_price'],
                        'create_time' => time()
                    ];
                    
                    if (isset($input_store[$value['goods_id']])){
                        $v = $input_store[$value['goods_id']][0];
                        if ($value['goods_number'] - $value['input_store'] < $v) {
                            $v = $value['goods_number'] - $value['input_store'];
                        }
                        $m['goods_number'] = $v;
                        db('purchase_goods')->where(['purchase_id' => $data['po_id'],'goods_id' => $value['goods_id']])->setInc('input_store',$v);
                        db('store_log')->insert([
                            'input_id' => $input_id,
                            'goods_id' => $value['goods_id'],
                            'goods_name' => $value['goods_name'],
                            'type' => 5, //采购入库
                            'number' => $v,
                            'create_time' => time()
                        ]);
                    }
                    if (isset($remark[$value['goods_id']])){
                        $m['remark'] = $remark[$value['goods_id']];
                    }
                    
                    $temp[] = $m;
                }
                $res = db('input_goods')->insertAll($temp);
                if ($res){
                    db()->commit();
                    $this->success('新增成功');
                }
                db()->rollback();
            }else{
                $this->error('新增失败');
            }
            return;
        }
        $this->assign('title','新增采购入库');
        return $this->fetch();
    }
    
    private function _get_goods($po_id){
        $db = db('purchase p');
        $db->where(['p.id' => $po_id]);
        $db->where("(g.goods_number-g.input_store) > 0");
        $result = $db->join('__PURCHASE_GOODS__ g','p.id=g.purchase_id')
        ->field('p.create_time,p.po_sn,g.goods_name,g.unit,g.goods_id,g.goods_price,g.goods_number,g.input_store')
        ->select();
        foreach ($result as $key => $value){
            $result[$key]['create_date'] = date('Y-m-d',$value['create_time']);
        }
        return $result;
    }
    
    public function load(){
      $po_id = $this->request->param('po_id',0,'intval');
      if ($po_id > 0){
          $result = $this->_get_goods($po_id);
          $this->success('ok','',$result);
      }
      $this->error('error');
    }
    
    public function search_purchase(){
    	$po_sn = $this->request->param('po_sn');
        $supplier_name = $this->request->param('supplier_name');
        $start_time = $this->request->param('start_time');
        $end_time = $this->request->param('end_time');
        $delivery_company = $this->request->param('delivery_company');
        $goods_name = $this->request->param('goods_name');
        $list = [];
        $page = '';
        //if ($po_sn != '' || $supplier_name != '' || ($start_time!='' && $end_time!='') || $delivery_company != '' || $goods_name != ''){
	        $db = db('purchase p');
	        if ($po_sn != '') {
	        	$db->where(['p.po_sn' => $po_sn]);
	        }
	        if ($supplier_name != '') {
	            $db->where("(s.supplier_name like '%{$supplier_name}%' OR s.supplier_short like '%{$supplier_name}%')");
	        }
	        if (strtotime($start_time) && strtotime($end_time)){
	            $db->where(['p.create_time' => ['egt',strtotime($start_time)]]);
	            $db->where(['p.create_time' => ['elt',strtotime($end_time.' 23:59:59')]]);
	        }
	        if ($delivery_company != ''){
	            $db->where(['d.cus_name' => ['like',"%{$delivery_company}%"]]);
	        }
	        if ($goods_name != ''){
	            $db->where(['g.goods_name' => ['like',"%{$goods_name}%"]]);
	        }
	        $db->where("(g.goods_number-g.input_store) > 0");
	        $result = $db->join('__SUPPLIER__ s','p.supplier_id=s.id')->join('__PURCHASE_GOODS__ g','p.id=g.purchase_id')
	        ->join('__CUSTOMERS__ c','p.cus_id=c.cus_id')
	        ->field('p.id,g.purchase_id,p.create_time,p.po_sn,s.supplier_name,s.id as supplier_id,c.cus_name,g.goods_name,g.unit,g.goods_price,g.goods_number,g.input_store')
	        ->paginate(config('page_size'),false,['query' => $this->request->param()]);
	        $list = $result->all();
	        foreach ($list as $key => $value){
	        	$list[$key]['create_date'] = date('Y-m-d',$value['create_time']);
	        }
	        $page = $result->render();
        //}
        $this->assign('pjson',json_encode($list));
        $this->assign('list',$list);
        $this->assign('page',$page);
        $this->assign('current_page', $result->getCurrentPage());
        $this->assign('total_page', $result->lastPage());
        $this->assign('query', $this->request->query());
        if ($this->request->isMobile() && $this->request->isAjax()){
        	$this->success('ok','',$list);
        }
        $this->assign('title','查询采购单');
        return $this->fetch();
    }
    
    public function edit(){
    	if ($this->request->isAjax()){
    		$data = [
    				'admin_uid' => $this->userinfo['id'],
    				'po_id' => $this->request->post('po_id'),
    				'store_sn' => $this->request->post('store_sn'),
    				'po_sn' => $this->request->post('po_sn'),
    				'cus_name' => $this->request->post('cus_name'),
    				'supplier_id' => $this->request->post('supplier_id'),
    				'remark' => $this->request->post('store_remark'),
    				'purchase_date' => $this->request->post('purchase_date'),
    				'update_time' => time(),
    				'create_time' => time()
    		];
    		if (empty($data['store_sn'])) $this->error('入库单号不能为空');
    		if (empty($data['po_sn'])) $this->error('采购单号不能为空');
    		if (empty($data['cus_name'])) $this->error('送货公司不能为空');
    		$goods = $this->_get_goods($data['po_id']);
    		$input_store = $this->request->post('input_store/a');
    		$remark = $this->request->post('remark/a');
    		foreach ($goods as $key => $value){
    			if (isset($input_store[$value['goods_id']])){
    				$x = $input_store[$value['goods_id']][0];
    				if ($x > $value['goods_number'] && $value['input_store']!=0) {
    					$this->error('“'.$value['goods_name'].'”入库数量不能大于采购数量');
    				}
    				if ($value['goods_number'] < $x+$value['input_store']) {
    					$this->error('“'.$value['goods_name'].'”本次入库数量+已入库数量不能大于采购数量');
    				}
    			}else{
    				$this->error('“'.$value['goods_name'].'”不存在');
    			}
    		}
    		
    		db()->startTrans();
    		$input_id = db('input_store')->insertGetId($data);
    		if ($input_id && !empty($goods)){
    			$temp = [];
    			foreach ($goods as $key => $value){
    				$m = [
    						'input_id' => $input_id,
    						'goods_id' => $value['goods_id'],
    						'goods_name' => $value['goods_name'],
    						'unit' => $value['unit'],
    						'goods_price' => $value['goods_price'],
    						'create_time' => time()
    				];
    				
    				if (isset($input_store[$value['goods_id']])){
    					$v = $input_store[$value['goods_id']][0];
    					if ($value['goods_number'] - $value['input_store'] < $v) {
    						$v = $value['goods_number'] - $value['input_store'];
    					}
    					$m['goods_number'] = $v;
    					db('purchase_goods')->where(['purchase_id' => $data['po_id'],'goods_id' => $value['goods_id']])->setInc('input_store',$v);
    					db('store_log')->insert([
    							'input_id' => $input_id,
    							'goods_id' => $value['goods_id'],
    							'goods_name' => $value['goods_name'],
    							'type' => 5, //采购入库
    							'number' => $v,
    							'create_time' => time()
    					]);
    				}
    				if (isset($remark[$value['goods_id']])){
    					$m['remark'] = $remark[$value['goods_id']];
    				}
    				
    				$temp[] = $m;
    			}
    			$res = db('input_goods')->insertAll($temp);
    			if ($res){
    				db()->commit();
    				$this->success('新增成功');
    			}
    			db()->rollback();
    		}else{
    			$this->error('新增失败');
    		}
    		return;
    	}
        $id = $this->request->param('id',0,'intval');
        $data = db('input_store')->where(['id' => $id])->find();
        if (empty($data)) $this->error('采购入库单信息不存在');
        $goodslist = db('input_goods i')->join('__PURCHASE_GOODS__ p','i.goods_id=p.goods_id')
        ->field('p.goods_number,i.goods_id,i.goods_name,i.unit,i.goods_price,i.goods_number as input_store,i.remark,i.create_time')
        ->where(['i.input_id' => $id,'p.purchase_id' => $data['po_id']])->select();
        $data['supplier_name'] = db('supplier')->where(['id' => $data['supplier_id']])->value('supplier_name');
        $data['store_remark'] = $data['remark'];
        $this->assign('data',$data);
        $this->assign('goodslist',json_encode($goodslist));
        $this->assign('title','编辑采购入库');
        return $this->fetch();
    }
    
    
    
    
    
    
    
    
    
    
    
    
}