{foreach name="list" item="v" empty="$empty2"}
<div class="weui-form-preview list">
      <div class="weui-form-preview__bd">                
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">供应商：</label>
          <span class="weui-form-preview__value">{$v.supplier_name}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">商品分类：</label>
          <span class="weui-form-preview__value">{$v.category_name}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">商品名称：</label>
          <span class="weui-form-preview__value">{$v.goods_name}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">单位：</label>
          <span class="weui-form-preview__value">{$v.unit}
          	<span style="float: right;">库存数量：{$v.store_number}</span>
          </span>
        </div>
      </div>
        <div class="button-block">
        	<button class="weui-btn weui-btn_mini weui-btn_plain-primary" onclick="window.location.href='{:url('log',['goods_id' => $v['goods_id']])}'">变动记录</button>
        	
        </div>
</div>
{/foreach}