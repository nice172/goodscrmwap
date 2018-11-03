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
<link rel="stylesheet" href="__WAP__/css/demos.css">
<style type="text/css">
body{
	background:#f6f6f6;
}
.main {
	margin-top:100px;
	margin-bottom:60px;
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
</style>
</head>

<body ontouchstart>
  <div class="weui-navbar">
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
    <div id="tab1" class="weui-tab__bd-item weui-tab__bd-item--active">
      <h1>页面一</h1>
    </div>
    <div id="tab2" class="weui-tab__bd-item">
      <h1>页面二</h1>
    </div>
  </div>
</div>
</div>
<div class="bottom">

</div>
<script src="__UI__/lib/jquery-2.1.4.js"></script>
<script src="__UI__/lib/fastclick.js"></script>
<script>
  $(function() {
    FastClick.attach(document.body);
  });
</script>
<script src="__UI__/js/jquery-weui.js"></script>
<script src="__WAP__/js/jquery.form.js"></script>
<script type="text/javascript">

</script>
</body>
</html>