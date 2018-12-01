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
  <form class="form-horizontal" id="sendemail" method="post" action="">

        <div class="modal-body">
        
						<div class="sub-button-line form-horizontal">
                            
  <div class="form-group">
    <label for="ticket_date" class="col-sm-2 control-label">开票日期：</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="ticket_date" value="<?php echo date('Y-m-d');?>" name="ticket_date" />
    </div>
  </div>
    <div class="form-group">
    <label for="ticket_sn" class="col-sm-2 control-label">发票号码：</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" value="{:StrOrderOne()}" id="ticket_sn" name="ticket_sn" />
    </div>
  </div>
      <div class="form-group">
    <label for="money" class="col-sm-2 control-label">含税金额：</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="money" name="money" />
    </div>
  </div>
    <div class="form-group">
    <label for="remark" class="col-sm-2 control-label">备注：</label>
    <div class="col-sm-10">
    	<textarea name="remark" id="remark" class="form-control" style="resize:none;"></textarea>
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
        	<button type="submit" class="btn btn-primary clicksend">确定</button>
			<button class="btn btn-default windowClose">关闭</button>
        </div>
</form>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function () {
    layui.use('laydate', function() {
        var laydate = layui.laydate;
        //日期选择器
        laydate.render({
            elem: '#ticket_date'
            //,type: 'date' //默认，可不填
        });
    });
$('#sendemail').submit(function(){
	$('.clicksend').attr('disabled','disabled');
	$(this).ajaxSubmit({
		success: function(res){
			if(res.code == 0){
				toastr.error(res.msg);
				}else{
				toastr.success(res.msg);
				setTimeout(function(){
					bDialog.close();},2000);
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
$('.windowClose').click(function(){
	bDialog.close();
});
});
</script>
</body>
</html>