{extend name="public/common" /}
{block name="header"}
<style type="text/css">
.main{margin-top:90px;margin-bottom:60px;}
.weui-form-preview:before{border:none;}
.weui-form-preview{margin-bottom:5px;}
.button-block{border-top:1px solid #f6f6f6;text-align:right;padding:7px 7px 7px 0;margin:0;}
.list .weui-btn{border-radius:50px;}
.weui-btn+.weui-btn{margin-top:0;}
.search{position:fixed;top:0;width:100%;z-index:99999;}
.search .weui-btn{line-height:2;border-color:#999;}
.block10{margin-top:5px;}
.weui-form-preview__value input{border:1px solid #e5e5e5;padding:5px;width:39%;outline: none;}
</style>
{/block}

{block name="main"}
<div class="search">
	<form action="" class="query" method="get">
	<div class="weui-form-preview">
      <div class="weui-form-preview__bd">
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">创建时间：</label>
          <span class="weui-form-preview__value" style="text-align: left;">
          <input type="text" readonly="readonly" id="start_time" name="start_time"/>&nbsp;TO&nbsp;<input type="text" readonly="readonly" id="end_time" name="end_time" />
          </span>
        </div>
    	</div>
      <div class="weui-form-preview__bd" style="padding-top:0;">
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">客户名称：</label>
          <span class="weui-form-preview__value" style="text-align: left;">
          <input type="text" name="company_short" />&nbsp;<button type="submit" class="weui-btn weui-btn_mini weui-btn_plain-default">查询</button>
          </span>
        </div>
    	</div>
    </div>
    </form>
</div>

<!-- <div class="block10"></div> -->
<div class="main">
{foreach name="list" item="v" empty="$empty2"}
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
          	<button class="weui-btn weui-btn_mini weui-btn_plain-primary" onclick="send(this,{$v.id})">发送</button>
        </div>
</div>
{/foreach}

{if condition="$total_page > 1"}
<div class="weui-loadmore loadmore-loading">
  <i class="weui-loading"></i>
  <span class="weui-loadmore__tips">正在加载</span>
</div>
{/if}

<div class="weui-loadmore weui-loadmore_line" style="display: none;">
  <span class="weui-loadmore__tips">暂无数据</span>
</div>

</div>
<div class="bottom" onclick="window.location.href='{:url('add')}'">新 建</div>
{/block}

{block name="footer"}

    <script type="text/javascript">
    function send(_this,e) {
        if (!isNaN(e) && e !== null && e !== '') {
            if (!isNaN(e) && e !== null && e !== '') {
                send_email('baojia',e);
            }
            return false;
        }
    }
    $("#start_time,#end_time").calendar({
    	dateFormat: 'yyyy-mm-dd'
    });
    var loading = false;  //状态标记
    var params = '{$params}'; //uid=100
    var total_page = {$total_page};
    var current_page = {$current_page};
    if(total_page > 1) {
	    $(document.body).infinite(0).on("infinite", function() {
	      if(loading) return;
	      loading = true;
	      current_page++;
	      $.ajax({
				type: 'GET',
				url: "{:url('index')}?page="+current_page+"&"+params,
				success: function(res){
					loading = false;
					if(typeof res == 'object' && res.code == 1){
						$('.weui-loadmore_line').show();
						$('.loadmore-loading').hide();
						return;
					}
					$(".loadmore-loading").before(res);
				}
	      });
	    });
    }
    </script>
{/block}