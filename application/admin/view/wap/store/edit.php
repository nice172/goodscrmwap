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
<form class="form-horizontal" enctype="multipart/form-data" id="saveOrder" method="post">
    <input type="hidden" name="id" id="id" value="{$data.id}"/>
    <input type="hidden" name="po_id" id="po_id" value="{$data.po_id}"/>
    <input type="hidden" name="supplier_id" value="{$data.supplier_id}" id="supplier_id" />
	<div style="margin-bottom: 60px;margin-top:65px;">
	<div id="tab1" class="weui-tab__bd-item" style="display: block;">
    <div class="weui-cells weui-cells_form">
      <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">入库单号：</label></div>
        <div class="weui-cell__bd">
          <input type="text" class="weui-input" readonly="readonly" value="ST{:StrOrderOne()}" name="store_sn" id="store_sn">
        </div>
      </div>

      <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">入库时间：</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" readonly="readonly" value="<?php echo date('Y-m-d');?>" name="create_date" id="create_date"/>
        </div>
      </div>
            
      <div class="weui-cell" >
        <div class="weui-cell__hd"><label class="weui-label">采购单号：</label></div>
        <div class="weui-cell__bd" style="position:relative;">
          <input class="weui-input" type="text" value="{$data.po_sn}" name="po_sn" id="po_sn"/>
		  <button type="button" style="position: absolute;right:0;top:-2px;" class="weui-btn weui-btn_mini weui-btn_primary" id="search_company">查找</button>
        </div>
      </div>
      
            <div class="weui-cell" >
        <div class="weui-cell__hd"><label class="weui-label">供应商：</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" value="{$data.supplier_name}" name="supplier_name" id="supplier_name" />
        </div>
      </div>
      
            <div class="weui-cell" >
        <div class="weui-cell__hd"><label class="weui-label">采购日期：</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="purchase_date" value="{$data.purchase_date}" id="purchase_date" />
        </div>
      </div>
      
            <div class="weui-cell" >
        <div class="weui-cell__hd"><label class="weui-label">送货公司：</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="cus_name" value="{$data.cus_name}" id="cus_name"/>
        </div>
      </div>
      
     <div class="weui-cell" style="padding:2px 10px;"></div>
    <div class="weui-cells__title">备注：</div>
    <div class="weui-cells">
      <div class="weui-cell">
        <div class="weui-cell__bd">
          <textarea class="weui-textarea" name="store_remark" style="height:150px;" placeholder="输入内容">{$data.store_remark}</textarea>
        </div>
      </div>
    </div>
    </div>
</div>

<div id="tab2" class="weui-tab__bd-item tab_hide">
<div class="appendList"></div>
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
    	 content: '{:url(\'search_purchase\')}',
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
<?php if(!empty($goodslist)){ ?>
goods_info = {$goodslist};
<?php }?>
if(goods_info.length > 0){
	goodsList(goods_info);
}
function put(data){
	$('#po_id').val(data.id);
	$('#po_sn').val(data.po_sn);
	$('#cus_name').val(data.cus_name);
	$('#purchase_date').val(data.create_date);
	$('#supplier_name').val(data.supplier_name);
	$('#supplier_id').val(data.supplier_id);
	$.get("{:url('load')}?po_id="+data.id,{},function(res){
		goodsList(res.data);
		console.log(res.data);
	});
}

function goodsList(data){
	var html = '';
	for(var i in data){
		var input_css = !data[i]['is_show'] ? 'input-show' : 'input-hide';
		var span_css = data[i]['is_show'] ? 'inputspan' : 'inputspan-block';
		html +='<div class="weui-form-preview list goods_'+i+'" data-index="'+i+'" data-goods_id="'+data[i]['goods_id']+'">';
		html +='<div class="weui-form-preview__bd">';
		html +='<div class="weui-form-preview__item">';
		html +='<label class="weui-form-preview__label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;名&nbsp;称：</label>';
		html +='<span class="weui-form-preview__value" style="overflow: hidden;white-space: nowrap;text-overflow: ellipsis;">'+data[i]['goods_name']+'</span>';
		html +='</div>';
		html +='<div class="weui-form-preview__item" style="margin-bottom:10px;">';
		html +='<label class="weui-form-preview__label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;单&nbsp;位：</label>';
		html +='<span class="weui-form-preview__value">'+data[i]['unit']+'<span style="padding-left:30px;" class="goods_number">采购数量：'+data[i]['goods_number']+'</span>';
		html +='</div>';
		html +='<div class="weui-form-preview__item" style="margin-bottom:10px;">';
		html +='<label class="weui-form-preview__label">入库数量：</label>';
		html +='<span class="weui-form-preview__value input_store"><input type="text" class="price_input '+input_css+'" data-input_store="'+data[i]['input_store']+'" oninput="checkNum2(this)" value="'+data[i]['input_store']+'" name="input_store['+data[i]['goods_id']+'][]"/></span></span>';
		html +='</div>';
		html +='<div class="weui-form-preview__item" style="margin-bottom:10px;">';
		html +='<label class="weui-form-preview__label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;备&nbsp;注：</label>';
		html +='<span class="weui-form-preview__value remark"><input type="text" class="'+input_css+'" name="remark['+data[i]['goods_id']+']"/></span>';
		html +='</div>';
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