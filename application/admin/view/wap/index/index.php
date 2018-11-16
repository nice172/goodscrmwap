{extend name="public/common" /}
{block name="header"}
<style>body{background:#fff;}</style>
{/block}

{block name="main"}
    <div class="weui-grids">
      <a href="{:url('baojia/index')}" class="weui-grid js_grid">
        <div class="weui-grid__icon">
          <img src="__WAP__/img/icon1.png" alt="">
        </div>
        <p class="weui-grid__label">报价管理</p>
      </a>
      <a href="{:url('order/index')}" class="weui-grid js_grid">
        <div class="weui-grid__icon">
          <img src="__WAP__/img/icon2.png" alt="">
        </div>
        <p class="weui-grid__label">订单管理</p>
      </a>
      <a href="{:url('purchase/index')}" class="weui-grid js_grid">
        <div class="weui-grid__icon">
          <img src="__WAP__/img/icon3.png" alt="">
        </div>
        <p class="weui-grid__label">采购管理</p>
      </a>
      <a href="{:url('store/relation')}" class="weui-grid js_grid">
        <div class="weui-grid__icon">
          <img src="__WAP__/img/icon4.png" alt="">
        </div>
        <p class="weui-grid__label">库存管理</p>
      </a>
      <a href="{:url('delivery/index')}" class="weui-grid js_grid">
        <div class="weui-grid__icon">
          <img src="__WAP__/img/icon5.png" alt="">
        </div>
        <p class="weui-grid__label">送货管理</p>
      </a>
      <a href="{:url('login/logout')}" class="weui-grid js_grid">
        <div class="weui-grid__icon">
          <img src="__UI__/demos/images/icon_nav_dialog.png" alt="">
        </div>
        <p class="weui-grid__label">退出</p>
      </a>
    </div>
{/block}

{block name="footer"}
{/block}