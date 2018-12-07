<?php
namespace app\admin\controller;

use PHPExcel_Style_Alignment;

class Account extends Base {
    
    public function index(){
    	$cus_name = $this->request->param('cus_name');
    	$open_status = $this->request->param('open_status');
    	$start_time = $this->request->param('start_time');
    	$end_time = $this->request->param('end_time');
    	$invoice_status = $this->request->param('invoice_status');
    	$db = db('receivables');
    	$db->where(['is_delete' => 0]);
    	if ($cus_name != ''){
    		$db->where('cus_name','like',"%{$cus_name}%");
    	}
    	if (strtotime($start_time) && strtotime($end_time)){
    		$db->where(['invoice_date' => ['>=', $start_time]]);
    		$db->where(['invoice_date' => ['<=', $end_time]]);
    	}
    	if ($open_status != ''){
    		$db->where(['is_open' => $open_status]);
    	}
    	if ($invoice_status != '' && $invoice_status != 9){
    		$db->where(['status' => $invoice_status]);
    	}
    	if ($invoice_status == 9){
    	    $db->where(['is_confirm' => 1]);
    	}
        $result = $db->order('create_time desc')->paginate(config('page_size'),false,['query' => $this->request->param()]);
        $this->assign('page',$result->render());
        $list = $result->all();
        $receivable_ticket_db = db('receivable_ticket');
        foreach ($list as $key => $value) {
            $list[$key]['pay_money'] = _formatMoney($receivable_ticket_db->where(['rec_id' => $value['id']])->sum('money'));
        }
        $this->assign('list',$list);
        $this->assign('title','应收账款');
        cookie('soset',null);
        return $this->fetch();
    }
    
    public function openticket(){
    	if ($this->request->isAjax()){
    		$id = intval($this->request->param('id'));
    		$ticket_date = $this->request->param('ticket_date');
    		$ticket_sn = $this->request->param('ticket_sn');
    		$money = _formatMoney($this->request->param('money',0));
    		$remark = $this->request->param('remark');
    		$res = db('receivables')->where(['id' => $id,'is_delete' => 0])->find();
    		if (empty($res)) $this->error('开票数据错误');
    		if ($money <= 0){
    		    $this->error('开票金额不能为0');
    		}
    		$total_money = db('receivable_ticket')->where(['rec_id' => $id])->sum('money');
    		if($res['confirm_money'] - $total_money < $money){
    			$this->error('开票金额错误');
    		}
    		$data = [
    			'admin_uid' => $this->userinfo['id'],
    			'rec_id' => $id,
    			'ticket_date' => $ticket_date,
    			'ticket_sn' => $ticket_sn,
    			'money' => _formatMoney($money),
    			'remark' => $remark,
    			'create_time' => time()
    		];
    		if (db('receivable_ticket')->insert($data)){
    		    if (!$res['is_open']){
    		        db('receivables')->where(['id' => $id])->setField('is_open',1);
    		    }
    			$this->success('新增发票成功');
    		}else{
    			$this->error('新增发票失败');
    		}
    		return;
    	}
    	return $this->fetch('open_ticket');
    }
    
    public function st_openticket(){
    	if ($this->request->isAjax()){
    		$id = intval($this->request->param('id'));
    		$ticket_date = $this->request->param('ticket_date');
    		$ticket_sn = $this->request->param('ticket_sn');
    		$money = _formatMoney($this->request->param('money',0));
    		$remark = $this->request->param('remark');
    		$res = db('payment_order')->where(['id' => $id,'is_delete' => 0])->find();
    		if (empty($res)) $this->error('开票数据错误');
    		if ($money <= 0){
    			$this->error('开票金额不能为0');
    		}
    		$total_money = db('payment_ticket')->where(['rec_id' => $id])->sum('money');
    		if($res['pay_money'] - $total_money < $money){
    			$this->error('开票金额错误');
    		}
    		$data = [
    				'admin_uid' => $this->userinfo['id'],
    				'rec_id' => $id,
    				'ticket_date' => $ticket_date,
    				'ticket_sn' => $ticket_sn,
    				'money' => _formatMoney($money),
    				'remark' => $remark,
    				'create_time' => time()
    		];
    		if (db('payment_ticket')->insert($data)){
    		    if (!$res['is_open']){
    		      db('payment_order')->where(['id' => $id])->setField('is_open',1);
    		    }
    			$this->success('新增发票成功');
    		}else{
    			$this->error('新增发票失败');
    		}
    		return;
    	}
    	return $this->fetch('st_openticket');
    }
    
    public function ticketrecrod(){
    	$id = intval($this->request->param('id'));
    	$data = db('receivable_ticket r')->join('__USERS__ u','r.admin_uid=u.id')
    	->where(['r.rec_id' => $id])->field('r.*,u.user_nick')->order('create_time desc')->select();
    	$this->assign('list',$data);
    	$this->assign('title','发票记录');
    	return $this->fetch();
    }
    
    public function st_ticketrecrod(){
    	$id = intval($this->request->param('id'));
    	$data = db('payment_ticket r')->join('__USERS__ u','r.admin_uid=u.id')
    	->where(['r.rec_id' => $id])->field('r.*,u.user_nick')->order('create_time desc')->select();
    	$this->assign('list',$data);
    	$this->assign('title','发票记录');
    	return $this->fetch();
    }
    
    public function delete(){
        if ($this->request->isAjax()){
            $id = $this->request->param('id',0,'intval');
            if ($id <= 0) $this->error('参数错误');
            if (db('receivables')->where(['id' => $id])->setField('is_delete',1)){
                $delivery_ids = db('receivables')->where(['id' => $id])->value('delivery_ids');
                db('delivery_order')->where(['id' => ['in',$delivery_ids]])->setField('is_invoice',0);
                $this->success('操作成功');
            }
            $this->error('操作失败');
        }
    }
    
