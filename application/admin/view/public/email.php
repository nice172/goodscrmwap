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
  
        <div class="modal-body">
        
						<div class="sub-button-line form-horizontal">
                            <form class="form-horizontal">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">收件人：</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="email" name="email[]" />
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">抄送：</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="copyto" name="copyto" />
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">主题：</label>
    <div class="col-sm-10">
      <input type="text" name="subject" class="form-control" id="subject" />
    </div>
  </div>
    <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">内容：</label>
    <div class="col-sm-10">
    <div id="editor" style="min-height:200px;">
        <p>欢迎使用 <b>wangEditor</b> 富文本编辑器</p>
    </div>
    </div>
  </div>
</form>
                        </div>
                        <div style="clear: both;"></div>
                        
                       
<div class="row">
                    <div class="col-lg-12">
                       

                <!--内容结束-->
            </div>
        </div>
                        

        </div>
        <div class="modal-footer" style="border:none;">
        	<button class="btn btn-primary">发送</button>
			<button class="btn btn-default windowClose">关闭</button>
        </div>

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
});
</script>
</body>
</html>