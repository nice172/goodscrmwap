{foreach name="list" item="v" empty="$empty2"}
<div class="weui-form-preview list">
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
          <span class="weui-form-preview__value" style="text-align: left;">{$v.category_name}
          	<span style="float: right;">单位：{$v.unit}</span>
          </span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">商品名称：</label>
          <span class="weui-form-preview__value" style="overflow: hidden;white-space: nowrap;text-overflow: ellipsis;">{$v.goods_name}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">单价：</label>
          <span class="weui-form-preview__value" style="text-align: left;">{$v.goods_price}
          	<span style="float: right;">入库数量：{$v.goods_number}</span>
          </span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">备注：</label>
          <span class="weui-form-preview__value">{$v.remark}</span>
        </div>
      </div>
        <div class="button-block">
        	<button class="weui-btn weui-btn_mini weui-btn_plain-primary" onclick="window.location.href='{:url('edit',['id' => $v['id']])}'">编辑</button>
        	<button class="weui-btn weui-btn_mini weui-btn_plain-primary cancel_confirm" order-id="{$v['id']}">取消入库</button>
        </div>
</div>
{/foreach}