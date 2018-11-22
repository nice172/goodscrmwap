<!DOCTYPE html>
<html lang="zh-CN">
<head>
{include file="public/header-model"}
<link href="/assets/plugins/fileinput/fileinput.css" rel="stylesheet" type="text/css" />
<script src="/assets/plugins/fileinput/fileinput.js" type="text/javascript"></script>
<style type="text/css">.w-e-text-container{height:200px !important;}</style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
  <form class="form-horizontal" id="sendemail" method="post" action="<?php echo url('sendemail');?>">
        <input type="hidden" name="type" value="<?php echo $data['type'];?>" />
        <input type="hidden" name="id" value="<?php echo $data['id'];?>" />
        <div class="modal-body">
        
						<div class="sub-button-line form-horizontal">
                            
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">收件人：</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" placeholder="多个邮箱用“;”隔开" value="<?php echo $data['email'];?>" id="email" name="email" />
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">抄送：</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="copyto" placeholder="多个邮箱用“;”隔开" name="copyto" />
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">主题：</label>
    <div class="col-sm-10">
      <input type="text" name="subject" class="form-control" placeholder="请输入主题" id="subject" />
      <input type="hidden" name="files" value="<?php echo $data['files'];?>" />
      <p style="padding-top:10px;">附件：<a target="_blank" href="<?php echo mb_substr($data['files'], 1);?>"><?php echo mb_substr($data['files'], 6);?></a></p>
    </div>
  </div>
    <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">内容：</label>
    <div class="col-sm-10">
    <div id="editor" style="min-height:200px;"></div>
    </div>
  </div>

                        </div>
                        <div style="clear: both;"></div>
                        
                       
<div class="row">
                    <div class="col-lg-12">
                       

                <!--内容结束-->
            </div>
        </div>

        </div>
        <div class="modal-footer" style="border:none;">
        	<button type="submit" class="btn btn-primary clicksend">发送</button>
			<button class="btn btn-default windowClose">关闭</button>
        </div>
</form>
        </div>
    </div>
</div>
<script type="text/javascript" src="/wangEditor/wangEditor.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
    var E = window.wangEditor;
    var editor = new E('#editor');
    editor.create();
	$('.windowClose').click(function(){
		bDialog.close();
	});

$('#sendemail').submit(function(){
	$('.clicksend').attr('disabled','disabled');
	$(this).ajaxSubmit({
		data: {content: editor.txt.html()},
		success: function(res){
			if(res.code == 0){
				toastr.error(res.msg);
				}else{
				toastr.success(res.msg);
				setTimeout(function(){bDialog.close();},2000);
				}
		},
	     complete: function(XMLHttpRequest, textStatus) { 
				//toastr.success('ok');
				$('.clicksend').removeAttr('disabled');
		     },
	     error: function(){
	    	 toastr.error('网络错误!');} 
	});
	return false;
});
	
});
</script>
</body>
</html>