{extend name="public/common" /}
{block name="header"}
<style>
body{background:#fff;}
.weui-label,input,textarea{font-size:13px !important;}
.weui-label ,.weui-cells__title {width:70px !important;text-align:right;}
.weui-cells__title {color:#000;padding-left:11px;}
.weui-cell{padding:10px;}
.main{padding-top:25px;margin-bottom:60px;}
.list .weui-form-preview__value{text-align:left;}
.list .goods_number input{border:1px solid #e5e5e5;width:50% !important;padding:5px;
}.list .remark input{border:1px solid #e5e5e5;width:80% !important;padding:5px;}
.list .price_input {border:1px solid #e5e5e5;width:80px !important;padding:5px;}
.weui-form-preview:before{border:none;}
.weui-form-preview{margin-bottom:5px;}
.button-block{border-top:1px solid #f6f6f6;text-align:right;padding:7px 7px 7px 0;margin:0;}
.list .weui-btn{border-radius:50px;}
.weui-btn+.weui-btn{margin-top:0;margin-left:10px;}
.inputspan,.tab_hide{display:none;}
.inputspan-show{display:inline;}
.input-hide{display:none;}
.input-show{display:inline;}
.weui-cells:before{border:none;}
.weui-cells:after{border:none;}
.weui-uploader__input-box{width:30px;height:30px;}
.weui-uploader__input-box:before{height:30px;}
.weui-uploader__input-box:after{width:30px;}
.delete-file{color:#06f;}
</style>
{/block}

{block name="main"}
  <div class="weui-navbar" style="position:fixed;top:0;">
    <a class="weui-navbar__item weui-bar__item--on" href="javascript:;">
     基本信息
    </a>
    <a class="weui-navbar__item" href="javascript:;">
      商品
    </a>
  </div>
<form class="form-horizontal" enctype="multipart/form-data" action="<?php echo url('edit');?>" id="saveOrder" method="post">
  	<input type="hidden" name="id" id="id" value="{$delivery.id}" />
	<input type="hidden" name="cus_id" id="cus_id" value="{$delivery.cus_id}" />
    <input type="hidden" name="purchase_id" id="purchase_id" value="{$delivery.purchase_id}" />
    <input type="hidden" name="order_id" id="order_id" value="{$delivery.order_id}" />
	<div style="margin-bottom: 60px;margin-top: 65px;">
	<div id="tab1" class="weui-tab__bd-item" style="display: block;">
    <div class="weui-cells weui-cells_form">
      <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">订单号码：</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" readonly="readonly" value="{$delivery.order_dn}" name="order_dn" id="order_dn"/>
        </div>
      </div>
      
      <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">送货日期：</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" readonly="readonly" value="{$delivery.delivery_date}" name="delivery_date" id="delivery_date"/>
        </div>
      </div>
      
      <div class="weui-cell" >
        <div class="weui-cell__hd"><label class="weui-label">订单号码：</label></div>
        <div class="weui-cell__bd" style="position:relative;">
          <input class="weui-input" type="text" readonly="readonly" name="order_sn" value="{$delivery.order_sn}" id="order_sn" />
          <button type="button" style="position: absolute;right:0;top:-2px;" class="weui-btn weui-btn_mini weui-btn_primary" id="search_order">查找</button>
        </div>
      </div>
      
      <div class="weui-cell" >
        <div class="weui-cell__hd"><label class="weui-label">客户单号：</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" readonly="readonly" value="{$delivery.cus_order_sn}" name="cus_order_sn" placeholder="输入客户订单号" id="cus_order_sn"/>
        </div>
      </div>
      
            <div class="weui-cell" >
        <div class="weui-cell__hd"><label class="weui-label">送货公司：</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="cus_name" value="{$delivery.cus_name}" id="cus_name" placeholder="输入送货公司"/>
        </div>
      </div>
      
            <div class="weui-cell" >
        <div class="weui-cell__hd"><label class="weui-label">送货地址：</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="delivery_address" value="{$delivery.delivery_address}" id="delivery_address" placeholder="输入送货地址"/>
        </div>
      </div>
            <div class="weui-cell" >
        <div class="weui-cell__hd"><label class="weui-label">收货人：</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="contacts" value="{$delivery.contacts}" id="contacts" placeholder="输入联系人"/>
        </div>
      </div>
      
        <div class="weui-cell" >
        <div class="weui-cell__hd"><label class="weui-label">收货电话：</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="contacts_tel" value="{$delivery.contacts_tel}" id="contacts_tel" placeholder="输入收货电话"/>
        </div>
      </div>
      
            <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">关联入库：</label></div>
        <div class="weui-cell__bd" style="position:relative;">
        <input type="hidden" name="input_id" id="input_id" value="{$delivery.relation_input_id}" />
          <input class="weui-input" type="text" readonly="readonly" name="input_sn" value="{$delivery.input_sn_list}" placeholder="关联入库单" id="input_sn" />
          <button type="button" style="position: absolute;right:0;top:-2px;" class="weui-btn weui-btn_mini weui-btn_primary" id="search_input">查找</button>
        </div>
      </div>
       
       <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">关联采购：</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" readonly="readonly" name="po_sn" value="{$delivery.po_sn}" placeholder="关联采购单" id="po_sn" />
        </div>
      </div>
      
       <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">物流单号：</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="delivery_sn" value="{$delivery.delivery_sn}" placeholder="请输入物流单号" id="delivery_sn" />
        </div>
      </div>
      
       <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">交货方式：</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="delivery_way" value="{$delivery.delivery_way}" placeholder="请输入交货方式" id="delivery_way" />
        </div>
      </div>
      
       <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">送货司机：</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="delivery_driver" value="{$delivery.delivery_driver}" placeholder="请输入送货司机" id="delivery_driver" />
        </div>
      </div>
      
       <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">司机电话：</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="driver_tel" value="{$delivery.driver_tel}" placeholder="请输入司机电话" id="driver_tel" />
        </div>
      </div>
      
     <div class="weui-cell" style="padding:2px 10px;"></div>
    <div class="weui-cells__title">备注：</div>
    <div class="weui-cells">
      <div class="weui-cell">
        <div class="weui-cell__bd">
          <textarea class="weui-textarea" name="order_remark" style="height:150px;" placeholder="输入内容">{$delivery.order_remark}</textarea>
        </div>
      </div>
    </div>
    </div>
</div>

<div id="tab2" class="weui-tab__bd-item tab_hide">
<div class="appendList" style="margin-top:10px;"></div>
</div>
</div>
<div class="weui-btn-area bottom-block">
		<div class="weui-flex">
		  <div class="weui-flex__item">
		<button type="submit" class="weui-btn weui-btn_primary" style="border-radius: 0;">保 存</button>
		  </div>
		</div>      
    </div>
</form>
{/block}

{block name="footer"}
<script type="text/javascript">
$('.weui-navbar__item').click(function(){
	$('.weui-navbar__item').removeClass('weui-bar__item--on');
	$(this).addClass('weui-bar__item--on');
	$('.weui-tab__bd-item').hide();
	$('.weui-tab__bd-item').eq($(this).index()).show();
});
var index_layer;
$('#search_company').click(function(){
	index_layer = layer.open({
    	 type: 2,
    	 title: false,
    	 closeBtn: true,
    	 shade: 0.3,
    	 area: ['90%', '90%'],
    	 content: '{:url(\'search_company\')}',
   });	
});
$('#search_input').click(function(){
    var order_id = $('#order_id').val();
    if(!order_id){
		$.toptip('请先选择订单');
		return;
    }
    index_layer = layer.open({
   	 type: 2,
   	 title: false,
   	 closeBtn: true,
   	 shade: 0.3,
   	 area: ['90%', '90%'],
   	 content: '{:url(\'input_order\')}?order_id='+order_id,
  });
});
$("#search_order").click(function () {
    var title = '查找订单';
    var purchase_id = $('#purchase_id').val();
    index_layer = layer.open({
      	 type: 2,
      	 title: false,
      	 closeBtn: true,
      	 shade: 0.3,
      	 area: ['90%', '90%'],
      	 content: '{:url(\'relation_order\')}?purchase_id='+purchase_id,
     });
});

function close_layer(){
	layer.close(index_layer);
}

function client_info(data){
	$('#cus_id').val(data.id);
	$('#company_name').val(data.company_name);
	$('#company_short').val(data.company_short);
	$('#fax').val(data.fax);
	$('#contacts').val(data.user);
	$('#email').val(data.email);
	$('#con_id').val(data.con_id);
	layer.close(index_layer);
}

function goodsList(data){
	console.log(data);
	var html = '';
	for(var i in data){
		var input_css = data[i]['is_show']==true ? 'input-show' : 'input-hide';
		var span_css = data[i]['is_show']==true ? 'inputspan' : 'inputspan-block';
	html +='<div class="weui-form-preview list goods_'+i+'" data-index="'+i+'" data-goods_id="'+data[i]['goods_id']+'">';
	html +='<div class="weui-form-preview__bd">';
	html +='<div class="weui-form-preview__item">';
	html +='<label class="weui-form-preview__label">名称：</label>';
	html +='<span class="weui-form-preview__value">'+data[i]['goods_name']+'</span>';
	html +='</div>';
	html +='<div class="weui-form-preview__item">';
	html +='<label class="weui-form-preview__label">单位：</label>';
	html +='<span class="weui-form-preview__value">'+data[i]['unit']+'</span>';
	html +='</div>';
	html +='<div class="weui-form-preview__item">';
	html +='<label class="weui-form-preview__label">未交数量：</label>';
	html +='<span class="weui-form-preview__value">'+data[i]['diff_number']+'</span>';
	html +='</div>';
	html +='<div class="weui-form-preview__item">';
	html +='<label class="weui-form-preview__label">本次送货数量：</label>';
	html +='<span class="weui-form-preview__value goods_number"><input type="text" class="'+input_css+'" value="'+data[i]['current_send_number']+'" data-current_send_number="'+goods_info[i]['goods_number']+'" oninput="checkNum2(this)" name="current_send_number"/><span class="'+span_css+'">'+data[i]['current_send_number']+'</span></span>';
	html +='</div>';
	html +='<div class="weui-form-preview__item">';
	html +='<label class="weui-form-preview__label">出库数量：</label>';
	html +='<span class="weui-form-preview__value">'+data[i]['add_number']+'</span>';
	html +='</div>';
	html +='<div class="weui-form-preview__item" style="margin-bottom:10px;">';
	html +='<label class="weui-form-preview__label">备注：</label>';
	html +='<span class="weui-form-preview__value remark"><input type="text" class="'+input_css+'" value="'+data[i]['remark']+'" name="remark"/><span class="'+span_css+'">'+data[i]['remark']+'</span></span>';
	html +='</div>';
	html +='</div>';
	html +='<div class="button-block">';
	if(data[i]['is_show']){
	html +='<button type="button" class="weui-btn weui-btn_mini weui-btn_plain-primary update" onclick="_update('+i+')">保存</button>';
	}else{
		html +='<button type="button" class="weui-btn weui-btn_mini weui-btn_plain-primary update" onclick="_update('+i+')">编辑</button>';
		}
	html +='<button type="button" class="weui-btn weui-btn_mini weui-btn_plain-primary" onclick="_delete('+data[i]['goods_id']+')">删除</button>';
	html +='</div></div>';
	}
	$('.appendList').html(html);
}

var goods_info = new Array();
<?php if (!empty($goodslist)){?>
goods_info = <?php echo $goodslist;?>;
goodsList(goods_info);
<?php }?>

function relation_order(data){
	//console.log(data);
	relation_type = 0;
	goods_info = [];
	$('#purchase_date').val(data.purchase_date);
	$('#order_sn').val(data.order_sn);
	$('#order_id').val(data.orderid);
	var purchase_id = $('#purchase_id').val();
	$.get('<?php echo url('rel_order');?>?purchase_id='+purchase_id+'&order_id='+data.orderid,{},function(res){
		if(res.code == 1){
			$('#cus_name').val(res.data.cus_name);
			$('#cus_id').val(res.data.cus_id);
	    	$('#order_sn').val(res.data.order_sn);
	    	$('#cus_order_sn').val(res.data.cus_order_sn);
	    	$('#delivery_address').val(res.data.delivery_address);
	    	$('#contacts').val(res.data.contacts);
	    	$('#contacts_tel').val(res.data.cus_phome);
	    	$('#purchase_money').val(res.data.total_money);
		}else{
			$('#cus_name,#purchase_id,#po_sn,#delivery_way,#cus_id,#order_id,#order_sn,#cus_order_sn,#delivery_address,#contacts,#contacts_tel').val('');
			$.toptip(res.msg);
		}
	});
}

function goods_merge(data){
	console.log(data);
	var po_sn = $('#po_sn').val();
	var purchase_id = $('#purchase_id').val();
	if((purchase_id != '' && purchase_id != data.po_id) || purchase_id == ''){
		$('#po_sn').val(data.po_sn);
		$('#input_sn').val(data.store_sn);
		$('#delivery_way').val(data.delivery_type);
		$('#purchase_id').val(data.po_id);
		$('#input_id').val(data.id);
		var input_id = $('#input_id').val();
	}
	if(purchase_id == data.po_id) {
		var inputsn_arr = $('#input_sn').val().split(',');
		var flag = true;
		for(var i in inputsn_arr) {
			if(data.store_sn == inputsn_arr[i]){
				flag = false;
				break;
			}
		}
		if(!flag) return;
		
		$('#input_id').val($('#input_id').val()+','+data.id);
		$('#input_sn').val($('#input_sn').val()+','+data.store_sn);
		var input_id = $('#input_id').val();
	}
	$.get('<?php echo url('goods_merge');?>',{input_id:input_id,order_id:data.order_id,po_id:data.po_id},function(res){
		goods_info = res;
		goodsList(res);
	});
}

function get_goods(){
	return goods_info;
}

function _update(index){
	if(goods_info[index]['is_show'] == true){
		var current_send_number = $('.goods_'+index+' input[name=current_send_number]').val();
		if(current_send_number == ''){
			current_send_number = $('.goods_'+index+' input[name=current_send_number]').attr('data-current_send_number');
		}
		if(current_send_number != goods_info[index]['add_number']){
			alert('“'+goods_info[index]['goods_name']+'”出库数量和本次出货数量必须等于！');
			return;
		}
		//goods_info[index]['goods_number'] = parseInt(goods_number);
		//goods_info[index]['shop_price'] = _formatMoney(parseFloat(shop_price));
		goods_info[index]['current_send_number'] = current_send_number;
		goods_info[index]['remark'] = $('.goods_'+index+' input[name=remark]').val();
		goods_info[index]['is_show'] = false;
		$('.list').each(function(idx){
			var eIndex = $('.list').eq(idx).attr('data-index');
			if(eIndex != index){
				saveOther(eIndex,true);
			}
		});
		goodsList(goods_info);
		$('.goods_'+index+' .update').text('编辑');
		return;
	}
	goods_info[index]['is_show'] = true;
	$('.goods_'+index+' .update').text('保存');
	$('.goods_'+index+' span.inputspan-block').removeClass('.inputspan-block').addClass('inputspan');
	$('.goods_'+index+' input').show().css('display','inline');
}

function saveOther(eIndex,is_show){
// 	var market_price = $('.goods_'+eIndex+' input[name=market_price]').val();
// 	if(market_price == ''){
// 		market_price = $('.goods_'+eIndex+' input[name=market_price]').attr('data-market_price');
// 	}
	//goods_info[eIndex]['market_price'] = _formatMoney(parseFloat(market_price));
	var current_send_number = $('.goods_'+eIndex+' input[name=current_send_number]').val();
	if(current_send_number == ''){
		current_send_number = $('.goods_'+eIndex+' input[name=current_send_number]').attr('data-current_send_number');
	}
	if(current_send_number != goods_info[eIndex]['add_number']){
		alert('“'+goods_info[eIndex]['goods_name']+'”出库数量和本次出货数量必须等于！');
		return;
	}
	goods_info[eIndex]['remark'] = $('.goods_'+eIndex+' input[name=remark]').val();
	if(!goods_info[eIndex]['is_show']){
		goods_info[eIndex]['is_show'] = false;
	}else{
		goods_info[eIndex]['is_show'] = is_show;
	}
}

function _delete(goods_id){
	var newArr = new Array();
	for(var i in goods_info){
		if(goods_id != parseInt(goods_info[i]['goods_id'])){
			newArr.push(goods_info[i]);
			}
	}
	goods_info = newArr;
	goodsList(goods_info);
}

$(function() {
	
    $("#require_time,#delivery_date").calendar({
    	dateFormat: 'yyyy-mm-dd'
    });

	bindDelete();
    
    function bindDelete(){
		$('body').on('click','.delete-file', function(){
			$(this).parents('li').remove();
		});
    }
    
    $('#uploaderInput').change(function(){
    	$('#saveOrder').ajaxSubmit({
    		data:{type:'file'},
    		success: function(res){
    			if(res.code == 1){
    				var html = '';
        			for(var i in res.data){
    				html += '<li><p>'+res.data[i].oldfilename+' <a href="javascript:;" class="delete-file">删除</a></p>';
					html += '<input type="hidden" name="ext[]" value="'+res.data[i]['ext']+'" />';
					html += '<input type="hidden" name="oldfilename[]" value="'+res.data[i]['oldfilename']+'" />';
					html += '<input type="hidden" name="files[]" value="'+res.data[i].path+'"/>';
    				html +='</li>';
        			}
    				$('#uploaderFiles').append(html);
    				bindDelete();
    			}else{
    				$.toptip(res.msg);
    			}
    		}
    	});
    });
    
    $('#saveOrder').submit(function(){
    	$('button[type=submit]').attr('disabled','disabled').text('保存中...');
    	$(this).ajaxSubmit({
    		data:{goods_info:goods_info,type:'save'},
    		success: function(res){
    			if(res.code == 0){
    				$.toptip(res.msg);
    				}else{
    				setTimeout(() => {
    					$.toptip(res.msg,'success');},2000);
    				}
    		},
    	     complete: function(XMLHttpRequest, textStatus) { 
    				//toastr.success('ok');
    				$('button[type=submit]').removeAttr('disabled').text('保 存');
    		     },
    	     error: function(){
    	    	 $.toptip('网络错误!');} 
    	});
    	return false;
    });
});
</script>
{/block}