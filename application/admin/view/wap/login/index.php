<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>控制台登陆-{:Config('syc_webname')}</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<meta name="description" content="">
<link rel="stylesheet" href="__UI__/lib/weui.min.css">
<link rel="stylesheet" href="__UI__/css/jquery-weui.css">
<link rel="stylesheet" href="__WAP__/css/demos.css">
<style>
.input_pwd {margin-top:0;}
.input_pwd:before{border-top:none;}
.btn-box{padding:0 10px;}
p{margin-top:8px;width:90%;font-size:12px;text-align:center;line-height:15px;}
</style>
</head>

<body ontouchstart>
    <header class='demos-header'>
      <h2 class="demos-title">{:Config('syc_webname')}</h2>
    </header>
    <form action="{:url('login')}" method="post" class="login">
    <input type="hidden" name="token" value="{$Request.token}" />
    <div class="weui-cells">
      <div class="weui-cell">
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" value="<?php echo $user['user_name'];?>" name="username" tabindex="1" placeholder="登录账户" />
        </div>
      </div>
    </div>
        <div class="weui-cells input_pwd">
      <div class="weui-cell">
        <div class="weui-cell__bd">
          <input class="weui-input" type="password" value="<?php echo $user['user_pwd'];?>" name="password" placeholder="登录密码" />
        </div>
      </div>
    </div>
    <label for="weuiAgree" class="weui-agree">
    <?php if (empty($user['user_name']) && empty($user['user_name'])){?>
      <input id="weuiAgree" type="checkbox" name="remember" value="1" class="weui-agree__checkbox">
      <?php }else{?>
      <input id="weuiAgree" type="checkbox" checked="checked" value="1" name="remember" class="weui-agree__checkbox">
      <?php }?>
      <span class="weui-agree__text">记住登录账号!</span>
    </label>

    <div class="weui-btn-area">
<div class="weui-flex">
  <div class="weui-flex__item">
  	<div class="btn-box">
  	<button type="submit" class="weui-btn weui-btn_primary">登 录</button></div>
  </div>
  <div class="weui-flex__item">
  	<div class="btn-box"><a class="weui-btn weui-btn_primary fm-button2" href="javascript:;">重 置</a></div>
  </div>
</div>      
    </div>
    </form>
    <p style="margin-top:15px;">Power by CSUN(SICHUAN) CHEMICAL CO., LTD</p>
    <p>服务热线：{:config('syc_tousu')}</p>
    

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