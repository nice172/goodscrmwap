{extend name="public/common" /}
{block name="header"}
<style>
.weui-label,input,textarea{font-size:13px !important;}
.weui-label {width:60px !important;text-align:right;}
.weui-cells__title {color:#000;}
</style>
{/block}
{block name="main"}
<form class="form-horizontal" id="sendemail" method="post" action="<?php echo url('sendemail');?>">
	<div style="margin-bottom: 60px;">
	          <input type="hidden" name="type" value="<?php echo $data['type'];?>" />
        <input type="hidden" name="id" value="<?php echo $data['id'];?>" />
    <div class="weui-cells weui-cells_form">
      <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">收件人：</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="email" value="<?php echo $data['email'];?>" placeholder="输入收件人"/>
        </div>
      </div>
      <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">抄送：</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="copyto" placeholder="输入抄送人"/>
        </div>
      </div>
      <div class="weui-cell" style="border-bottom: 1px solid #e5e5e5;">
        <div class="weui-cell__hd"><label class="weui-label">主题：</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="subject" placeholder="输入主题"/>
        </div>
      </div>
    <div class="weui-cells__title">正文：</div>
    <div class="weui-cells">
      <div class="weui-cell">
        <div class="weui-cell__bd">
          <textarea class="weui-textarea" name="content" style="height:150px;" placeholder="输入正文内容"></textarea>
        </div>
      </div>
    </div>
    </div>
    
      <input type="hidden" name="files" value="<?php echo $data['files'];?>" />
      <p style="padding-left:10px;">附件：<a target="_blank" href="<?php echo mb_substr($data['files'], 1);?>"><?php echo mb_substr($data['files'], 6);?></a></p>
    </div>
    
    <div class="weui-btn-area" style="position:fixed;bottom:0;width:100%;margin:0;">
		<div class="weui-flex">
		  <div class="weui-flex__item">
		<button type="submit" class="weui-btn weui-btn_primary" style="border-radius: 0;">发 送</button>
		  </div>
		</div>      
    </div>
</form>
{/block}
{block name="footer"}
<script type="text/javascript">
$(function() {

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