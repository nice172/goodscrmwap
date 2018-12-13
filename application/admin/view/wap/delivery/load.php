{foreach name="list" item="v" empty="$empty2"}
<div class="weui-form-preview list">
      <div class="weui-form-preview__bd">
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">送货单号：</label>
          <span class="weui-form-preview__value">{$v.order_dn}</span>
        </div>
        
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">送货日期：</label>
          <span class="weui-form-preview__value">{$v.delivery_date}</span>
        </div>
        
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">客户名称：</label>
          <span class="weui-form-preview__value">{$v.cus_name}</span>
        </div>
        
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">关联订单：</label>
          <span class="weui-form-preview__value">{$v.order_sn}</span>
        </div>
        
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">创建日期：</label>
          <span class="weui-form-preview__value">{$v.create_time|date="Y-m-d H:i:s",###}</span>
        </div>
        
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">　　状态：</label>
          <span class="weui-form-preview__value">
          	{if condition="$v['is_print'] eq 1"}
	已打印
	{else}
	未打印
	{/if}</span>
        </div>
        
      </div>
        <div class="button-block">
        	<button class="weui-btn weui-btn_mini weui-btn_plain-primary" onclick="window.location.href='{:url('info',['id' => $v['id']])}'">查看</button>
        	{if condition="!$v['is_confirm']"}
            <button class="weui-btn weui-btn_mini weui-btn_plain-primary" onclick="window.location.href='{:url('edit',['id' => $v['id']])}'">编辑</button>
          	<button class="weui-btn weui-btn_mini weui-btn_plain-primary" onclick="deleteOrder(this,{$v.id})">删除</button>
        	{/if}
        </div>
</div>
{/foreach}