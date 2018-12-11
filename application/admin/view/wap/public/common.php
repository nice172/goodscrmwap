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
<style>.weui-navbar{top:45px !important;}</style>
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
nav .nav-left{width:15%;float:left;height:45px;line-height:45px;text-align:center;}
nav .nav-center{width:70%;float:left;height:45px;line-height:45px;text-align:center;}
nav .nav-right{width:15%;float:right;height:45px;line-height:45px;text-align:center;}
.modal{background:rgba(0,0,0,0.1);position:fixed;top:0;z-index:9999999;display:none;}
.modal ul{text-align:center;width:150px;position:fixed;top:0;right:-150px;background:#fff;box-shadow:0 0 30px #888888;}
.modal ul li a{color:#000;display: block;}
.modal ul li {height:40px;border-bottom:1px solid #eee;line-height:40px;}
.menu-head h3 strong{color:#333;}
</style>
</head>
<body ontouchstart>
<?php 
$method_name = ['get_goods','search_company','relation_order','input_order'];
if (ACTION_NAME != 'email'){?>
<nav>
<div class="nav-left">
<?php if (!in_array(ACTION_NAME, $method_name)){?>
<a style="color: #fff;" href="{:url('index/index')}"><i class="fa fa-home fa-fw" style="font-size:18px;"></i></a>
<?php }?>
</div>
<div class="nav-center">{$title}</div>
<div class="nav-right">
<?php if (!in_array(ACTION_NAME, $method_name)){?>
<i class="fa fa-list-ul" aria-hidden="true" style="font-size:18px;"></i>
<?php }?>
</div>
</nav>
<div class="main" style="padding-top:25px;">
<?php }else{?>
<div class="main">
<?php }?>
{block name="main"}{/block}
</div>
<div id="modal" class="modal">
<ul>
<li class="menu-head"><h3><strong>菜单</strong></h3></li>
<li class="li-a"><a href="{:url('baojia/index')}">报价管理</a></li>
<li class="li-a"><a href="{:url('order/index')}">订单管理</a></li>
<li class="li-a"><a href="{:url('purchase/index')}">采购管理</a></li>
<li class="li-a"><a href="{:url('store/relation')}">库存管理</a></li>
<li class="li-a"><a href="{:url('delivery/index')}">送货管理</a></li>
<li class="li-a"><a href="{:url('login/logout')}">退出系统</a></li>
</ul>
</div>
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
var layer_ = '';
function send_email(type,e,email){
	if(!type) type = '';
	if(!e) e = '';
	if(!email) email = '';
	layer_ = layer.open({
    	 type: 2,
    	 title: false,
    	 closeBtn: true,
    	 shade: 0.3,
    	 area: ['90%', '80%'],
    	 content: "{:url('email')}?type="+type+"&id="+e+'&email='+email,
   });
}
function layer_close(){
	layer.close(layer_);
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
var w = $(window).width();
var h = $(window).height();
$('.modal').css({
	width: w,height: h,
});
$('.modal ul').css('height',h+'px');
$('.fa-list-ul').click(function(){
	$('.modal').fadeIn();
	$('.modal ul').animate({right:'0px'},function(){});
});
$('.modal').click(function(e){
	var _this = $(this);
	if(e.target.nodeName == 'DIV'){
		$('.modal ul').animate({right:'-150px'},function(){
			_this.fadeOut();});
	}
});
// var obj = document.getElementById('modal');
// obj.addEventListener('touchmove', function(event) {
//     if (event.targetTouches.length == 1) {
// 　　　　 	event.preventDefault();
//         //var touch = event.targetTouches[0];
//         //obj.style.left = touch.pageX-50 + 'px';
//         //obj.style.top = touch.pageY-50 + 'px';
// 		$('.modal ul').animate({right:'-150px'},function(){
// 			$('.modal').fadeOut();});
//       }
// }, false);
</script>
</body>
</html>