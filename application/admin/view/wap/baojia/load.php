{foreach name="list" item="v"}
<div class="weui-form-preview list">
      <div class="weui-form-preview__bd">
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">报价单号：</label>
          <span class="weui-form-preview__value">{$v.order_sn}</span>
        </div>
        
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">报价日期：</label>
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
        	<button class="weui-btn weui-btn_mini weui-btn_plain-primary" onclick="window.location.href='{:url('info',['gid' => $v['id']])}'">查看</button>
            <button class="weui-btn weui-btn_mini weui-btn_plain-primary" onclick="window.location.href='{:url('edit',['gid' => $v['id']])}'">编辑</button>
          	<button class="weui-btn weui-btn_mini weui-btn_plain-primary" onclick="window.location.href='{:url('email',['gid' => $v['id']])}'">发送</button>
        </div>
</div>
{/foreach}