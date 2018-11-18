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
.bottom .item a{
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
          <label class="weui-form-preview__label">报价单号：</label>
          <span class="weui-form-preview__value">{$data.order_sn}</span>
        </div>
        
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">报价日期：</label>
          <span class="weui-form-preview__value">{$data.create_time|date="Y-m-d",###}</span>
        </div>
        
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">客户名称：</label>
          <span class="weui-form-preview__value">{$data.company_name}</span>
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
          <label class="weui-form-preview__label">跟单员：</label>
          <span class="weui-form-preview__value">{$data.order_handle}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">状态：</label>
          <span class="weui-form-preview__value">
          {if condition="$data.status==1"}已发送{else}未发送&nbsp;&nbsp;<button type="button" onclick="send(this,{$data.id})" class="weui-btn weui-btn_mini weui-btn_primary">发送邮件</button>{/if}
          </span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">创建日期：</label>
          <span class="weui-form-preview__value">{$data.create_time|date="Y-m-d H:i:s",###}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">备注信息：</label>
          <span class="weui-form-preview__value" style="text-align: left;">{$data.order_remark}</span>
        </div>
      </div>
</div>
    </div>
    <div id="tab2" class="weui-tab__bd-item">
    {volist name="goodsList" id="vo" key="key" empty="$empty2"}
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
<!-- 
<div class="bottom">
	<div class="item left-box">
		<a href="javascript:;">确认</a>
	</div>
	<div class="item right-box">
		<a href="javascript:;">发送</a>
	</div>
</div>
-->
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
    $('.weui-navbar__item').click(function(){
    	$('.weui-navbar__item').removeClass('weui-bar__item--on');
    	$(this).addClass('weui-bar__item--on');
		$('.weui-tab__bd-item').hide();
		$('.weui-tab__bd-item').eq($(this).index()).show();
    });
});
</script>
{/block}