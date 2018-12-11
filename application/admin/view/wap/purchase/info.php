{extend name="public/common" /}
{block name="header"}
<style type="text/css">
body{background:#fff;}
.main{margin-top:30px;}
.goods_list .weui-form-preview__value{text-align:left;line-height:1.2;padding-top:8px;}
.goods_list .weui-form-preview__label{line-height:1.2;padding-top:8px;}
.fileList a{color:#06f;}
</style>
{/block}

{block name="main"}
  <div class="weui-navbar" style="position:fixed;top:45px;">
    <a class="weui-navbar__item weui-bar__item--on" href="javascript:;">
     基本信息
    </a>
    <a class="weui-navbar__item" href="javascript:;">
      商品
    </a>
  </div>
<div class="main" style="margin-bottom: 50px;">
<!-- 容器 -->
<div class="weui-tab">
  <div class="weui-tab__bd">
    <div id="tab1" class="weui-tab__bd-item" style="display: block;">
<div class="weui-form-preview">
      <div class="weui-form-preview__bd">
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">PO号码：</label>
          <span class="weui-form-preview__value">{$data.po_sn}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">关联订单：</label>
          <span class="weui-form-preview__value">{$data.order_sn}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">订购日期：</label>
          <span class="weui-form-preview__value">{$data.create_time|date="Y-m-d",###}</span>
        </div>
        
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">供应商：</label>
          <span class="weui-form-preview__value">{$data.supplier_name}</span>
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
          <label class="weui-form-preview__label">交易类型：</label>
          <span class="weui-form-preview__value">{$data.transaction_type}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">付款条件：</label>
          <span class="weui-form-preview__value">{$data.payment}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">税  率：</label>
          <span class="weui-form-preview__value">{$data.tax}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">交货方式：</label>
          <span class="weui-form-preview__value">{$data.delivery_type}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">送货公司：</label>
          <span class="weui-form-preview__value">{$data.delivery_company}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">送货地址：</label>
          <span class="weui-form-preview__value">{$data.delivery_address}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">收货联系人：</label>
          <span class="weui-form-preview__value">{$data.receiver}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">收货人电话：</label>
          <span class="weui-form-preview__value">{$data.receivernum}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">状态：</label>
          <span class="weui-form-preview__value">
								{if condition="$data['status'] eq -1"}
								已删除
								{elseif condition="$data['status'] eq 0"}
								未确认
								{elseif condition="$data['status'] eq 1"}
								已确认
								{elseif condition="$data['status'] eq 2"}
								已发送
								{elseif condition="$data['status'] eq 3"}
								已完成
								{elseif condition="$data['status'] eq 4"}
								已取消
								{elseif condition="$data['status'] eq 5"}
								已创建
								{/if}
          </span>
        </div>

        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">备注信息：</label>
          <span class="weui-form-preview__value" style="text-align: left;">{$data.remark}</span>
        </div>
      </div>
</div>
    </div>
    <div id="tab2" class="weui-tab__bd-item">
    {volist name="data['goodsInfo']" id="vo" key="key" empty="$empty2"}
    {php}$vo = json_decode($vo,true);{/php}
<div class="weui-form-preview" style="margin-bottom: 5px;">
      <div class="weui-form-preview__bd goods_list">
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">名称：</label>
          <span class="weui-form-preview__value">{$vo.goods_name}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">单位：</label>
          <span class="weui-form-preview__value">{$vo.unit}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">单价：</label>
          <span class="weui-form-preview__value">{$vo.goods_price}元</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">订单数量：</label>
          <span class="weui-form-preview__value">{$vo.goods_number}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">采购数量：</label>
          <span class="weui-form-preview__value">{$vo.purchase_number}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">金额：</label>
          <span class="weui-form-preview__value" style="text-align: left;">{$vo.totalMoney}</span>
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
		<a href="javascript:;" class="send_pdf">发送PDF</a>
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

    $('.send_pdf').click(function(){
    	 var orderid = {$data['id']};
    	 var email = '{$data['email']}';
    	 send_email('purchase',orderid,email);
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