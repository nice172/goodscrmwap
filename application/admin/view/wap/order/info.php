{extend name="public/common" /}
{block name="header"}
<style type="text/css">
.main {
	margin-top:40px;
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
.bottom .item {
	width:50%;
	float:left;
}
.bottom .item a,.bottom .item-full a{
	display:block;
	color:#fff;
}
.bottom .left-box a{
	border-right:1px solid #fff;
}

.goods_list .weui-form-preview__value{
	text-align:left;
	line-height:1.2;
	padding-top:8px;
}
.goods_list .weui-form-preview__label{
	line-height:1.2;
	padding-top:8px;
}
.fileList a{color:#06f;}
</style>
{/block}

{block name="main"}
  <div class="weui-navbar" style="position:fixed;top:0;">
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
    <div id="tab1" class="weui-tab__bd-item" style="display: block;">
<div class="weui-form-preview">
      <div class="weui-form-preview__bd">
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">订单号：</label>
          <span class="weui-form-preview__value">{$data.order_sn}</span>
        </div>
        
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">下单日期：</label>
          <span class="weui-form-preview__value">{$data.create_time|date="Y-m-d",###}</span>
        </div>
        
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">客户名称：</label>
          <span class="weui-form-preview__value">{$data.company_name}</span>
        </div>
        
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">客户单号：</label>
          <span class="weui-form-preview__value">{$data.cus_order_sn}</span>
        </div>
        
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">联系人：</label>
          <span class="weui-form-preview__value">{$data.contacts}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">E-MAIL：</label>
          <span class="weui-form-preview__value">{$data.email}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">状态：</label>
          <span class="weui-form-preview__value">
            {if condition="$data['status'] eq -1"}
    		已删除
    		{elseif condition="$data['status'] eq 0"}
    		未确认
    		<!-- <button style="margin-left:20px;" onclick="window.location.href='<?php echo url('confirm',['id' => $data['id']]);?>'" type="button" class="weui-btn weui-btn_mini weui-btn_primary">确认</button> -->
    		{elseif condition="$data['status'] eq 1"}
    		已确认
    		<!-- <button style="margin-left:20px;" onclick="window.location.href='<?php echo url('create',['id' => $data['id']]);?>'" type="button" class="weui-btn weui-btn_mini weui-btn_primary">创建采购单</button> -->
    		{elseif condition="$data['status'] eq 2"}
    		已送货
    		<button style="margin-left:20px;" type="button" class="setfinish weui-btn weui-btn_mini weui-btn_primary" order-id="{$data['id']}">完成送货</button>
    		{elseif condition="$data['status'] eq 3"}
    		已完成
    		{elseif condition="$data['status'] eq 4"}
    		已取消
    		{elseif condition="$data['status'] eq 5"}
    		已创建
    		{elseif condition="$data['status'] eq 6"}
    		部分已送货
    		{/if}
          </span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">要求送货日期：</label>
          <span class="weui-form-preview__value">{$data.require_time|date='Y-m-d',###}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">实际送货日期：</label>
          <span class="weui-form-preview__value">{if condition="$data['deliver_time']"}{$data.deliver_time|date='Y-m-d H:i:s',###}{/if}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">创建日期：</label>
          <span class="weui-form-preview__value">{$data.create_time|date="Y-m-d H:i:s",###}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">附件：</label>
          <span class="weui-form-preview__value">
            {foreach name="data['attachment']" item="v"}
    			{if condition="in_array($v['ext'],['jpg','jpeg','png','gif'])"}
    				<div class="fileList"><input type="hidden" name="oldfile[]" value="{$v['path']}"/><a href="{$v['path']}" target="_blank"><img src="{$v['path']}" alt="" width="50" height="50" style="margin-bottom:5px;"/></a></div>
    			{else}
    				<div class="fileList" style="margin-bottom:5px;"><input type="hidden" name="oldfile[]" value="{$v['path']}"/><a href="{$v['path']}" target="_blank">{$v.oldfilename}&nbsp;&nbsp;查看文件</a></div>
    			{/if}
    		{/foreach}
          </span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">备注信息：</label>
          <span class="weui-form-preview__value" style="text-align: left;">{$data.order_remark}</span>
        </div>
      </div>
</div>
    </div>
    <div id="tab2" class="weui-tab__bd-item">
    {volist name="goodsList" id="vo" key="key"  empty="$empty"}
<div class="weui-form-preview" style="margin-bottom: 5px;">
      <div class="weui-form-preview__bd goods_list">
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">名称：</label>
          <span class="weui-form-preview__value">{$vo.goods_name}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">单位：</label>
          <span class="weui-form-preview__value">{$vo.unit}
          	<span style="float: right;">单价：{$vo.goods_price}元</span>
          </span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">数量：</label>
          <span class="weui-form-preview__value">{$vo.goods_number}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">备注：</label>
          <span class="weui-form-preview__value" style="text-align: left;">{$vo.remark}</span>
        </div>
      </div>      
</div>
{/volist}
    </div>
  </div>
</div>
</div>

{if condition="$data['status'] < 2"}
<div class="bottom">
{if condition="$data['status'] eq 0"}
	<div class="item-full">
		<a href="javascript:;" class="_confirm">确认</a>
	</div>
{/if}
	{if condition="$data['status'] eq 1"}
	<div class="item-full">
		<a href="<?php echo url('create',['id' => $data['id']]);?>" class="create">创建采购单</a>
	</div>
	{/if}
</div>
{/if}

{/block}

{block name="footer"}

<script type="text/javascript">
function send(_this,e) {
    if (!isNaN(e) && e !== null && e !== '') {
        if (!isNaN(e) && e !== null && e !== '') {
            send_email('baojia',e);
        }
        return false;
    }
}
$(function() {

    $('body').on('click','._confirm',function(){
        var _this = $(this);
        var orderid = {$data['id']};
		$.get("{:url('confirm')}",{id:orderid},function(res){
			if(res.code){
				$.toptip(res.msg,'success');
				setTimeout(function(){
					window.location.reload();
					},2000);
			}else{
				$.toptip(res.msg);
			}
		});
    });
	
    $('body').on('click','.setfinish',function(){
        var _this = $(this);
        var orderid = {$data['id']};
		$.get("{:url('setfinish')}",{id:orderid},function(res){
			if(res.code){
				$.toptip(res.msg,'success');
				setTimeout(function(){
					window.location.reload();
					},2000);
			}else{
				$.toptip(res.msg);
			}
		});
    });
	
    $('.weui-navbar__item').click(function(){
    	$('.weui-navbar__item').removeClass('weui-bar__item--on');
    	$(this).addClass('weui-bar__item--on');
		$('.weui-tab__bd-item').hide();
		$('.weui-tab__bd-item').eq($(this).index()).show();
    });
});
</script>
{/block}