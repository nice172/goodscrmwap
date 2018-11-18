{extend name="public/common" /}
{block name="header"}
<style>
.weui-label,input,textarea{font-size:13px !important;}
.weui-label {width:65px !important;text-align:right;}
.weui-cells__title {color:#000;}
.weui-cells_checkbox {font-size:13px;}
.goods_list{margin:0;}
.top-list:before {border:none !important;}
.weui-cell__bd input {border:1px solid #e5e5e5;padding:5px;width:36%;outline: none;}
.cell-input{padding:5px 15px 5px 5px;}
.goods_name{overflow: hidden;text-overflow:ellipsis;white-space: nowrap;}
.weui-cell__bd p{padding:2px 0;}
.input{width:85% !important;}
</style>
{/block}
{block name="main"}
<form class="form-horizontal" method="get" action="?">
<input type="hidden" name="cus_id" value="<?php echo isset($_GET['cus_id']) ? $_GET['cus_id'] : '';?>" />
    <div class="weui-cells weui-cells_form" style="margin:0;position: fixed;z-index:99999;top:0;width:100%;">
      <div class="weui-cell" style="padding-left:5px;padding-bottom:5px;">
        <div class="weui-cell__hd"><label class="weui-label">采购日期：</label></div>
        <div class="weui-cell__bd">
        <input type="text" readonly="readonly" <?php if (isset($_GET['start_time'])):?>value="<?php echo $_GET['start_time'];?>"<?php endif;?> id="start_time" name="start_time"/>&nbsp;TO&nbsp;<input type="text" <?php if (isset($_GET['end_time'])):?>value="<?php echo $_GET['end_time'];?>"<?php endif;?> readonly="readonly" id="end_time" name="end_time" />
        </div>
      </div>
      <div class="weui-cell cell-input">
        <div class="weui-cell__hd"><label class="weui-label">采购单号：</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input input" type="text" name="po_sn" <?php if (isset($_GET['po_sn'])):?>value="<?php echo $_GET['po_sn'];?>"<?php endif;?> />
        </div>
      </div>
      <div class="weui-cell cell-input">
        <div class="weui-cell__hd"><label class="weui-label">供应商：</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input input" type="text" name="supplier_name" <?php if (isset($_GET['supplier_name'])):?>value="<?php echo $_GET['supplier_name'];?>"<?php endif;?> />
        </div>
      </div>
      <div class="weui-cell cell-input">
        <div class="weui-cell__hd"><label class="weui-label">送货公司：</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input input" type="text" name="delivery_company" <?php if (isset($_GET['delivery_company'])):?>value="<?php echo $_GET['delivery_company'];?>"<?php endif;?> />
        </div>
      </div>
      <div class="weui-cell cell-input">
        <div class="weui-cell__hd"><label class="weui-label">商品名称：</label></div>
        <div class="weui-cell__bd" style="position:relative;">
          <input class="weui-input input" style="width:68% !important;" type="text" name="goods_name" <?php if (isset($_GET['goods_name'])):?>value="<?php echo $_GET['goods_name'];?>"<?php endif;?> />
        <button type="submit" style="position: absolute;right:0;top:0px;" class="weui-btn weui-btn_mini weui-btn_primary" id="search_company">查找</button>
        </div>
      </div>
    </div>
</form>

<div style="margin-top: 205px;">
{foreach name="list" item="vo" empty="$empty2"}
    <div style="padding:10px;" class="weui-cells weui-cells_checkbox goods_list">
        <div class="weui-cell__bd">
          <p>采购单号：{$vo['po_sn']}</p>
          <p>采购日期：{$vo['create_date']}</p>
          <p>&nbsp;&nbsp;&nbsp;供应商：{$vo.supplier_name}</p>
          <p>送货公司：{$vo.cus_name}</p>
          <p class="goods_name">商品名称：{$vo.goods_name}</p>
          <p>&nbsp;&nbsp;&nbsp;&nbsp;单&nbsp;&nbsp;&nbsp;位：{$vo.unit} <span style="float: right;">单价：{$vo.goods_price}</span></p>
          <p>采购数量：{$vo.goods_number} <span style="float: right;">已入库数：{$vo.input_store}</span></p>
        </div>
    </div>
{/foreach}

<div class="clear"></div>
</div>

{if condition="$total_page > 1"}
<div class="weui-loadmore loadmore-loading">
  <i class="weui-loading"></i>
  <span class="weui-loadmore__tips">正在加载</span>
</div>
{/if}

<div class="weui-loadmore weui-loadmore_line" style="display: none;">
  <span class="weui-loadmore__tips">暂无数据</span>
</div>

{/block}
{block name="footer"}
<script type="text/javascript">
var goodslist = {$pjson};
$(function() {
    $("#start_time,#end_time").calendar({
    	dateFormat: 'yyyy-mm-dd'
    });
    var _parentList = parent.window.get_goods();
    for(var i in _parentList) {
        $('#s'+_parentList[i]['goods_id']).attr('checked','checked');
    }
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
					    html +='<div style="padding:10px;" class="weui-cells weui-cells_checkbox goods_list">';
						html +='<div class="weui-cell__bd">';
						html +='<p>采购单号：'+data[i]['po_sn']+'</p>';
						html +='<p>采购日期：'+data[i]['create_date']+'</p>';
						html +='<p>&nbsp;&nbsp;&nbsp;供应商：'+data[i]['supplier_name']+'</p>';
						html +='<p>送货公司：'+data[i]['cus_name']+'</p>';
						html +='<p class="goods_name">商品名称：'+data[i]['goods_name']+'</p>';
						html +='<p>&nbsp;&nbsp;&nbsp;&nbsp;单&nbsp;&nbsp;&nbsp;位：'+data[i]['unit']+' <span style="float: right;">单价：'+data[i]['goods_price']+'</span></p>';
						html +='<p>采购数量：'+data[i]['goods_number']+' <span style="float: right;">已入库数：'+data[i]['input_store']+'</span></p>';
						html +='</div></div>';
				        goodslist.push(data[i]);
					}
					$(".clear").before(html);
				}
	      });
	    });
    }
	$('body').on('click','.goods_list',function(index){
		parent.window.put(goodslist[$(this).index()]);
	});

    $('#sendemail').submit(function(){
    	$('.clicksend').attr('disabled','disabled');
    	$(this).ajaxSubmit({
    		success: function(res){
    			if(res.code == 0){
    				$.toptip(res.msg);
    				}else{
    				$.toptip(res.msg,'success');
    				}
    		},
    	     complete: function(XMLHttpRequest, textStatus) { 
    				//toastr.success('ok');
    				$('.clicksend').removeAttr('disabled');
    		     },
    	     error: function(){
    	    	 $.toptip('网络错误!');} 
    	});
    	return false;
    });
});
</script>
{/block}