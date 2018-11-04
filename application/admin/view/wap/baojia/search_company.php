{extend name="public/common" /}
{block name="header"}
<style>
.weui-label,input,textarea{font-size:13px !important;}
.weui-label {width:70px !important;text-align:right;}
.weui-cells__title {color:#000;}
</style>
{/block}
{block name="main"}
<form class="form-horizontal" method="get">
    <div class="weui-cells weui-cells_form">
      <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">跟单员：</label></div>
        <div class="weui-cell__bd" style="position:relative;">
          <input class="weui-input" type="text" name="order_ren" <?php if (isset($_GET['order_ren'])):?>value="<?php echo $_GET['order_ren'];?>"<?php endif;?> id="order_handle" placeholder="选择跟单员"/>
        <button type="submit" style="position: absolute;right:0;top:-2px;" class="weui-btn weui-btn_mini weui-btn_primary" id="search_company">查找</button>
        </div>
      </div>
      <div class="weui-cell" style="border-bottom: 1px solid #e5e5e5;">
        <div class="weui-cell__hd"><label class="weui-label">客户名称：</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="cus_short" <?php if (isset($_GET['cus_short'])):?>value="<?php echo $_GET['cus_short'];?>"<?php endif;?> placeholder="输入客户名称"/>
        </div>
      </div>
    </div>
</form>

{foreach name="data" item="vo"}
<div class="weui-form-preview list" data-fax="{$vo.cus_fax}" data-email="{$vo.cus_email}" data-user="{$vo.cus_duty}" data-short="{$vo.cus_short}" data-name="{$vo.cus_name}" data-id="{$vo['cus_id']}">
      <div class="weui-form-preview__bd">
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">客户：</label>
          <span class="weui-form-preview__value" style="text-align:left;">{$vo.cus_name}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">联系人：</label>
          <span class="weui-form-preview__value" style="text-align:left;">{$vo.cus_duty}
          	&nbsp;&nbsp;手机号码：{$vo.cus_mobile}
          </span>
        </div>
      </div>
</div>
{/foreach}

{if condition="$total_page > 1"}
<div class="weui-loadmore loadmore-loading">
  <i class="weui-loading"></i>
  <span class="weui-loadmore__tips">正在加载</span>
</div>
{/if}

<div class="weui-loadmore weui-loadmore_line" style="display: none;">
  <span class="weui-loadmore__tips">暂无数据</span>
</div>

{/block}
{block name="footer"}
<script type="text/javascript">
$(function() {
    FastClick.attach(document.body);
    var loading = false;  //状态标记
    var params = '{$query}';
    var total_page = {$total_page};
    var current_page = {$current_page};
    if(total_page > 1) {
	    $(document.body).infinite(0).on("infinite", function() {
	      if(loading) return;
	      loading = true;
	      current_page++;
	      $.ajax({
				type: 'GET',
				url: "{:url()}?page="+current_page+"&"+params,
				success: function(res){
					loading = false;
					if(typeof res == 'object' && res.data.data.length == 0){
						$('.weui-loadmore_line').show();
						$('.loadmore-loading').hide();
						return;
					}
					$(".loadmore-loading").before(res);
				}
	      });
	    });
    }
	$('body').on('click','.list',function(){
		var contacts = {
			'company_name': $(this).attr('data-name'),
			'company_short': $(this).attr('data-short'),
			'fax': $(this).attr('data-fax'),
			'email': $(this).attr('data-email'),
			'user': $(this).attr('data-user'),
			'id': $(this).attr('data-id')
		};
		console.log(contacts);
		parent.window.client_info(contacts);
	});

    $("#order_handle").picker({
  	  title: "请选择跟单员",
  	  cols: [
  	    {
  	      textAlign: 'center',
  	      values: {$order_ren_json}
  	    }
  	  ]
  	});
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