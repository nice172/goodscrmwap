{extend name="public/common" /}
{block name="header"}
<style type="text/css">
.main {
	margin-top:90px;
	margin-bottom:60px;
}
.weui-form-preview:before{
	border:none;
}
.weui-form-preview__hd{
    padding:0px 10px;
}
.weui-form-preview__hd:after{
    left:0;
}
.weui-form-preview{
	margin-bottom:5px;
}
.button-block{
	border-top:1px solid #f6f6f6;
	text-align:right;
	padding:7px 7px 7px 0;
	margin:0;
}
.list .weui-btn{
	border-radius:50px;
}
.weui-btn+.weui-btn{
	margin-top:0;
}
.search{
	position:fixed;
	top:0;
	width:100%;
	z-index:1000;
}
.search .weui-btn{
	line-height:2;
	border-color:#999;
}
.block10{
	margin-top:5px;
}

.weui-form-preview__value input {
	border:1px solid #e5e5e5;
	padding:5px;
	width:39%;
	outline: none;
}

</style>
{/block}

{block name="main"}
<div class="search">
	<form action="" class="query" method="get">
	<div class="weui-form-preview">
      <div class="weui-form-preview__bd">
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">创建时间：</label>
          <span class="weui-form-preview__value" style="text-align: left;">
          <input type="text" readonly="readonly" id="start_time" name="start_time"/>&nbsp;TO&nbsp;<input type="text" readonly="readonly" id="end_time" name="end_time" />
          </span>
        </div>
    	</div>
      <div class="weui-form-preview__bd" style="padding-top:0;">
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">客户名称：</label>
          <span class="weui-form-preview__value" style="text-align: left;">
          <input type="text" name="company_short" />&nbsp;<button type="submit" class="weui-btn weui-btn_mini weui-btn_plain-default">查询</button>
          </span>
        </div>
    	</div>
    </div>
    </form>
</div>