    public function close(){
        if ($this->request->isAjax()){
            $id = $this->request->param('id',0,'intval');
            if ($id <= 0) $this->error('参数错误');
            if (db('receivables')->where(['id' => $id])->setField('status',0)){
                $this->success('操作成功');
            }
            $this->error('操作失败');
        }
    }
        
    public function open(){
        if ($this->request->isAjax()){
            $id = $this->request->param('id',0,'intval');
            if ($id <= 0) $this->error('参数错误');
            if (db('receivables')->where(['id' => $id])->setField('is_open',1)){
                $this->success('操作成功');
            }
            $this->error('操作失败');
        }
    }
    
    public function status(){
        if ($this->request->isAjax()){
            $id = $this->request->param('id',0,'intval');
            if ($id <= 0) $this->error('参数错误');
            if (db('receivables')->where(['id' => $id])->setField('status',2)){
                $this->success('操作成功');
            }
            $this->error('操作失败');
        }
    }
    
    public function confirm(){
    	if ($this->request->isAjax()){
    		$id = $this->request->param('id',0,'intval');
    		if ($id <= 0) $this->error('参数错误');
    		if (db('receivables')->where(['id' => $id])->setField('is_confirm',1)){
    			$this->success('操作成功');
    		}
    		$this->error('操作失败');
    	}
    }
    
    public function payment_confirm(){
    	if ($this->request->isAjax()){
    		$id = $this->request->param('id',0,'intval');
    		if ($id <= 0) $this->error('参数错误');
    		if (db('payment_order')->where(['id' => $id])->setField('is_confirm',1)){
    			$this->success('操作成功');
    		}
    		$this->error('操作失败');
    	}
    }
    
