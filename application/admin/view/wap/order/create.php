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
.list .goods_number input,.list .purchase_number input,.list .remark input{border:1px solid #e5e5e5;width:80% !important;padding:5px;}
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
.weui-picker-overlay, .weui-picker-container{bottom:45px;}
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
<form class="form-horizontal" enctype="multipart/form-data" action="<?php echo url('create_do');?>" id="saveOrder" method="post">
    <input type="hidden" name="order_id" value="{$data.id}"  id="id" />
    <input type="hidden" name="cus_id" value="{$data.cus_id}"  id="cus_id" />
	<div style="margin-bottom: 60px;">
	<div id="tab1" class="weui-tab__bd-item" style="display: block;">
    <div class="weui-cells weui-cells_form">
      <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">PO号码：</label></div>
        <div class="weui-cell__bd">
          <input type="text" class="weui-input" readonly="readonly" value="{$po_sn}" name="po_sn" id="po_sn">
        </div>
      </div>
      <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">关联订单：</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" readonly="readonly" value="{$data.order_sn}" name="order_sn" id="order_sn"/>
        </div>
      </div>
      
      <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">订购日期：</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" readonly="readonly" value="{$data.create_time|date='Y-m-d',###}" name="create_date" id="create_date"/>
        </div>
      </div>
      
      <div class="weui-cell" >
        <div class="weui-cell__hd"><label class="weui-label">供应商：</label></div>
        <div class="weui-cell__bd" style="position:relative;">
          <input type="hidden" name="supplier_id" id="supplier_id" />
          <input class="weui-input" type="text" readonly="readonly" placeholder="请选择供应商" name="select_supplier" id="select_supplier" />
        </div>
      </div>
      
      <div class="weui-cell" >
        <div class="weui-cell__hd"><label class="weui-label">客户单号：</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" readonly="readonly" type="text" value="{$data.cus_order_sn}" name="cus_order_sn" id="cus_order_sn"/>
        </div>
      </div>
      
            <div class="weui-cell" >
        <div class="weui-cell__hd"><label class="weui-label">联系人：</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="contacts" id="contacts" />
        </div>
      </div>
      
            <div class="weui-cell" >
        <div class="weui-cell__hd"><label class="weui-label">电话号码：</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="cus_phome" id="cus_phome" />
        </div>
      </div>
      
            <div class="weui-cell" >
        <div class="weui-cell__hd"><label class="weui-label">E-MAIL：</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="email" id="email"/>
        </div>
      </div>
            <div class="weui-cell" >
        <div class="weui-cell__hd"><label class="weui-label">传真号码：</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="fax" id="fax" />
        </div>
      </div>
            <div class="weui-cell" >
        <div class="weui-cell__hd"><label class="weui-label">送货公司：</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" value="{$client.cus_name}" name="delivery_company" id="delivery_company" />
        </div>
      </div>
      
      <div class="weui-cell" >
        <div class="weui-cell__hd"><label class="weui-label">送货地址：</label></div>
        <div class="weui-cell__bd" style="position:relative;">
          <input type="hidden" name="conid" id="conid" />
          <input class="weui-input" type="text" readonly="readonly" placeholder="请选择送货地址" name="delivery_address" id="delivery_address" />
        </div>
      </div>
      
            <div class="weui-cell" >
        <div class="weui-cell__hd"><label class="weui-label">收货人：</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="receiver" id="receiver" />
        </div>
      </div>
      
            <div class="weui-cell" >
        <div class="weui-cell__hd"><label class="weui-label">收货电话：</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="receivernum" id="receivernum" />
        </div>
      </div>
      
      <div class="weui-cell" >
        <div class="weui-cell__hd"><label class="weui-label">交易类别：</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="transaction_type" placeholder="请选择交易类别" id="transaction_type" />
        </div>
      </div>
      	
      <div class="weui-cell" >
        <div class="weui-cell__hd"><label class="weui-label">付款条件：</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="payment" placeholder="请选择付款条件" id="payment" />
        </div>
      </div>
      
      <div class="weui-cell" >
        <div class="weui-cell__hd"><label class="weui-label">交货方式：</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="delivery_type" placeholder="请选择交货方式" id="delivery_type" />
        </div>
      </div>
      
      <div class="weui-cell" >
        <div class="weui-cell__hd"><label class="weui-label">税率：</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="tax" placeholder="请选择税率" id="tax" />
        </div>
      </div>
      	
     <div class="weui-cell" style="padding:2px 10px;"></div>
    <div class="weui-cells__title">备注：</div>
    <div class="weui-cells">
      <div class="weui-cell">
        <div class="weui-cell__bd">
          <textarea class="weui-textarea" name="content" style="height:150px;" placeholder="输入内容">{$remark}</textarea>
        </div>
      </div>
    </div>
    </div>
</div>

<div id="tab2" class="weui-tab__bd-item tab_hide">
<!-- <p style="padding:30px 0 5px 10px;"><a href="javascript:;" class="get_goods">添加商品</a></p> -->
<div class="appendList" style="padding-top:25px;"></div>
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
$('.get_goods').click(function(){
    if($('#cus_id').val() == ''){
		alert('请先选择客户');
		return;
    }
	var title = '选择商品';
    index_layer = layer.open({
   	 type: 2,
   	 title: false,
   	 closeBtn: true,
   	 shade: 0.3,
   	 area: ['90%', '90%'],
   	 content: '{:url(\'get_goods\')}?cus_id='+$('#cus_id').val(),
  });
});
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

var goods_info = new Array();
<?php if(!empty($data['goodsInfo'])){ foreach ($data['goodsInfo'] as $goods){?>
goods_info.push(<?php echo $goods;?>);
<?php }}?>
if(goods_info.length > 0){
	goodsList(goods_info);
}
function put(data){
	var flag = false;
	for(var i in goods_info){
		if(goods_info[i]['goods_id'] == data.goods_id){
			flag = true;
			break;
		}
	}
	if(!flag){
		data['is_show'] = true;
		goods_info.push(data);
	}
	goodsList(goods_info);
}

function goodsList(data){
	console.log(data);
	var html = '';
	for(var i in data){
		goods_info[i]['totalMoney'] = _formatMoney(goods_info[i]['purchase_number']*goods_info[i]['shop_price']);
		var input_css = data[i]['is_show']==true ? 'input-show' : 'input-hide';
		var span_css = data[i]['is_show']==true ? 'inputspan' : 'inputspan-block';
	html +='<div class="weui-form-preview list goods_'+i+'" data-index="'+i+'" data-goods_id="'+data[i]['goods_id']+'">';
	html +='<div class="weui-form-preview__bd">';
	html +='<div class="weui-form-preview__item">';
	html +='<label class="weui-form-preview__label">名称：</label>';
	html +='<span class="weui-form-preview__value">'+data[i]['goods_name']+'</span>';
	html +='</div>';
	html +='<div class="weui-form-preview__item" style="margin-bottom:10px;">';
	html +='<label class="weui-form-preview__label">单位：</label>';
	html +='<span class="weui-form-preview__value">'+data[i]['unit']+'<span style="padding-left:30px;" class="store_number">库存：'+data[i]['store_number']+'</span>';
	html +='</div>';
	html +='<div class="weui-form-preview__item" style="margin-bottom:10px;">';
	html +='<label class="weui-form-preview__label">采购单价：</label>';
	html +='<span class="weui-form-preview__value shop_price"><input type="text" class="price_input '+input_css+'" data-shop_price="'+data[i]['shop_price']+'" oninput="checkNum(this)" value="'+data[i]['shop_price']+'" name="shop_price"/><span class="'+span_css+'">'+data[i]['shop_price']+'</span></span></span>';
	html +='</div>';
	html +='<div class="weui-form-preview__item" style="margin-bottom:10px;">';
	html +='<label class="weui-form-preview__label">采购数量：</label>';
	html +='<span class="weui-form-preview__value purchase_number"><input type="text" class="'+input_css+'" value="'+data[i]['purchase_number']+'" data-purchase_number="'+goods_info[i]['purchase_number']+'" oninput="checkNum2(this)" name="purchase_number"/><span class="'+span_css+'">'+data[i]['purchase_number']+'</span></span>';
	html +='</div>';
	html +='<div class="weui-form-preview__item" style="margin-bottom:10px;">';
	html +='<label class="weui-form-preview__label">总价格：'+goods_info[i]['totalMoney']+'</label>';
	html +='<span class="weui-form-preview__value totalMoney"></span>';
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

function get_goods(){
	return goods_info;
}

function _update(index){
	if(goods_info[index]['is_show'] == true){
		var shop_price = $('.goods_'+index+' input[name=shop_price]').val();
		if(shop_price == ''){
			shop_price = $('.goods_'+index+' input[name=shop_price]').attr('data-shop_price');
		}
		if(parseFloat(shop_price) > goods_info[index]['shop_price']){
			if(!confirm('采购单价高于关联订单商品单价')){
				return;
			}
		}
		var purchase_number = $('.goods_'+index+' input[name=purchase_number]').val();
		if(purchase_number == ''){
			purchase_number = $('.goods_'+index+' input[name=purchase_number]').attr('data-purchase_number');
		}
		goods_info[index]['purchase_number'] = parseInt(purchase_number);
		goods_info[index]['shop_price'] = _formatMoney(parseFloat(shop_price));
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
	/*
	var market_price = $('.goods_'+eIndex+' input[name=market_price]').val();
	if(market_price == ''){
		market_price = $('.goods_'+eIndex+' input[name=market_price]').attr('data-market_price');
	}
	goods_info[eIndex]['market_price'] = _formatMoney(parseFloat(market_price));
	*/
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
	
    $("#require_time").calendar({
    	dateFormat: 'yyyy-mm-dd'
    });

    $("#transaction_type").picker({
    	  title: "请选择交易类别",
    	  cols: [
    	    {
    	      textAlign: 'center',
    	      values: [{foreach name="$trans_type" item="v"}'{$v}'{if condition="$key<count($trans_type)-1"},{/if}{/foreach}]
    	    }
    	  ]
    	});
    $("#payment").picker({
  	  title: "请选择付款条件",
  	  cols: [
  	    {
  	      textAlign: 'center',
  	      values: [{foreach name="$payment" item="v"}'{$v}'{if condition="$key<count($payment)-1"},{/if}{/foreach}]
  	    }
  	  ]
  	});
    $("#delivery_type").picker({
    	  title: "请选择交货方式",
    	  cols: [
    	    {
    	      textAlign: 'center',
    	      values: [{foreach name="$delivery_type" item="v"}'{$v}'{if condition="$key<count($delivery_type)-1"},{/if}{/foreach}]
    	    }
    	  ]
    	});
    $("#tax").picker({
  	  title: "请选择税率",
  	  cols: [
  	    {
  	      textAlign: 'center',
  	      values: [{foreach name="$tax" item="v"}'{$v}'{if condition="$key<count($tax)-1"},{/if}{/foreach}]
  	    }
  	  ]
  	});
    
    $("#select_supplier").select({
    	  title: "请选择供应商",
    	  items: [
    		  {foreach name="$supplier" key="key" item="v"}
    	    {
    	      title: "{$v.supplier_name}",
    	      value: "{$v.id}",
    	    }{if condition="$key<count($supplier)-1"},{/if}
    	    {/foreach}
    	  ],
    	  onChange: function(e){
  			$('#supplier_id').val(e.values);
  			var supplier_id = e.values;
			if(supplier_id){
				$.get('{:url(\'purchase/getsupplier\')}?supid='+supplier_id,{},function(data){
					if(data.code == 1){
						var data = data.data;
						$('#cus_phome').val(data.cus_phome);
						$('#fax').val(data.fax);
						$('#contacts').val(data.contacts);
						$('#email').val(data.email);
						$('#payment_type').val(data.supplier_payment);
					}
				});
			}else{
				$('#cus_phome,#fax,#contacts,#email,#payment_type').val('');
			}
        	 }
    	});
	
    $("#delivery_address").select({
  	  title: "请选择送货地址",
  	  items: [
  		  {foreach name="$contacts" key="key" item="v"}
  	    {
  	      title: "{$v.con_address}",
  	      value: "{$v.con_id}",
  	    }{if condition="$key<count($contacts)-1"},{/if}
  	    {/foreach}
  	  ],
  	  onChange: function(e){
			$('#conid').val(e.values);
			var con_id = e.values;
				if(con_id){
				
				$.get('{:url(\'purchase/getaddress\')}?conid='+con_id,{},function(data){
					if(data.code == 1){
						var data = data.data;
						$('#receiver').val(data.receiver);
						$('#receivernum').val(data.receivernum);
					}
				});
			}else{
				$('#receiver,#receivernum').val('');
			}
      	 }
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
    				$.toptip(res.msg,'success');
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