{extend name="public/common" /}
{block name="header"}
<style>
.weui-label,input,textarea{font-size:13px !important;}
.weui-label {width:50px !important;text-align:right;}
.weui-cells__title {color:#000;}
.weui-cells_checkbox {font-size:13px;}
.goods_list{margin:0;}
.top-list:before {border:none !important;}
#category_id{font-size:13px;border:none; outline: none; width:120px;}
</style>
{/block}
{block name="main"}
<form class="form-horizontal" method="get" action="?">
<input type="hidden" name="cus_id" value="<?php echo isset($_GET['cus_id']) ? $_GET['cus_id'] : '';?>" />
    <div class="weui-cells weui-cells_form" style="margin:0;position: fixed;z-index:99999;top:0;width:100%;">
      <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">分类：</label></div>
        <div class="weui-cell__bd">
<select name="category_id" class="form-control" id="category_id">
                                     <option value="">--请选择分类--</option>
                                            <option value="0" path="0">├顶级分类</option>
			              	<?php foreach ($lists as $key => $value){ ?>
			              		<option <?php if (isset($_GET['category_id']) && $_GET['category_id']==$value['category_id']):?>selected="selected"<?php endif;?> value="<?php echo $value['category_id'];?>" path="<?php echo $value['path'].'_'.$value['category_id'];?>">
			              		<?php echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', substr_count($value['path'], '_'));?>
			              		└<?php echo str_repeat('─', substr_count($value['path'], '_'));?>
			              		<?php echo $value['category_name'];?>
			              		</option>
			              	<?php } ?>
                                    </select>
        
        </div>
      </div>
      <div class="weui-cell" style="border-bottom: 1px solid #e5e5e5;">
        <div class="weui-cell__hd"><label class="weui-label">名称：</label></div>
        <div class="weui-cell__bd" style="position:relative;">
          <input class="weui-input" type="text" name="goods_name" <?php if (isset($_GET['goods_name'])):?>value="<?php echo htmlspecialchars($_GET['goods_name']);?>"<?php endif;?> placeholder="输入商品名称"/>
        <button type="submit" style="position: absolute;right:0;top:-2px;" class="weui-btn weui-btn_mini weui-btn_primary" id="search_company">查找</button>
        </div>
      </div>
    </div>
</form>

<div style="margin-top: 65px;">
{foreach name="data" item="vo" empty="$empty2"}
    <div class="weui-cells weui-cells_checkbox goods_list {if condition="$key==0"}top-list{/if}">
      <label class="weui-cell weui-check__label" for="s{$vo['goods_id']}">
        <div class="weui-cell__hd">
          <input type="checkbox" class="weui-check" name="checkbox1" value="{$vo['goods_id']}" id="s{$vo['goods_id']}">
          <i class="weui-icon-checked"></i>
        </div>
        <div class="weui-cell__bd">
          <p>名称：{$vo['goods_name']}</p>
          <p>单位：{$vo['unit']}&nbsp;&nbsp;标准单价：{$vo['market_price']}</p>
        </div>
      </label>
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
var goodslist = {:json_encode($data)};
$(function() {

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
					    html += '<div class="weui-cells weui-cells_checkbox goods_list">';
				    	html += '<label class="weui-cell weui-check__label" for="s'+data[i]['goods_id']+'">';
				    	html += '<div class="weui-cell__hd">';
			    		html += '<input type="checkbox" class="weui-check" name="checkbox1" value="'+data[i]['goods_id']+'" id="s'+data[i]['goods_id']+'">';
			    		html += '<i class="weui-icon-checked"></i></div>';
			    		html += '<div class="weui-cell__bd">';
			    		html += '<p>名称：'+data[i]['goods_name']+'</p>';
			    		html += '<p>单位：'+data[i]['unit']+'&nbsp;&nbsp;&nbsp;&nbsp;标准单价：'+data[i]['market_price']+'元</p>';
				        html += '</div></label></div>';
				        goodslist.push(data[i]);
					}
					$(".clear").before(html);
				}
	      });
	    });
    }
	$('body').on('click','.goods_list input[type=checkbox]',function(index){
		if($(this).is(':checked')) {
			for(var i in goodslist) {
				if(parseInt($(this).val()) == parseInt(goodslist[i]['goods_id'])) {
					var goods = goodslist[i];
					goods['goods_number'] = 0;
					goods['send_num'] = 0;
					parent.window.put(goods);
					break;
				}
			}
		}else{
			parent.window._delete(parseInt($(this).val()));
		}
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