{foreach name="data" item="vo" empty="$empty2"}
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