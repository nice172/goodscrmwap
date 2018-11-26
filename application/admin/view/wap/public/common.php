<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>{:Config('syc_webname')}-{$title}</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<meta name="description" content="">
<link rel="stylesheet" href="__UI__/lib/weui.min.css">
<link rel="stylesheet" href="__UI__/css/jquery-weui.css">
<link rel="stylesheet" href="/assets/plugins/layui/css/layui.css" />
<link rel="stylesheet" href="__WAP__/css/demos.css">
<link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
{block name="header"}{/block}
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
function checkNum(obj){
	obj.value = obj.value.replace(/[^\d.]/g,"");//清除"数字"和"."以外的字符
	obj.value = obj.value.replace(/^\./g,"");//验证第一个字符是数字而不是
	obj.value = obj.value.replace(/\.{2,}/g,".");//只保留第一个. 清除多余的
	obj.value = obj.value.replace(".","$#$").replace(/\./g,"").replace("$#$",".");
	obj.value = obj.value.replace(/^(\-)*(\d+)\.(\d\d).*$/,'$1$2.$3');//只能输入三个小数.(\d\d\d) 修改个数  加\d
}
function _formatMoney(num){
	num = num.toString().replace(/\$|\,/g,'');
	if(isNaN(num))
	num = "0";
	sign = (num == (num = Math.abs(num)));
	num = Math.floor(num*100+0.50000000001);
	cents = num%100;
	num = Math.floor(num/100).toString();
	if(cents<10)
	cents = "0" + cents;
	return (((sign)?'':'-') + num + '.' + cents);
}
function checkNum2(obj){
	obj.value = obj.value.replace(/[^\d]/g,"");//清除"数字"和"."以外的字符
	obj.value = obj.value.replace(/^\./g,"");//验证第一个字符是数字而不是
	obj.value = obj.value.replace(/\.{1}/g,"");//如果有一个. 就清除
}
</script>
<style>
.search{top:45px !important;}
nav{height:45px;background:#1aad19;color:#fff;position:fixed;top:0;width:100%;z-index:99999;}
nav .nav-left{width:15%;float:left;height:45px;}
nav .nav-center{width:70%;float:left;height:45px;line-height:45px;text-align:center;}
nav .nav-right{width:15%;float:right;height:45px;line-height:45px;text-align:center;}
.modal{background:rgba(0,0,0,0.3);position:fixed;top:0;z-index:9999999;display:none;}
</style>
</head>
<body ontouchstart>
<?php if (ACTION_NAME != 'email'){?>
<nav>
<div class="nav-left"></div>
<div class="nav-center">{$title}</div>
<div class="nav-right"><i class="fa fa-list-ul" aria-hidden="true" style="font-size:18px;"></i></div>
</nav>
<div class="main" style="padding-top:25px;">
<?php }else{?>
<div class="main">
<?php }?>
{block name="main"}{/block}
</div>
<div class="modal"></div>
<script src="__UI__/lib/jquery-2.1.4.js"></script>
<script src="__UI__/lib/fastclick.js"></script>
<script src="__UI__/js/jquery-weui.js"></script>
<script src="__WAP__/js/jquery.form.js"></script>
<script src="/assets/plugins/layui/layui.all.js"></script>
{block name="footer"}{/block}
<script type="text/javascript">
$(function() {
    FastClick.attach(document.body);
  });
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
function checkNum(obj){
	obj.value = obj.value.replace(/[^\d.]/g,"");//清除"数字"和"."以外的字符
	obj.value = obj.value.replace(/^\./g,"");//验证第一个字符是数字而不是
	obj.value = obj.value.replace(/\.{2,}/g,".");//只保留第一个. 清除多余的
	obj.value = obj.value.replace(".","$#$").replace(/\./g,"").replace("$#$",".");
	obj.value = obj.value.replace(/^(\-)*(\d+)\.(\d\d).*$/,'$1$2.$3');//只能输入三个小数.(\d\d\d) 修改个数  加\d
}
function _formatMoney(num){
	num = num.toString().replace(/\$|\,/g,'');
	if(isNaN(num))
	num = "0";
	sign = (num == (num = Math.abs(num)));
	num = Math.floor(num*100+0.50000000001);
	cents = num%100;
	num = Math.floor(num/100).toString();
	if(cents<10)
	cents = "0" + cents;
	return (((sign)?'':'-') + num + '.' + cents);
}
function checkNum2(obj){
	obj.value = obj.value.replace(/[^\d]/g,"");//清除"数字"和"."以外的字符
	obj.value = obj.value.replace(/^\./g,"");//验证第一个字符是数字而不是
	obj.value = obj.value.replace(/\.{1}/g,"");//如果有一个. 就清除
}
$('.fa-list-ul').click(function(){
	var w = $(window).width();
	var h = $(window).height();
	$('.modal').css({
		width: w,height: h,
	}).fadeIn();
	$('.modal').click(function(){
		$(this).fadeOut();
	});
});
</script>
</body>
</html>