<!-- <div class="block10"></div> -->
<div class="main">
{foreach name="list" item="v" empty="$empty2"}
<div class="weui-form-preview list">
  <div class="weui-form-preview__hd">
    <label class="weui-form-preview__label">送货日期：{$v.require_time|date='Y-m-d',###}</label>
    <em class="weui-form-preview__value" style="font-size: 13px;color:#999;">
	{if condition="$v['status'] eq -1"}
	已删除
	{elseif condition="$v['status'] eq 0"}
	未确认
	{elseif condition="$v['status'] eq 1"}
	已确认
	{elseif condition="$v['status'] eq 2"}
	已送货
	{elseif condition="$v['status'] eq 3"}
	已完成
	{elseif condition="$v['status'] eq 4"}
	已取消
	{elseif condition="$v['status'] eq 5"}
	已创建
	{elseif condition="$v['status'] eq 6"}
		{if condition="$v['send_num']"}
		部分已送货
		{else}
		已确认
		{/if}
	{/if}
    </em>
  </div>
      <div class="weui-form-preview__bd">
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">订单号码：</label>
          <span class="weui-form-preview__value">{$v.order_sn}</span>
        </div>
        
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">下单日期：</label>
          <span class="weui-form-preview__value">{$v.create_time|date="Y-m-d",###}</span>
        </div>
        
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">客户名称：</label>
          <span class="weui-form-preview__value">{$v.company_name}</span>
        </div>
        
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">联系人：</label>
          <span class="weui-form-preview__value">{$v.contacts}</span>
        </div>
        
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">创建日期：</label>
          <span class="weui-form-preview__value">{$v.create_time|date="Y-m-d H:i:s",###}</span>
        </div>
        
      </div>
        <div class="button-block">
        	<button class="weui-btn weui-btn_mini weui-btn_plain-primary" onclick="window.location.href='{:url('info',['id' => $v['oid']])}'">查看</button>
        	{if condition="$v['status'] eq 0"}
            <button class="weui-btn weui-btn_mini weui-btn_plain-primary" onclick="window.location.href='{:url('edit',['id' => $v['oid']])}'">编辑</button>
          	<button class="weui-btn weui-btn_mini weui-btn_plain-primary _confirm" order-id="{$v.oid}">确认</button>
          	{/if}
          	{if condition="$v['status'] eq 0 || $v['status'] eq 1 || $v['status'] eq 5"}
          	<button class="weui-btn weui-btn_mini weui-btn_plain-primary _cancel" order-id="{$v.oid}">取消</button>
          	{/if}
          	{if condition="$v['status'] eq 0 || $v['status'] eq 1 || $v['status'] eq 4"}
          	<button class="weui-btn weui-btn_mini weui-btn_plain-primary _delete" order-id="{$v.oid}">删除</button>
          	{/if}
          	{if condition="$v['status'] eq 2"}
          	<button class="weui-btn weui-btn_mini weui-btn_plain-primary setfinish" order-id="{$v.oid}">完成送货</button>
          	{/if}
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

</div>
<div class="bottom" onclick="window.location.href='{:url('add')}'">新 建</div>
{/block}

{block name="footer"}
    <script type="text/javascript">

	function _cancel(){
	    $('body').on('click','._cancel',function(){
	        var _this = $(this);
			$.confirm('确认取消订单吗？',function(){
					var orderid = $(_this).attr('order-id');
					$.get("{:url('cancel')}",{id:orderid},function(res){
						if(res.code){
							$(_this).remove();
							$.toptip(res.msg,'success');
							setTimeout(function(){
								window.location.reload();
								},2000);
						}else{
							$.toptip(res.msg);
						}
					});
				},function(){

				});
	    });
	}
	_cancel();

	function _confirm(){
	    $('body').on('click','._confirm',function(){
	        var _this = $(this);
	        var orderid = $(_this).attr('order-id');
			$.get("{:url('confirm')}",{id:orderid},function(res){
				if(res.code){
					$(_this).remove();
					$.toptip(res.msg,'success');
					setTimeout(function(){
						window.location.reload();
						},2000);
				}else{
					$.toptip(res.msg);
				}
			});
	    });
	}
	_confirm();

	function _delete(){
	    $('body').on('click','._delete',function(){
	        var _this = $(this);
	        var orderid = $(_this).attr('order-id');
			$.get("{:url('delete')}",{id:orderid},function(res){
				if(res.code){
					$(_this).remove();
					$.toptip(res.msg,'success');
					//$(_this).parents('.list').remove();
					setTimeout(function(){
						window.location.reload();
						},2000);
				}else{
					$.toptip(res.msg);
				}
			});
	    });
	}
	_delete();

	function setfinish(){
	    $('body').on('click','.setfinish',function(){
	        var _this = $(this);
	        var orderid = $(_this).attr('order-id');
			$.get("{:url('setfinish')}",{id:orderid},function(res){
				if(res.code){
					$(_this).remove();
					$.toptip(res.msg,'success');
					//$(_this).parents('.list').remove();
					setTimeout(function(){
						window.location.reload();
						},2000);
				}else{
					$.toptip(res.msg);
				}
			});
	    });
	}
	setfinish();
    
    function send(_this,e) {
        if (!isNaN(e) && e !== null && e !== '') {
            if (!isNaN(e) && e !== null && e !== '') {
                send_email('baojia',e);
            }
            return false;
        }
    }
    $("#start_time,#end_time").calendar({
    	dateFormat: 'yyyy-mm-dd'
    });
    var loading = false;  //状态标记
    var params = '{$params}'; //uid=100
    var total_page = {$total_page};
    var current_page = {$current_page};
    if(total_page > 1) {
	    $(document.body).infinite(0).on("infinite", function() {
	      if(loading) return;
	      loading = true;
	      current_page++;
	      $.ajax({
				type: 'GET',
				url: "{:url('index')}?page="+current_page+"&"+params,
				success: function(res){
					loading = false;
					if(typeof res == 'object' && res.code == 1){
						$('.weui-loadmore_line').show();
						$('.loadmore-loading').hide();
						return;
					}
					$(".loadmore-loading").before(res);
					_cancel();_confirm();_delete();setfinish();
				}
	      });
	    });
    }
    </script>
{/block}