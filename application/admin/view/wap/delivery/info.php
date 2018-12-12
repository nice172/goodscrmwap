{extend name="public/common" /}
{block name="header"}
<style type="text/css">
body{background:#fff;}
.main{margin-top:30px;}
.goods_list .weui-form-preview__value{text-align:left;line-height:1.2;padding-top:8px;}
.goods_list .weui-form-preview__label{line-height:1.2;padding-top:8px;width: 89px;text-align: right;text-align-last:right;}
#tab1 .weui-form-preview__label{line-height:1.2;padding-top:8px;width: 76px;text-align: right;text-align-last:right;}
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
<div class="main info">
<!-- 容器 -->
<div class="weui-tab">
  <div class="weui-tab__bd">
    <div id="tab1" class="weui-tab__bd-item" style="display: block;">
<div class="weui-form-preview">
      <div class="weui-form-preview__bd">
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">送货单号：</label>
          <span class="weui-form-preview__value">{$delivery.order_dn}</span>
        </div>
        
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">送货日期：</label>
          <span class="weui-form-preview__value">{$delivery.delivery_date}</span>
        </div>
        
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">订单号码：</label>
          <span class="weui-form-preview__value">{$delivery.order_sn}</span>
        </div>
        
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">客户单号：</label>
          <span class="weui-form-preview__value">{$cus_order_sn}</span>
        </div>
        
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">送货公司：</label>
          <span class="weui-form-preview__value">{$delivery.cus_name}</span>
        </div>
        
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">送货地址：</label>
          <span class="weui-form-preview__value">{$delivery.delivery_address}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">联系人：</label>
          <span class="weui-form-preview__value">{$delivery.contacts}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">电话号码：</label>
          <span class="weui-form-preview__value">{$delivery.contacts_tel}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">关联入库单：</label>
          <span class="weui-form-preview__value">{$delivery.order_sn}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">关联采购单：</label>
          <span class="weui-form-preview__value">{$delivery.po_sn}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">物流单号：</label>
          <span class="weui-form-preview__value">{$delivery.delivery_sn}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">交货方式：</label>
          <span class="weui-form-preview__value">{$delivery.delivery_way}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">司机：</label>
          <span class="weui-form-preview__value">{$delivery.delivery_driver}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">司机电话：</label>
          <span class="weui-form-preview__value">{$delivery.driver_tel}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">备注信息：</label>
          <span class="weui-form-preview__value" style="text-align: left;">{$delivery.order_remark}</span>
        </div>
      </div>
</div>
    </div>
    <div id="tab2" class="weui-tab__bd-item">
    {volist name="goodslistArr" id="vo" key="key" empty="$empty2"}
	<div class="weui-form-preview">
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
	          <label class="weui-form-preview__label">未交数量：</label>
	          <span class="weui-form-preview__value">{$vo.diff_number}</span>
	        </div>
	        <div class="weui-form-preview__item">
	          <label class="weui-form-preview__label">本次送货数量：</label>
	          <span class="weui-form-preview__value">{$vo.current_send_number}</span>
	        </div>
	        <div class="weui-form-preview__item">
	          <label class="weui-form-preview__label">入库数量：</label>
	          <span class="weui-form-preview__value">{$vo.add_number}</span>
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
<div class="bottom">
	{if condition="$delivery['is_confirm']"}
		<a href="{:url('prints',['id' => $delivery['id']])}">查看文件</a>
	{else}
		<a href="javascript:;" class="confirm">确认</a>
	{/if}
</div>
{/block}

{block name="footer"}

<script type="text/javascript">
var infoId = {$delivery.id};
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
    var goods_info = new Array();
    <?php if (!empty($goodslist)){?>
    goods_info = <?php echo $goodslist;?>;
    <?php }?>

    var status = 1;
    var relation_type = 1; //默认关联订单
    $('.confirm').click(function(){
        var _this = $(this);
		$.post("{:url('confirm')}",{goods_info:goods_info,id:infoId},function(res){
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
  
});
</script>
{/block}