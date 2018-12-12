{foreach name="list" item="v" empty="$empty2"}
<div class="weui-form-preview list">
{if condition="$v['is_cancel']"}
<div class="weui-form-preview__hd">
    <label class="weui-form-preview__label">&nbsp;状态：</label>
    <em class="weui-form-preview__value" style="font-size: 13px;color:#999;">已取消&nbsp;</em>
</div>
{/if}
      <div class="weui-form-preview__bd">                
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">入库单号：</label>
          <span class="weui-form-preview__value">{$v.store_sn}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">入库时间：</label>
          <span class="weui-form-preview__value">{$v.create_time|date='Y-m-d',###}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">采购单号：</label>
          <span class="weui-form-preview__value">{$v.po_sn}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">供应商：</label>
          <span class="weui-form-preview__value">{$v.supplier_name}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">送货公司：</label>
          <span class="weui-form-preview__value">{$v.cus_name}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">商品分类：</label>
          <span class="weui-form-preview__value">{$v.category_name}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">单位：</label>
          <span class="weui-form-preview__value">{$v.unit}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">商品名称：</label>
          <span class="weui-form-preview__value" style="overflow: hidden;white-space: nowrap;text-overflow: ellipsis;">{$v.goods_name}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">单价：</label>
          <span class="weui-form-preview__value">{$v.goods_price}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">入库数量：</label>
          <span class="weui-form-preview__value">{$v.goods_number}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">备注：</label>
          <span class="weui-form-preview__value">{$v.remark}</span>
        </div>
      </div>
      {if condition="!$v['is_cancel']"}
        <div class="button-block">
        	<button class="weui-btn weui-btn_mini weui-btn_plain-primary" onclick="window.location.href='{:url('edit',['id' => $v['id']])}'">编辑</button>
        	<button class="weui-btn weui-btn_mini weui-btn_plain-primary cancel_confirm" order-id="{$v['id']}">取消</button>
        </div>
        {/if}
</div>
{/foreach}