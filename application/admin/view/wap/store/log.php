{extend name="public/common" /}
{block name="header"}
<style type="text/css">
.weui-form-preview:before{border:none;}
.weui-form-preview__hd{padding:0px 10px;}
.weui-form-preview__hd:after{left:0;}
.weui-form-preview{margin-bottom:5px;}
.button-block{border-top:1px solid #f6f6f6;text-align:right;padding:7px 7px 7px 0;margin:0;}
.list .weui-btn{border-radius:50px;}
.weui-btn+.weui-btn{margin-top:0;}
.search{position:fixed;top:0;width:100%;z-index:1000;}
.search .weui-btn{line-height:2;border-color:#999;}
.block10{margin-top:5px;}
.clear{clear:both;}
.weui-form-preview__value input{border:1px solid #e5e5e5;padding:5px;width:90%;outline: none;}
.weui-form-preview__value{text-align:left;}
.bottom{position:fixed;bottom:0px;width:100%;height:50px;background:#1aad19;color:#fff;text-align:center;line-height:50px;}
#category_id{outline: none;background-color: #ffffff; background-image: none !important; filter: none !important; border: 1px solid #e5e5e5; outline: none; height: 28px !important; line-height: 28px;}
</style>
{/block}

{block name="main"}
<!-- <div class="block10"></div> -->
<div class="main" style="padding-top:20px;">
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
{/block}

{block name="footer"}
    <script type="text/javascript">

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
				url: "{:url('')}?page="+current_page+"&"+params,
				success: function(res){
					loading = false;
					if(typeof res == 'object' && res.code == 1){
						$('.weui-loadmore_line').show();
						$('.loadmore-loading').hide();
						return;
					}
					$(".loadmore-loading").before(res);
					_cancel();_confirm();_delete();setfinish();
				}
	      });
	    });
    }
    </script>
{/block}