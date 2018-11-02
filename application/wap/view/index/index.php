<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>首页-{:Config('syc_webname')}</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<meta name="description" content="">
<link rel="stylesheet" href="__UI__/lib/weui.min.css">
<link rel="stylesheet" href="__UI__/css/jquery-weui.css">
<link rel="stylesheet" href="__WAP__/css/demos.css">
</head>

<body ontouchstart>
<!--     <header class='demos-header'> -->
<!--       <h1 class="demos-title">Grid</h1> -->
<!--     </header> -->

    <div class="weui-grids">
      <a href="" class="weui-grid js_grid">
        <div class="weui-grid__icon">
          <img src="__UI__/demos/images/icon_nav_button.png" alt="">
        </div>
        <p class="weui-grid__label">报价管理</p>
      </a>
      <a href="" class="weui-grid js_grid">
        <div class="weui-grid__icon">
          <img src="__UI__/demos/images/icon_nav_cell.png" alt="">
        </div>
        <p class="weui-grid__label">订单管理</p>
      </a>
      <a href="" class="weui-grid js_grid">
        <div class="weui-grid__icon">
          <img src="__UI__/demos/images/icon_nav_cell.png" alt="">
        </div>
        <p class="weui-grid__label">采购管理</p>
      </a>
      <a href="" class="weui-grid js_grid">
        <div class="weui-grid__icon">
          <img src="__UI__/demos/images/icon_nav_cell.png" alt="">
        </div>
        <p class="weui-grid__label">库存管理</p>
      </a>
      <a href="" class="weui-grid js_grid">
        <div class="weui-grid__icon">
          <img src="__UI__/demos/images/icon_nav_toast.png" alt="">
        </div>
        <p class="weui-grid__label">送货管理</p>
      </a>
      <a href="" class="weui-grid js_grid">
        <div class="weui-grid__icon">
          <img src="__UI__/demos/images/icon_nav_dialog.png" alt="">
        </div>
        <p class="weui-grid__label">退出</p>
      </a>
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

    <script>
      $('.login').submit(function(){
          var username = $('input[name=username]').val();
          var password = $('input[name=password]').val();
          var remember = $('input[name=remember]:checked').val();
          //if(!tel || !/1[3|4|5|7|8]\d{9}/.test(tel)) $.toptip('请输入手机号');
          //else if(!code || !/\d{6}/.test(code)) $.toptip('请输入六位手机验证码');
          //else $.toptip('提交成功', 'success');
          if(username == '') {
        	  $.toptip('请输入登录账户');return false;}
          if(password == '') {
        	  $.toptip('请输入登录密码');return false;}
    	  $(this).ajaxSubmit({
			success: function(res){
				if(res.code == 1){
					$.toptip(res.msg,'success');
					setTimeout(() => {
						window.location.href=res.url;},1500);
					}else{
						 $.toptip(res.msg);
						 setTimeout(() => {
							 window.location.reload();},1500);
						}
			}
          });
		return false;
      });
      
      $('.fm-button2').click(function(){
			$.ajax({
			url: '<?php echo url('Login/clear');?>',
			success:function(res){
				window.location.reload();}
				});
      });
    </script>
  </body>
</html>