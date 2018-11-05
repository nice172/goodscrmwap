{extend name="public/common" /}
{block name="header"}
<style>
.weui-label,input,textarea{font-size:13px !important;}
.weui-label ,.weui-cells__title {width:70px !important;text-align:right;}
.weui-cells__title {color:#000;padding-left:11px;}
.weui-cell{padding:10px;}
.main{padding-top:25px;margin-bottom:60px;}
.list .weui-form-preview__value{text-align:left;}
.list .remark input{border:1px solid #e5e5e5;width:80% !important;padding:5px;}
.list .price_input {border:1px solid #e5e5e5;width:80px !important;padding:5px;}
.weui-form-preview:before{
	border:none;
}
.weui-form-preview{
	margin-bottom:5px;
}
.button-block{
	border-top:1px solid #f6f6f6;
	text-align:right;
	padding:7px 7px 7px 0;
	margin:0;
}
.list .weui-btn{
	border-radius:50px;
}
.weui-btn+.weui-btn{
	margin-top:0;
	margin-left:10px;
}
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
<form class="form-horizontal" id="sendemail" method="post">
	<div style="margin-bottom: 60px;">
	<div id="tab1" class="weui-tab__bd-item" style="display: block;">
    <div class="weui-cells weui-cells_form">
      <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">报价单号：</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" readonly="readonly" value="CS-Q-<?php echo date('m/dHis').date('sms');?>" name="order_sn" id="order_sn"/>
        </div>
      </div>
      
      <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">报价日期：</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" readonly="readonly" value="<?php echo date('Y-m-d');?>" name="create_date" id="create_date"/>
        </div>
      </div>
      
      <div class="weui-cell" >
        <div class="weui-cell__hd"><label class="weui-label">公司名称：</label></div>
        <div class="weui-cell__bd" style="position:relative;">
          <input class="weui-input" type="text" readonly="readonly" name="company_name" id="company_name" />
          <button type="button" style="position: absolute;right:0;top:-2px;" class="weui-btn weui-btn_mini weui-btn_primary" id="search_company">查找</button>
        </div>
      </div>
      
      <div class="weui-cell" >
        <div class="weui-cell__hd"><label class="weui-label">简称：</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="company_short" placeholder="输入简称" id="company_short"/>
        </div>
      </div>
      
            <div class="weui-cell" >
        <div class="weui-cell__hd"><label class="weui-label">联系人：</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="contacts" id="contacts" placeholder="输入联系人"/>
        </div>
      </div>
      
            <div class="weui-cell" >
        <div class="weui-cell__hd"><label class="weui-label">传真号码：</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="fax" id="fax" placeholder="输入传真号码"/>
        </div>
      </div>
            <div class="weui-cell" >
        <div class="weui-cell__hd"><label class="weui-label">E-MAIL：</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="email" id="email" placeholder="输入E-Mail"/>
        </div>
      </div>
            <div class="weui-cell" style="border-bottom: 1px solid #e5e5e5;">
        <div class="weui-cell__hd"><label class="weui-label">跟单员：</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="order_handle" placeholder="选择跟单员" id="order_handle" />
        </div>
      </div>
      
    <div class="weui-cells__title">备注：</div>
    <div class="weui-cells">
      <div class="weui-cell">
        <div class="weui-cell__bd">
          <textarea class="weui-textarea" name="content" style="height:150px;" placeholder="输入正文内容">{$order_remark}</textarea>
        </div>
      </div>
    </div>
    </div>
</div>

<div id="tab2" class="weui-tab__bd-item">
<p style="padding:30px 0 5px 10px;"><a href="javascript:;" class="get_goods">添加商品</a></p>
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
    	 content: '{:url(\'search_company\')}',
   });	
});
$('.get_goods').click(function(){
	var title = '选择商品';
    index_layer = layer.open({
   	 type: 2,
   	 title: false,
   	 closeBtn: true,
   	 shade: 0.3,
   	 area: ['90%', '90%'],
   	 content: '{:url(\'get_goods\')}',
  });
});
function client_info(data){
	$('#cus_id').val(data.id);
	$('#company_name').val(data.company_name);
	$('#company_short').val(data.company_short);
	$('#fax').val(data.fax);
	$('#contacts').val(data.user);
	$('#email').val(data.email);
	layer.close(index_layer);
}

var goods_info = new Array();
var status = 1;
function put(data){
	var flag = false;
	for(var i in goods_info){
		if(goods_info[i]['goods_id'] == data.goods_id){
			flag = true;
			break;
		}
	}
	if(!flag){
		goods_info.push(data);
	}
	goodsList(goods_info);
}

function goodsList(data){
	var html = '';
	for(var i in data){
	html +='<div class="weui-form-preview list">';
	html +='<div class="weui-form-preview__bd">';
	html +='<div class="weui-form-preview__item">';
	html +='<label class="weui-form-preview__label">名称：</label>';
	html +='<span class="weui-form-preview__value">'+data[i]['goods_name']+'</span>';
	html +='</div>';
	html +='<div class="weui-form-preview__item" style="margin-bottom:10px;">';
	html +='<label class="weui-form-preview__label">单位：</label>';
	html +='<span class="weui-form-preview__value">'+data[i]['unit']+'<span style="padding-left:30px;">单价：<input type="text" class="price_input" value="'+data[i]['market_price']+'" name="market_price['+data[i]['goods_id']+'][]"/>元</span></span>';
	html +='</div>';
	html +='<div class="weui-form-preview__item">';
	html +='<label class="weui-form-preview__label">备注：</label>';
	html +='<span class="weui-form-preview__value remark"><input type="text" value="" name="remark['+data[i]['goods_id']+'][]"/></span>';
	html +='</div>';
	html +='</div>';
	html +='<div class="button-block">';
	html +='<button class="weui-btn weui-btn_mini weui-btn_plain-primary" onclick="_edit('+data[i]['goods_id']+')">编辑</button>';
	html +='<button class="weui-btn weui-btn_mini weui-btn_plain-primary" onclick="_delete('+data[i]['goods_id']+')">删除</button>';
	html +='</div></div>';
	}
	$('.appendList').html(html);
}

function get_goods(){
	return goods_info;
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
	
    FastClick.attach(document.body);

    $("#order_handle").picker({
    	  title: "请选择跟单员",
    	  cols: [
    	    {
    	      textAlign: 'center',
    	      values: {$order_handle_json}
    	    }
    	  ]
    	});
    
    $('#sendemail').submit(function(){
    	$('.clicksend').attr('disabled','disabled');
    	$(this).ajaxSubmit({
    		success: function(res){
    			if(res.code == 0){
    				$.toptip(res.msg);
    				}else{
    				$.toptip(res.msg,'success');
    				}
    		},
    	     complete: function(XMLHttpRequest, textStatus) { 
    				//toastr.success('ok');
    				$('.clicksend').removeAttr('disabled');
    		     },
    	     error: function(){
    	    	 $.toptip('网络错误!');} 
    	});
    	return false;
    });
});
</script>
{/block}