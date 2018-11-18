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