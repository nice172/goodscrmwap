{foreach name="list" item="v" empty="$empty2"}
<div class="weui-form-preview list">
  <div class="weui-form-preview__hd">
    <label class="weui-form-preview__label">创建日期：{$v.create_time|date="Y-m-d H:i:s",###}</label>
    <em class="weui-form-preview__value" style="font-size: 13px;color:#999;">
								{if condition="$v['status'] eq -1"}
								已删除
								{elseif condition="$v['status'] eq 0"}
								未确认
								{elseif condition="$v['status'] eq 1"}
								已确认
								{elseif condition="$v['status'] eq 2"}
								已发送
								{elseif condition="$v['status'] eq 3"}
								已完成
								{elseif condition="$v['status'] eq 4"}
								已取消
								{elseif condition="$v['status'] eq 5"}
								已创建
								{/if}
    </em>
  </div>
      <div class="weui-form-preview__bd">
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">采购单号：</label>
          <span class="weui-form-preview__value">{$v.po_sn}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">采购日期：</label>
          <span class="weui-form-preview__value">{$v.create_time|date='Y-m-d',###}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">采购金额：</label>
          <span class="weui-form-preview__value">{$v.total_money}</span>
        </div> 
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">供应商：</label>
          <span class="weui-form-preview__value">{$v.supplier_name}</span>
        </div>
        
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">关联订单：</label>
          <span class="weui-form-preview__value">{$v.order_sn}</span>
        </div>
        
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">送货公司：</label>
          <span class="weui-form-preview__value">{$v.delivery_company}</span>
        </div>
                
      </div>
        <div class="button-block">
        	<button class="weui-btn weui-btn_mini weui-btn_plain-primary" onclick="window.location.href='{:url('info',['id' => $v['id']])}'">查看</button>
        	{if condition="$v['status']==0"}
        		{if condition="$v['create_type']==0"}
            	<button class="weui-btn weui-btn_mini weui-btn_plain-primary" onclick="window.location.href='{:url('edit',['id' => $v['id']])}'">编辑</button>
          		{else}
          		<button class="weui-btn weui-btn_mini weui-btn_plain-primary" onclick="window.location.href='{:url('newedit',['id' => $v['id']])}'">编辑</button>
          		{/if}
          	
          	<button class="weui-btn weui-btn_mini weui-btn_plain-primary _confirm" order-id="{$v.id}">确认</button>
          	{/if}
          	
          	{if condition="$v['status']>=1"}
          	<button class="weui-btn weui-btn_mini weui-btn_plain-primary cancel_confirm" order-id="{$v.id}">取消确认</button>
          	{/if}
        </div>
</div>
{/foreach}