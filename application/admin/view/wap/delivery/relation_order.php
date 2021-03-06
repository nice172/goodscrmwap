{extend name="public/common" /}
{block name="header"}
<style>
.main{padding-top:40px !important;}
.weui-label,input,textarea{font-size:13px !important;}
.weui-label {width:70px !important;text-align:right;}
.weui-cells__title {color:#000;}
.search{position:fixed;top:45px;width:100%;z-index:99999;}
.search .weui-btn{line-height:2;border-color:#999;}
.block10{margin-top:5px;}
.weui-form-preview__value input {border:1px solid #e5e5e5;padding:5px;width:39%;outline: none;}
.content{margin-top:90px;}
.weui-form-preview:before{border-top:none;}
.weui-loadmore_line{margin-top:130px;}
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
          <input type="text" readonly="readonly" id="start_date" name="start_date"/>&nbsp;TO&nbsp;<input type="text" readonly="readonly" id="end_date" name="end_date" />
          </span>
        </div>
    	</div>
      <div class="weui-form-preview__bd" style="padding-top:0;">
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">客户名称：</label>
          <span class="weui-form-preview__value" style="text-align: left;">
          <input type="text" name="cus_name" style="width:65%"/>&nbsp;<button type="submit" class="weui-btn weui-btn_mini weui-btn_plain-default">查询</button>
          </span>
        </div>
    	</div>
    </div>
    </form>
</div>
<div class="content">
{foreach name="data" item="vo" empty="$empty2"}
<div class="weui-form-preview selected_contacts">
      <div class="weui-form-preview__bd">
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">订单号码：</label>
          <span class="weui-form-preview__value" style="text-align:left;">{$vo.order_sn}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">下单时间：</label>
          <span class="weui-form-preview__value" style="text-align:left;">{$vo.create_time|date='Y-m-d H:i:s',###}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">客户名称：</label>
          <span class="weui-form-preview__value" style="text-align:left;">{$vo.company_short}
          <span style="float:right;">送货日期:{$vo.require_time}</span>
          </span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">商品名称：</label>
          <span class="weui-form-preview__value" style="text-align:left;">{$vo.goods_name}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">商品分类：</label>
          <span class="weui-form-preview__value" style="text-align:left;">{$vo.category_name}
          <span style="float:right;">单位:{$vo.unit}</span>
          </span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">下单数量：</label>
          <span class="weui-form-preview__value" style="text-align:left;">{$vo.goods_number}
          <span style="float:right;">未交数量:<?php echo $vo['goods_number']-$vo['send_num'];?></span>
          </span>
        </div>
      </div>
</div>
{/foreach}

<div class="clear"></div>

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
$(function() {
    $("#start_date,#end_date").calendar({
    	dateFormat: 'yyyy-mm-dd'
    });
    var goodslist = {$pojson};
    var loading = false;  //状态标记
    var params = '{$query}';
    var total_page = {$total_page};
    var current_page = {$current_page};
    if(total_page > 1) {
	    $(document.body).infinite(0).on("infinite", function() {
	      if(loading) return;
	      loading = true;
	      current_page++;
	      $.ajax({
				type: 'GET',
				url: "{:url()}?page="+current_page+"&"+params,
				success: function(res){
					loading = false;
					var data = res.data;
					if(data.length == 0){
						$('.weui-loadmore_line').show();
						$('.loadmore-loading').hide();
						return;
					}
					var html = '';
					for(var i in data){
						html +='<div class="weui-form-preview selected_contacts">';
						html +='<div class="weui-form-preview__bd">';
						html +='<div class="weui-form-preview__item">';
						html +='<label class="weui-form-preview__label">订单号码：</label>';
						html +='<span class="weui-form-preview__value" style="text-align:left;">'+data[i]['order_sn']+'</span>';
						html +='</div><div class="weui-form-preview__item">';
						html +='<label class="weui-form-preview__label">下单时间：</label>';
						html +='<span class="weui-form-preview__value" style="text-align:left;">'+data[i]['purchase_date']+'</span>';
						html +='</div><div class="weui-form-preview__item">';
						html +='<label class="weui-form-preview__label">客户名称：</label>';
						html +='<span class="weui-form-preview__value" style="text-align:left;">'+data[i]['company_short'];
						html +='<span style="float:right;">送货日期:'+data[i]['require_time']+'</span>';
						html +='</span></div><div class="weui-form-preview__item">';
						html +='<label class="weui-form-preview__label">商品名称：</label>';
						html +='<span class="weui-form-preview__value" style="text-align:left;">'+data[i]['goods_name']+'</span>';
						html +='</div><div class="weui-form-preview__item">';
						html +='<label class="weui-form-preview__label">商品分类：</label>';
						html +='<span class="weui-form-preview__value" style="text-align:left;">'+data[i]['category_name'];
						html +='<span style="float:right;">单位:'+data[i]['unit']+'</span>';
						html +='</span></div><div class="weui-form-preview__item">';
						html +='<label class="weui-form-preview__label">下单数量：</label>';
						html +='<span class="weui-form-preview__value" style="text-align:left;">'+data[i]['goods_number'];
						html +='<span style="float:right;">未交数量:'+data[i]['diff_number']+'</span>';
						html +='</span></div></div></div>';
						goodslist.push(data[i]);
					}
					$(".clear").before(html);
				}
	      });
	    });
    }
	$('body').on('click','.selected_contacts',function(){
		parent.window.relation_order(goodslist[$(this).index()]);
		parent.window.close_layer();
	});

});
</script>
{/block}