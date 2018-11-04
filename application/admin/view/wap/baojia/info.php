<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>{$title}</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<meta name="description" content="">
<link rel="stylesheet" href="__UI__/lib/weui.min.css">
<link rel="stylesheet" href="__UI__/css/jquery-weui.css">
<link rel="stylesheet" href="/assets/plugins/layui/css/layui.css" />
<link rel="stylesheet" href="__WAP__/css/demos.css">
<style type="text/css">
body{
	background:#f6f6f6;
}
.main {
	margin-top:40px;
}
.block10{
	margin-top:10px;
}
.clear{
	clear:both;
}
.bottom {
	position:fixed;
	bottom:0px;
	width:100%;
	height:50px;
	background:#1aad19;
	color:#fff;
	text-align:center;
	line-height:50px;
}
.bottom .item {
	width:50%;
	float:left;
}
.bottom .item a{
	display:block;
	color:#fff;
}
.bottom .left-box a{
	border-right:1px solid #fff;
}

.goods_list .weui-form-preview__value{
	text-align:left;
	line-height:1.2;
	padding-top:8px;
}
.goods_list .weui-form-preview__label{
	line-height:1.2;
	padding-top:8px;
}
</style>
</head>

<body ontouchstart>
  <div class="weui-navbar" style="position:fixed;top:0;">
    <a class="weui-navbar__item weui-bar__item--on" href="javascript:;">
     基本信息
    </a>
    <a class="weui-navbar__item" href="javascript:;">
      商品
    </a>
  </div>
<div class="main">
<!-- 容器 -->
<div class="weui-tab">
  <div class="weui-tab__bd">
    <div id="tab1" class="weui-tab__bd-item" style="display: block;">
<div class="weui-form-preview">
      <div class="weui-form-preview__bd">
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">报价单号：</label>
          <span class="weui-form-preview__value">{$data.order_sn}</span>
        </div>
        
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">报价日期：</label>
          <span class="weui-form-preview__value">{$data.create_time|date="Y-m-d",###}</span>
        </div>
        
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">客户名称：</label>
          <span class="weui-form-preview__value">{$data.company_name}</span>
        </div>
        
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">联系人：</label>
          <span class="weui-form-preview__value">{$data.contacts}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">E-MAIL：</label>
          <span class="weui-form-preview__value">{$data.email}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">跟单员：</label>
          <span class="weui-form-preview__value">{$data.order_handle}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">状态：</label>
          <span class="weui-form-preview__value">
          {if condition="$data.status==1"}已发送{else}未发送&nbsp;&nbsp;<button type="button" onclick="send(this,{$data.id})" class="weui-btn weui-btn_mini weui-btn_primary">发送邮件</button>{/if}
          </span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">创建日期：</label>
          <span class="weui-form-preview__value">{$data.create_time|date="Y-m-d H:i:s",###}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">备注信息：</label>
          <span class="weui-form-preview__value" style="text-align: left;">{$data.order_remark}</span>
        </div>
      </div>
</div>
    </div>
    <div id="tab2" class="weui-tab__bd-item">
    {volist name="goodsList" id="vo" key="key"  empty="$empty"}
<div class="weui-form-preview" style="margin-bottom: 5px;">
      <div class="weui-form-preview__bd goods_list">
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">名称：</label>
          <span class="weui-form-preview__value">{$vo.goods_name}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">单位：</label>
          <span class="weui-form-preview__value">{$vo.unit}
          	<span style="float: right;">单价：{$vo.goods_price}元</span>
          </span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">备注：</label>
          <span class="weui-form-preview__value" style="text-align: left;">{$vo.remark}</span>
        </div>
      </div>      
</div>
{/volist}
    </div>
  </div>
</div>
</div>
<!-- 
<div class="bottom">
	<div class="item left-box">
		<a href="javascript:;">确认</a>
	</div>
	<div class="item right-box">
		<a href="javascript:;">发送</a>
	</div>
</div>
-->
<script src="__UI__/lib/jquery-2.1.4.js"></script>
<script src="__UI__/lib/fastclick.js"></script>
<script src="__UI__/js/jquery-weui.js"></script>
<script src="__WAP__/js/jquery.form.js"></script>
<script src="/assets/plugins/layui/layui.all.js"></script>

<script type="text/javascript">
function send_email(type,e,email){
	if(!type) type = '';
	if(!e) e = '';
	if(!email) email = '';
    layer.open({
    	 type: 2,
    	 title: false,
    	 closeBtn: true,
    	 shade: 0.3,
    	 area: ['90%', '80%'],
    	 content: "{:url('email')}?type="+type+"&id="+e+'&email='+email,
   });
}
function send(_this,e) {
    if (!isNaN(e) && e !== null && e !== '') {
        if (!isNaN(e) && e !== null && e !== '') {
            send_email('baojia',e);
        }
        return false;
    }
}
$(function() {
    FastClick.attach(document.body);
    $('.weui-navbar__item').click(function(){
    	$('.weui-navbar__item').removeClass('weui-bar__item--on');
    	$(this).addClass('weui-bar__item--on');
		$('.weui-tab__bd-item').hide();
		$('.weui-tab__bd-item').eq($(this).index()).show();
    });
});
</script>
</body>
</html>