    public function info(){
        $id = $this->request->param('id',0,'intval');
        if (empty($id)) $this->error('参数错误');
        $receivables = db('receivables')->where(['id' => $id,'is_delete' => 0])->find();
        if (empty($receivables)) $this->error('数据信息不存在');
        if ($this->request->isAjax() && $this->request->isPost()){
            $confirm_money = $this->request->post('confirm_money');
            if (empty($confirm_money)) $this->error('确认金额不能为空');
            if (!is_numeric($confirm_money) || $confirm_money < 0) $this->error('确认金额不正确');
            $file = $this->upload_file('',false);
            $data = [
                'confirm_money' => _formatMoney($confirm_money),
                'status' => 2,'is_confirm' => 1,
                'files' => (is_array($file) && !empty($file)) ? json_encode(['path' => $file['path'],'name' => $file['oldfilename']]) : '',
                'update_time' => time()
            ];
            if (db('receivables')->where(['id' => $id])->update($data)){
                $this->success('确认成功');
            }else{
                $this->error('确认失败');
            }
        }
        $receivables['files'] = json_decode($receivables['files'],true);
        $this->assign('receivables',$receivables);
        $ids = $receivables['delivery_ids'];
        $db = db('delivery_order do');
        //$db->where(['do.is_invoice' => 0]);
        $result = $db->join('__DELIVERY_GOODS__ gd','gd.delivery_id=do.id')
        ->join('__ORDER__ o','o.id=do.order_id')
        ->field('do.*,o.total_money,o.create_time as order_create_time,gd.goods_price,gd.goods_id,gd.unit,gd.goods_name,gd.add_number,gd.current_send_number')
        ->where(['do.cus_id' => $receivables['cus_id'],'do.id' => ['in',$ids]])->order('do.create_time desc')->select();
        foreach ($result as $key => $value){
            $category_name = db('goods g')->join('__GOODS_CATEGORY__ gc','gc.category_id=g.category_id')
            ->where(['g.goods_id' => $value['goods_id']])->value('gc.category_name');
            $result[$key]['category_name'] = $category_name;
            $result[$key]['count_money'] = _formatMoney($value['goods_price']*$value['current_send_number']);
        }
        $this->assign('page','');
        $this->assign('list',$result);
        $title = '应收账款详情';
        $this->assign('title',$title);
        $export = $this->request->param('export');
        if ($export == 1){
            $objPHPExcel = new \PHPExcel();
            $title = '应收对账单-'.date('Ymd');
            $topNumber = 5;
            $xlsTitle = iconv('utf-8', 'gb2312', $title);//文件名称
            $fileName = $title;//文件名称
            $cellKey = array(
                'A','B','C','D','E','F','G','H','I','J','K','L','M',
                'N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
                'AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM',
                'AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ'
            );
            
            $cellName=[
                ['order_dn','送货单号',0,12,'CENTER'],
                ['delivery_date','送货日期',0,12,'left'],
                ['cus_name','客户名称',0,12,'LEFT'],
                ['category_name','商品分类',0,12,'LEFT'],
                ['goods_name','商品名称',0,12,'LEFT'],
                ['unit','单位',0,12,'LEFT'],
                ['goods_price','单价',0,12,'LEFT'],
                ['is_confirm','是否对账',0,12,'LEFT'],
                ['current_send_number','交货数量',0,12,'LEFT'],
                ['count_money','金额',0,12,'LEFT'],
                ['cus_order_sn','客户单号',0,12,'LEFT'],
            ];
            $data=[];
            foreach ($result as $key => $value){
                $data[] = [
                    'order_dn' => $value['order_dn'],
                    'delivery_date' => $value['delivery_date'],
                    'cus_name' => $value['cus_name'],
                    'category_name' => $value['category_name'],
                    'goods_name' => $value['goods_name'],
                    'unit' => $value['unit'],
                    'goods_price' => $value['goods_price'],
                    'is_confirm' => $value['is_confirm']==1?'已对账':'未对账',
                    'current_send_number' => $value['current_send_number'],
                    'count_money' => $value['count_money'],
                    'cus_order_sn' => $value['cus_order_sn'],
                ];
            }
            
            //处理表头标题
            $objPHPExcel->getActiveSheet()->mergeCells('A1:'.$cellKey[count($cellName)-1].'1');
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1',$title);
            $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
            $objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(30);
            $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

            $objPHPExcel->getActiveSheet()->mergeCells('A2:'.$cellKey[count($cellName)-1].'2');
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2','客户名称：'.$receivables['cus_name']);
            $objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setSize(12);
            $objPHPExcel->getActiveSheet()->getRowDimension(2)->setRowHeight(25);
            $objPHPExcel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $objPHPExcel->getActiveSheet()->getStyle('A2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            
            $objPHPExcel->getActiveSheet()->mergeCells('A3:'.$cellKey[count($cellName)-1].'3');
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3','对账单号：'.$receivables['invoice_sn'].'    对账日期：'.$receivables['invoice_date']);
            $objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setSize(12);
            $objPHPExcel->getActiveSheet()->getRowDimension(3)->setRowHeight(25);
            $objPHPExcel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $objPHPExcel->getActiveSheet()->getStyle('A3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

            $objPHPExcel->getActiveSheet()->mergeCells('A4:'.$cellKey[count($cellName)-1].'4');
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A4','金额总计：'.$receivables['total_money'].'    确认金额：'.$receivables['confirm_money']);
            $objPHPExcel->getActiveSheet()->getStyle('A4')->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A4')->getFont()->setSize(12);
            $objPHPExcel->getActiveSheet()->getRowDimension(4)->setRowHeight(25);
            $objPHPExcel->getActiveSheet()->getStyle('A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $objPHPExcel->getActiveSheet()->getStyle('A4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            
            //处理表头
            foreach ($cellName as $k=>$v){
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellKey[$k].$topNumber, $v[1]);//设置表头数据
                $objPHPExcel->getActiveSheet()->freezePane($cellKey[$k].($topNumber+1));//冻结窗口
                $objPHPExcel->getActiveSheet()->getStyle($cellKey[$k].$topNumber)->getFont()->setBold(true);//设置是否加粗
                $objPHPExcel->getActiveSheet()->getStyle($cellKey[$k].$topNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);//垂直居中
                if($v[3] > 0){//大于0表示需要设置宽度
                    $objPHPExcel->getActiveSheet()->getColumnDimension($cellKey[$k])->setWidth($v[3]);//设置列宽度
                }
            }
            //处理数据
            foreach ($data as $k=>$v){
                foreach ($cellName as $k1=>$v1){
                    $objPHPExcel->getActiveSheet()->setCellValue($cellKey[$k1].($k+1+$topNumber), $v[$v1[0]]);
                    if(isset($v['end']) > 0){
                        if($v1[2] == 1){//这里表示合并单元格
                            $objPHPExcel->getActiveSheet()->mergeCells($cellKey[$k1].$v['start'].':'.$cellKey[$k1].$v['end']);
                            $objPHPExcel->getActiveSheet()->getStyle($cellKey[$k1].$v['start'])->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                        }
                    }
                    if($v1[4] != "" && in_array($v1[4], array("LEFT","CENTER","RIGHT"))){
                        $v1[4] = eval('return PHPExcel_Style_Alignment::HORIZONTAL_'.$v1[4].';');
                        $objPHPExcel->getActiveSheet()->getStyle($cellKey[$k1].($k+1+$topNumber))->getAlignment()->setHorizontal($v1[4]);
                    }
                }
            }
            //导出execl
            ob_end_clean();
            header('pragma:public');
            header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xls"');
            header("Content-Disposition:attachment;filename=$fileName.xls");
            $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output');
            exit;
        }
        return $this->fetch();
    }
    
    public function edit(){
        $id = $this->request->param('id',0,'intval');
        if (empty($id)) $this->error('参数错误');
        $receivables = db('receivables')->where(['id' => $id,'is_delete' => 0])->find();
        if (empty($receivables)) $this->error('数据信息不存在');
        if ($this->request->isAjax()){
            $invoice_sn = $this->request->post('invoice_sn');
            $invoice_date = $this->request->post('invoice_date');
            //$confirm_money = $this->request->post('confirm_money');
            $id = $this->request->post('id');
            if (empty($invoice_sn)) $this->error('发票号码不能为空');
            if (empty($invoice_date)) $this->error('开票日期不能为空');
            //if (empty($confirm_money)) $this->error('确认金额不能为空');
            //$file = $this->upload_file('',false);
            $data = [
                'id' => intval($id),
                'invoice_sn' => $invoice_sn,
                'invoice_date' => $invoice_date,
            	//'confirm_money' => $confirm_money,
                'update_time' => time()
            ];
            //if (is_array($file) && !empty($file)){
            	//$data['files'] = json_encode(['path' => $file['path'],'name' => $file['oldfilename']]);
            //}
            if (db('receivables')->where(['id' => ['neq',$data['id']],'invoice_sn' => $invoice_sn])->find()){
                $this->error('发票号码已存在');
            }
            if (db('receivables')->update($data)){
                $this->success('保存成功',url('index'));
            }
            $this->error('保存失败');
            return;
        }
        $this->assign('receivables',$receivables);
        $ids = $receivables['delivery_ids'];
        $db = db('delivery_order do');
        //$db->where(['do.is_invoice' => 0]);
        $result = $db->join('__DELIVERY_GOODS__ gd','gd.delivery_id=do.id')
        ->join('__ORDER__ o','o.id=do.order_id')
        ->field('do.*,o.total_money,o.create_time as order_create_time,gd.goods_price,gd.goods_id,gd.unit,gd.goods_name,gd.add_number,gd.current_send_number')
        ->where(['do.cus_id' => $receivables['cus_id'],'do.id' => ['in',$ids]])->select();
        foreach ($result as $key => $value){
            $category_name = db('goods g')->join('__GOODS_CATEGORY__ gc','gc.category_id=g.category_id')
            ->where(['g.goods_id' => $value['goods_id']])->value('gc.category_name');
            $result[$key]['category_name'] = $category_name;
        }
        $this->assign('page','');
        $this->assign('list',$result);
        $this->assign('title','应收账款');
        return $this->fetch();
    }
    
    public function newcreate(){
    	$cus_name = $this->request->param('cus_name');
    	$order_sn = $this->request->param('order_sn');
    	$start_time = $this->request->param('start_time');
    	$end_time = $this->request->param('end_time');
    	$db = db('delivery_order do');
    	$db->where(['do.is_invoice' => 0]);
    	if (!empty($cus_name)) {
    		$db->where(['do.cus_name' => ['like',"%{$cus_name}%"]]);
    	}
    	if (!empty($order_sn)){
    		$db->where(['o.order_sn' => $order_sn]);
    	}
    	if (strtotime($start_time) && strtotime($end_time)){
    		$db->where(['do.delivery_date' => ['>=',$start_time]]);
    		$db->where(['do.delivery_date' => ['<=',$end_time]]);
    	}
    	$result = $db->join('__DELIVERY_GOODS__ gd','gd.delivery_id=do.id')
    	->join('__ORDER__ o','o.id=do.order_id')->join('__PURCHASE__ p','p.id=do.purchase_id')
    	->field('do.*,p.tax,o.create_time as order_create_time,gd.goods_price,gd.goods_id,gd.unit,gd.goods_name,gd.add_number,gd.current_send_number')
    	->order('do.create_time desc')->paginate(config('page_size'),false,['query' => $this->request->param()]);
    	$list = $result->all();
    	foreach ($list as $key => $value){
    		$category_name = db('goods g')->join('__GOODS_CATEGORY__ gc','gc.category_id=g.category_id')
    		->where(['g.goods_id' => $value['goods_id']])->value('gc.category_name');
    		$list[$key]['category_name'] = $category_name;
    	}
    	$this->assign('page',$result->render());
    	$this->assign('list',$list);
    	$this->assign('title','新建应收账款');
    	//cookie('soset',null);
    	$this->assign('soset',cookie('soset'));
    	return $this->fetch();
    }
    
    public function soset(){
    	if ($this->request->isAjax()){
    		$data = $this->request->param();
    		if (empty($data)) {
    			cookie('soset',null);
    			$this->success('ok');
    			return;
    		}
    		if (count(array_unique($data)) >= 2){
    			$this->error('销售单号不相同的不能创建对账单');
    		}
    		if (count(array_unique($data)) == 1){
    			cookie('soset',$data);
    			$this->success('ok');
    		}
    	}
    }
    
    public function setsupplier(){
        if ($this->request->isAjax()){
            $data = $this->request->param();
            if (empty($data)) {
                cookie('setsupplier',null);
                $this->success('ok');
                return;
            }
            if (count(array_unique($data)) >= 2){
                $this->error('供应商不相同的不能创建对账单');
            }
            if (count(array_unique($data)) == 1){
                cookie('setsupplier',$data);
                $this->success('ok');
            }
        }
    }
    
    public function create(){
    	$checked = cookie('soset');
    	if (empty($checked) || empty($checked['checked'])) $this->error('请选择销售单');
    	/**
    	 * 1086_1_10
    	 * 1086_2_12
    	 */
    	$cus_ids = [];
    	$delivery_ids = [];
    	$order_ids = [];
    	foreach ($checked['checked'] as $value){
    		$arr = explode('_', $value);
    		$cus_ids[] = isset($arr[0]) ? $arr[0] : 0;
    		$delivery_ids[] = isset($arr[1]) ? $arr[1] : 0;
    		$order_ids[] = isset($arr[2]) ? $arr[2] : 0;
    	}
    	if (count(array_unique($cus_ids)) > 2){
    		$this->error('客户名称不相同的不能创建对账单');
    	}
    	$order_ids = array_unique($order_ids);
    	if (!empty($cus_ids) && !empty($order_ids)) {
    		$cus_id = $cus_ids[0];
    		$db = db('delivery_order do');
    		$db->where(['do.is_invoice' => 0]);
    		$db->where(['do.id' => ['in',$delivery_ids]]);
    		$result = $db->join('__DELIVERY_GOODS__ gd','gd.delivery_id=do.id')
    		->join('__ORDER__ o','o.id=do.order_id')
    		->field('do.*,o.company_name,o.company_short,o.total_money,o.create_time as order_create_time,gd.goods_price,gd.goods_id,gd.unit,gd.goods_name,gd.add_number,gd.current_send_number')
    		->where(['do.cus_id' => $cus_id,'do.order_id' => ['in',$order_ids]])->order('do.create_time desc')->select();
    		foreach ($result as $key => $value){
    			$category_name = db('goods g')->join('__GOODS_CATEGORY__ gc','gc.category_id=g.category_id')
    			->where(['g.goods_id' => $value['goods_id']])->value('gc.category_name');
    			$result[$key]['category_name'] = $category_name;
    		}
    		if (empty($result)) $this->error('数据错误');
    		//$order = db('order')->where(['id' => ['in',$order_ids]])->field('total_money,company_name,company_short')->select();
    		$total_money = 0;
    		$company_name = '';
    		/*
    		foreach ($order as $key => $value){
    			$total_money += $value['total_money'];
    			$company_name = $value['company_name'];
    		}
    		*/
    		foreach ($result as $key => $value){
    			$total_money += $value['goods_price']*$value['current_send_number'];
    			$company_name = $value['company_name'];
    		}
    		$this->assign('total_money',_formatMoney($total_money));
    		$this->assign('company_name',$company_name);
    		if ($this->request->isAjax()){
    			$invoice_sn = $this->request->post('invoice_sn');
    			$invoice_date = $this->request->post('invoice_date');
    			//$confirm_money = $this->request->post('confirm_money');
    			//$delivery_ids = $this->request->post('delivery_ids');
    			if (empty($invoice_sn)) $this->error('发票号码不能为空');
    			if (empty($invoice_date)) $this->error('开票日期不能为空');
    			if (db('receivables')->where(['invoice_sn' => $invoice_sn])->find()){
    			    $this->error('发票号码已存在');
    			}
    			//if (empty($confirm_money)) $this->error('确认金额不能为空');
    			$delivery_ids = [];
    			foreach ($result as $key => $value){
    				$delivery_ids[] = $value['id'];
    			}
    			$delivery_ids = array_unique($delivery_ids);
    			//$file = $this->upload_file('',false);
    			$data = [
    				'admin_uid' => $this->userinfo['id'],
    				'cus_id' => $cus_id,
    				'cus_name' => $company_name,
    				'delivery_ids' => implode(',', $delivery_ids),
    				'invoice_sn' => $invoice_sn,
    				'invoice_date' => $invoice_date,
    				'total_money' => _formatMoney($total_money),
    				//'confirm_money' => $confirm_money,
    				'pay_money' => 0,'diff_money' => 0,
    				'is_open' => 0,'status' => 1,
    				//'files' => (is_array($file) && !empty($file)) ? json_encode(['path' => $file['path'],'name' => $file['oldfilename']]) : '',
    				'update_time' => time(),'create_time' => time()
    			];
    			if (db('receivables')->insert($data)){
    				db('delivery_order')->where(['id' => ['in',$delivery_ids]])->setField('is_invoice',1);
    				cookie('soset',null);
    				$this->success('保存成功',url('index'));
    			}else{
    				$this->error('保存失败请重试');
    			}
    			return;
    		}
    		
    		$this->assign('page','');
    		$this->assign('list',$result);
    		$this->assign('title','新建应收账款');
    		$this->assign('soset',cookie('soset'));
    		return $this->fetch();
    	}
    	$this->error('数据错误');
    }
    
    public function payment(){
        $supplier_name = $this->request->param('supplier_name');
        $status = $this->request->param('status');
        $start_time = $this->request->param('start_time');
        $end_time = $this->request->param('end_time');
        $is_open = $this->request->param('is_open');
        $db = db('payment_order')->where(['is_delete' => 0]);
        if ($supplier_name != ''){
            $db->where('supplier_name','like',"%{$supplier_name}%");
        }
        if (strtotime($start_time) && strtotime($end_time)){
            $db->where(['invoice_date' => ['>=', $start_time]]);
            $db->where(['invoice_date' => ['<=', $end_time]]);
        }
        if ($is_open != ''){
            $db->where(['is_open' => $is_open]);
        }
        if ($status != ''){
            $db->where(['status' => $status]);
        }
        $result = $db->order('id desc')->paginate(config('page_size'),false,['query' => $this->request->param()]);
        $this->assign('page',$result->render());
        $list = $result->all();
        foreach ($list as $key => $value){
            $list[$key]['count_money'] = _formatMoney(db('payment_ticket')->where(['rec_id' => $value['id']])->sum('money'));
        }
        $this->assign('list',$list);
        $this->assign('title','应付账款');
        cookie('setsupplier',null);
        $this->assign('sub_class','viewFramework-product-col-1');
        return $this->fetch();
    }
    
    public function payment_info(){
        $id = $this->request->param('id',0,'intval');
        if (!$id) $this->error('参数错误');
        $payment_order = db('payment_order')->where(['id' => $id])->find();
        if (empty($payment_order)) $this->error('应付账款信息不存在');
        if ($this->request->isAjax() && $this->request->isPost()){
            $confirm_money = $this->request->post('pay_money');
            if (empty($confirm_money)) $this->error('确认金额不能为空');
            if (!is_numeric($confirm_money) || $confirm_money < 0) $this->error('确认金额不正确');
            $file = $this->upload_file('',false);
            $data = [
                'pay_money' => _formatMoney($confirm_money),
                'status' => 2,'is_confirm' => 1,
                'files' => (is_array($file) && !empty($file)) ? json_encode(['path' => $file['path'],'name' => $file['oldfilename']]) : '',
                'update_time' => time()
            ];
            if (db('payment_order')->where(['id' => $id])->update($data)){
                $this->success('确认成功');
            }else{
                $this->error('确认失败');
            }
        }
        
        $list = db('payment_goods pg')->where(['pg.payment_order_id' => $id])
        ->join('__GOODS__ g','pg.goods_id=g.goods_id')
        ->join('__GOODS_CATEGORY__ gc','g.category_id=gc.category_id')
        ->field('pg.*,gc.category_name')->select();
        foreach ($list as $key => $value) {
            $input_id = db('input_store')->where(['store_sn' => $value['delivery_dn'],'po_id' => $value['purchase_id']])->value('id');
            $list[$key]['delivery_sn'] = db('delivery_order')->where(['purchase_id' => $value['purchase_id'],
                'order_id' => $value['order_id'],
                'relation_input_id' => ['LIKE',"%{$input_id}%"]])->value('order_dn');
        }
        
        $this->assign('total_money',$payment_order['total_money']);
        $this->assign('page','');
        $payment_order['files'] = json_decode($payment_order['files'],true);
        $this->assign('info',$payment_order);
        $this->assign('list',$list);
        $title = '应付账款';
        $this->assign('title',$title);
        $this->assign('sub_class','viewFramework-product-col-1');
        $export = $this->request->param('export');
        if ($export == 1){
            $objPHPExcel = new \PHPExcel();
            $title = '应付对账单-'.date('Ymd');
            $topNumber = 5;
            $xlsTitle = iconv('utf-8', 'gb2312', $title);//文件名称
            $fileName = $title;//文件名称
            $cellKey = array(
                'A','B','C','D','E','F','G','H','I','J','K','L','M',
                'N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
                'AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM',
                'AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ'
            );
            
            $cellName=[
                ['po_sn','采购单号',0,12,'CENTER'],
                ['delivery_sn','送货单号',0,12,'LEFT'],
                ['delivery_date','入库日期',0,12,'left'],
                ['delivery_dn','入库单号',0,12,'LEFT'],
                ['category_name','商品分类',0,12,'LEFT'],
                ['goods_name','商品名称',0,12,'LEFT'],
                ['unit','单位',0,12,'LEFT'],
                ['goods_price','单价',0,12,'LEFT'],
                ['rec_number','入库数量',0,12,'LEFT'],
                ['count_money','金额',0,12,'LEFT'],
            ];
            $data=[];
            foreach ($list as $key => $value){
                $data[] = [
                    'po_sn' => $value['po_sn'],
                    'delivery_sn' => $value['delivery_sn'],
                    'delivery_date' => $value['delivery_date'],
                    'delivery_dn' => $value['delivery_dn'],
                    'category_name' => $value['category_name'],
                    'goods_name' => $value['goods_name'],
                    'unit' => $value['unit'],
                    'goods_price' => $value['goods_price'],
                    'rec_number' => $value['rec_number'],
                    'count_money' => $value['count_money'],
                ];
            }
            
            //处理表头标题
            $objPHPExcel->getActiveSheet()->mergeCells('A1:'.$cellKey[count($cellName)-1].'1');
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1',$title);
            $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
            $objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(30);
            $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            
            $objPHPExcel->getActiveSheet()->mergeCells('A2:'.$cellKey[count($cellName)-1].'2');
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2','供应商：'.$payment_order['supplier_name'].'    金额总计：'.$payment_order['total_money']);
            $objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setSize(12);
            $objPHPExcel->getActiveSheet()->getRowDimension(2)->setRowHeight(25);
            $objPHPExcel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $objPHPExcel->getActiveSheet()->getStyle('A2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            
            $objPHPExcel->getActiveSheet()->mergeCells('A3:'.$cellKey[count($cellName)-1].'3');
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3','付款期：'.$payment_order['payment_date'].'    发票号码：'.$payment_order['invoice_sn']);
            $objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setSize(12);
            $objPHPExcel->getActiveSheet()->getRowDimension(3)->setRowHeight(25);
            $objPHPExcel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $objPHPExcel->getActiveSheet()->getStyle('A3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            
            $objPHPExcel->getActiveSheet()->mergeCells('A4:'.$cellKey[count($cellName)-1].'4');
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A4','发票日期：'.$payment_order['invoice_date'].'    到期日期：'.$payment_order['last_date']);
            $objPHPExcel->getActiveSheet()->getStyle('A4')->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A4')->getFont()->setSize(12);
            $objPHPExcel->getActiveSheet()->getRowDimension(4)->setRowHeight(25);
            $objPHPExcel->getActiveSheet()->getStyle('A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $objPHPExcel->getActiveSheet()->getStyle('A4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            
            //处理表头
            foreach ($cellName as $k=>$v){
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellKey[$k].$topNumber, $v[1]);//设置表头数据
                $objPHPExcel->getActiveSheet()->freezePane($cellKey[$k].($topNumber+1));//冻结窗口
                $objPHPExcel->getActiveSheet()->getStyle($cellKey[$k].$topNumber)->getFont()->setBold(true);//设置是否加粗
                $objPHPExcel->getActiveSheet()->getStyle($cellKey[$k].$topNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);//垂直居中
                if($v[3] > 0){//大于0表示需要设置宽度
                    $objPHPExcel->getActiveSheet()->getColumnDimension($cellKey[$k])->setWidth($v[3]);//设置列宽度
                }
            }
            //处理数据
            foreach ($data as $k=>$v){
                foreach ($cellName as $k1=>$v1){
                    $objPHPExcel->getActiveSheet()->setCellValue($cellKey[$k1].($k+1+$topNumber), $v[$v1[0]]);
                    if(isset($v['end']) > 0){
                        if($v1[2] == 1){//这里表示合并单元格
                            $objPHPExcel->getActiveSheet()->mergeCells($cellKey[$k1].$v['start'].':'.$cellKey[$k1].$v['end']);
                            $objPHPExcel->getActiveSheet()->getStyle($cellKey[$k1].$v['start'])->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                        }
                    }
                    if($v1[4] != "" && in_array($v1[4], array("LEFT","CENTER","RIGHT"))){
                        $v1[4] = eval('return PHPExcel_Style_Alignment::HORIZONTAL_'.$v1[4].';');
                        $objPHPExcel->getActiveSheet()->getStyle($cellKey[$k1].($k+1+$topNumber))->getAlignment()->setHorizontal($v1[4]);
                    }
                }
            }
            //导出execl
            ob_end_clean();
            header('pragma:public');
            header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xls"');
            header("Content-Disposition:attachment;filename=$fileName.xls");
            $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output');
            exit;
        }
        return $this->fetch();
    }
    
    public function payment_edit(){
        $id = $this->request->param('id',0,'intval');
        if (!$id) $this->error('参数错误');
        $payment_order = db('payment_order')->where(['id' => $id])->find();
        if (empty($payment_order)) $this->error('应付账款信息不存在');
        if ($this->request->isAjax()){
            $invoice_sn = $this->request->post('invoice_sn');
            $invoice_date = $this->request->post('invoice_date');
            $last_date = $this->request->post('last_date');
            if (empty($invoice_sn)) $this->error('发票号码不能为空');
            if (empty($invoice_date)) $this->error('开票日期不能为空');
            if (empty($last_date)) $this->error('到期日期不能为空');
            $id = $this->request->post('id');
            $data = [
                'id' => intval($id),
                'invoice_sn' => $invoice_sn,
                'invoice_date' => $invoice_date,
                'last_date' => $last_date,
                'update_time' => time()
            ];
            if (db('payment_order')->where(['id' => ['neq',$data['id']],'invoice_sn' => $invoice_sn])->find()){
                $this->error('发票号码已存在');
            }
            if (db('payment_order')->update($data)){
                $this->success('保存成功',url('payment'));
            }
            $this->error('保存失败');
            return;
        }
        $list = db('payment_goods pg')->where(['pg.payment_order_id' => $id])
        ->join('__GOODS__ g','pg.goods_id=g.goods_id')
        ->join('__GOODS_CATEGORY__ gc','g.category_id=gc.category_id')
        ->field('pg.*,gc.category_name')->select();
        $this->assign('total_money',$payment_order['total_money']);
        $this->assign('page','');
        $this->assign('info',$payment_order);
        $this->assign('list',$list);
        $this->assign('title','应付账款');
        $this->assign('sub_class','viewFramework-product-col-1');
        return $this->fetch();
    }
    
    public function wait(){
        $supplier_name = $this->request->param('supplier_name');
        $store_sn = $this->request->param('store_sn');
        $po_sn = $this->request->param('po_sn');
        $start_time = $this->request->param('start_time');
        $end_time = $this->request->param('end_time');
        $db = db('input_store do');
        $db->where(['do.is_payment' => 0]);
        if ($supplier_name != '') {
            $db->where(['s.supplier_name|s.supplier_short','like',"%{$supplier_name}%"]);
        }
        if (strtotime($start_time) && strtotime($end_time)){
            $db->where(['do.create_time' => ['>=', strtotime($start_time)]]);
            $db->where(['do.create_time' => ['<=', strtotime($end_time)]]);
        }
        if ($po_sn != ''){
            $db->where(['p.po_sn' => $po_sn]);
        }
        if ($store_sn != ''){
            $db->where(['do.store_sn' => $store_sn]);
        }
        $result = $db->join('__PURCHASE__ p','do.po_id=p.id')
        ->join('__SUPPLIER__ s','p.supplier_id=s.id')
        ->join('__INPUT_GOODS__ ig','do.id=ig.input_id')
        ->field(['do.store_sn,do.id,do.create_time,ig.remark,ig.goods_name,ig.unit,ig.goods_price,ig.goods_number,p.supplier_id,p.po_sn,s.supplier_name,s.supplier_short'])
        ->order('do.create_time desc')->paginate(config('page_size'),false,['query' => $this->request->param()]);
        $this->assign('page',$result->render());
        $this->assign('list',$result->all());
        $this->assign('title','入库单待处理');
        $this->assign('sub_class','viewFramework-product-col-1');
        //cookie('setsupplier',null);
        $this->assign('soset',cookie('setsupplier'));
        return $this->fetch();
    }
    
    public function view(){
        $id = $this->request->param('id',0,'intval');
        if (!$id) $this->error('参数错误');
        $delivery_order = db('delivery_order')->where(['id' => $id])->find();
        if (empty($delivery_order)) $this->error('送货单不存在');
        $data = db('delivery_goods gd')->join('__GOODS__ g','g.goods_id=gd.goods_id')
        ->join('__GOODS_CATEGORY__ gc','g.category_id=gc.category_id')
        ->where(['gd.delivery_id' => $id])->field('gd.*,gc.category_name')->select();
        $this->assign('data',$data);
        $this->assign('page','');
        return $this->fetch();
    }
    
    public function create_payment(){
        $checked = cookie('setsupplier');
        if (empty($checked) || empty($checked['checked'])) $this->error('请选择供应商');
        $supplier_ids = [];
        $delivery_id = [];
        foreach ($checked['checked'] as $key => $value){
        	$tempArr = explode('_', $value);
        	if (isset($tempArr[0])) {
        		$supplier_ids[] = $tempArr[0];
        	}
        	if (isset($tempArr[1])) {
        		$delivery_id[] = $tempArr[1];
        	}
        }
        if (count(array_unique($supplier_ids)) > 2){
        	$this->error('不相同的供应商不能创建对账单');
        }
        $supplier_id = $supplier_ids[0]?:0;
        $supplier = db('supplier')->where(['id' => $supplier_id])->find();
        if (empty($supplier)) $this->error('供应商不存在');
        $this->assign('supplier',$supplier);
        $result = db('input_store do')->join('__INPUT_GOODS__ gd','gd.input_id=do.id')
        ->join('__GOODS__ g','gd.goods_id=g.goods_id')->join('__GOODS_CATEGORY__ gc','gc.category_id=g.category_id')
        ->where(['do.id' => ['in',array_unique($delivery_id)]])->field('do.*,gd.goods_id,gd.goods_name,gd.goods_price,gd.unit,gd.goods_number,gc.category_name')
        ->order('do.create_time desc')->select();
        $totalMoney = 0;
        foreach ($result as $key => $value){
            //$result[$key]['count_money'] = _formatMoney($value['goods_price']*($value['current_send_number']+$value['add_number']));   
            $result[$key]['count_money'] = _formatMoney($value['goods_price']*$value['goods_number']);
        	$totalMoney += $result[$key]['count_money'];
        }
        
        if ($this->request->isAjax()){
            $invoice_sn = $this->request->post('invoice_sn');
            $invoice_date = $this->request->post('invoice_date');
            $last_date = $this->request->post('last_date');
            if (empty($invoice_sn)) $this->error('发票号码不能为空');
            if (empty($invoice_date)) $this->error('开票日期不能为空');
            if (empty($last_date)) $this->error('到期日期不能为空');
            if (db('payment_order')->where(['invoice_sn' => $invoice_sn])->find()){
                $this->error('发票号码已存在');
            }
            $delivery_ids = [];
            foreach ($result as $key => $value){
                $delivery_ids[] = $value['id'];
            }
            $delivery_ids = array_unique($delivery_ids);
            $data = [
                'admin_uid' => $this->userinfo['id'],
                'supplier_id' => $supplier_id,
                'supplier_name' => $supplier['supplier_name'],
                'delivery_ids' => implode(',', $delivery_ids),
                'invoice_sn' => $invoice_sn,
                'invoice_date' => $invoice_date,
                'total_money' => _formatMoney($totalMoney),
                //'pay_money' => _formatMoney($totalMoney),
                'diff_money' => 0,
                'is_open' => 0,'status' => 1,
                'payment_date' => $supplier['supplier_payment'],
                'last_date' => $last_date,
                'update_time' => time(),'create_time' => time()
            ];
            db()->startTrans();
            if (db('payment_order')->insert($data)){
                $payment_order_id = db('payment_order')->getLastInsID();
                //db('delivery_order')->where(['id' => ['in',$delivery_ids]])->setField('is_payment',1);
                db('input_store')->where(['id' => ['in',$delivery_ids]])->setField('is_payment',1);
                $success_num = 0;
                foreach ($result as $key => $value){
                	$order = db('purchase')->where(['id' => $value['po_id']])->find();
                    if(db('payment_goods')->insert([
                        'payment_order_id' => $payment_order_id,
                        'order_id' => $order['order_id'],
                        'order_sn' => $order['order_sn'],
                        'purchase_id' => $value['po_id'],
                        'po_sn' => $value['po_sn'],
                        //'delivery_date' => $value['delivery_date'],
                        //'delivery_dn' => $value['order_dn'], //送货单号
                    	'delivery_date' => date('Y-m-d H:i:s',$value['create_time']), //入库日期
                    	'delivery_dn' => $value['store_sn'], //入库单号
                        'goods_id' => $value['goods_id'],
                        'goods_name' => $value['goods_name'],
                        'unit' => $value['unit'],
                        'goods_price' => $value['goods_price'],
                        'rec_number' => $value['goods_number'],
                    	'open_number' => $value['goods_number'],
                    	'count_money' => _formatMoney($value['goods_number']*$value['goods_price'])
                        //'rec_number' => $value['current_send_number']+$value['add_number'], //收货数量
                        //'open_number' => $value['current_send_number']+$value['add_number'], //开票数量
                        //'count_money' => _formatMoney(($value['current_send_number']+$value['add_number'])*$value['goods_price'])
                    ])){
                    	$success_num++;
                    }
                }
                if ($success_num == count($result)){
                	db()->commit();
	                cookie('setsupplier',null);
	                $this->success('保存成功',url('payment'));
                }else{
                	db()->rollback();
                	$this->error('保存失败请重试');
                }
            }else{
                $this->error('保存失败请重试');
            }
            return;
        }
        
        $this->assign('total_money',_formatMoney($totalMoney));
        $this->assign('page','');
        $this->assign('list',$result);
        $this->assign('title','应付账款');
        $this->assign('sub_class','viewFramework-product-col-1');
        return $this->fetch();
    }
    
    public function payment_open(){
        if ($this->request->isAjax()){
            $id = $this->request->param('id',0,'intval');
            if ($id <= 0) $this->error('参数错误');
            if (db('payment_order')->where(['id' => $id])->setField('is_open',1)){
                $this->success('操作成功');
            }
            $this->error('操作失败');
        }
    }
    
    public function payment_status(){
        if ($this->request->isAjax()){
            $id = $this->request->param('id',0,'intval');
            if ($id <= 0) $this->error('参数错误');
            if (db('payment_order')->where(['id' => $id])->setField('status',2)){
                $this->success('操作成功');
            }
            $this->error('操作失败');
        }
    }
    
    public function payment_delete(){
        if ($this->request->isAjax()){
            $id = $this->request->param('id',0,'intval');
            if ($id <= 0) $this->error('参数错误');
            if (db('payment_order')->where(['id' => $id])->setField('is_delete',1)){
                db('payment_goods')->where(['payment_order_id' => $id])->setField('is_delete',1);
                $delivery_ids = db('payment_order')->where(['id' => $id])->value('delivery_ids');
                db('delivery_order')->where(['id' => ['in',$delivery_ids]])->setField('is_invoice',0);
                $this->success('操作成功');
            }
            $this->error('操作失败');
        }
    }
    
}