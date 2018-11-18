{foreach name="data" item="v" empty="$empty2"}
<div class="weui-form-preview list">
      <div class="weui-form-preview__bd">
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">商品分类：</label>
          <span class="weui-form-preview__value">{$v.category_name}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">商品名称：</label>
          <span class="weui-form-preview__value">{$v.goods_name}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;单位：</label>
          <span class="weui-form-preview__value">{$v.unit}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">变动类型：</label>
          <span class="weui-form-preview__value" style="text-align: left;">
              {if condition="$v['type']==1"}
                 		入库
              {elseif condition="$v['type']==2"}
                    	出库
                                    {elseif condition="$v['type']==3"}
                                    	报溢
                                    {elseif condition="$v['type']==4"}
                                    	报损
                                    {elseif condition="$v['type']==5"}
                                    	采购入库
                                    {/if}
              <span style="float: right;">数量：{$v.number}</span>
          </span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">创建时间：</label>
          <span class="weui-form-preview__value">{$v.create_time|date='Y-m-d H:i:s',###}</span>
        </div>
      </div>
</div>
{/foreach}