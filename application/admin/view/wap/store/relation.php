{extend name="public/common" /}
{block name="header"}
<style type="text/css">
.main {
	margin-top:125px;
	margin-bottom:60px;
}
.weui-form-preview:before{
	border:none;
}
.weui-form-preview__hd{
    padding:0px 10px;
}
.weui-form-preview__hd:after{
    left:0;
}
.weui-form-preview{
	margin-bottom:5px;
}
.button-block{
	border-top:1px solid #f6f6f6;
	text-align:right;
	padding:7px 7px 7px 0;
	margin:0;
}
.list .weui-btn{
	border-radius:50px;
}
.weui-btn+.weui-btn{
	margin-top:0;
}
.search{
	position:fixed;
	top:0;
	width:100%;
	z-index:1000;
}
.search .weui-btn{
	line-height:2;
	border-color:#999;
}
.block10{
	margin-top:5px;
}
.clear{
	clear:both;
}
.weui-form-preview__value input {
	border:1px solid #e5e5e5;
	padding:5px;
	width:90%;
	outline: none;
}
.bottom {
	position:fixed;
	bottom:0px;
	width:100%;
	height:50px;
	background:#1aad19;
	color:#fff;
	text-align:center;
	line-height:50px;
}
#category_id{
	outline: none;
	background-color: #ffffff;
    background-image: none !important;
    filter: none !important;
    border: 1px solid #e5e5e5;
    outline: none;
    height: 28px !important;
    line-height: 28px;
}
</style>
{/block}

{block name="main"}
<div class="search">
	<form action="" class="query" method="get">
	<div class="weui-form-preview">
      <div class="weui-form-preview__bd">
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">商品名称：</label>
          <span class="weui-form-preview__value" style="text-align: left;">
          <input type="text" id="goods_name" name="goods_name" />
          </span>
        </div>
    	</div>
      <div class="weui-form-preview__bd" style="padding-top:0;">
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">供应商：</label>
          <span class="weui-form-preview__value" style="text-align: left;">
          <input type="text" name="supplier_name" />
          </span>
        </div>
    	</div>
      <div class="weui-form-preview__bd" style="padding-top:0;">
              <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">创建时间：</label>
          <span class="weui-form-preview__value" style="text-align: left;">
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
                                    &nbsp;<button type="submit" class="weui-btn weui-btn_mini weui-btn_plain-default">查询</button>
          </span>
        </div>
    	</div>
    	
    </div>
    </form>
</div>

<!-- <div class="block10"></div> -->
<div class="main">
{foreach name="list" item="v"}
<div class="weui-form-preview list">
      <div class="weui-form-preview__bd">                
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">供应商：</label>
          <span class="weui-form-preview__value">{$v.supplier_name}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">商品分类：</label>
          <span class="weui-form-preview__value">{$v.category_name}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">商品名称：</label>
          <span class="weui-form-preview__value">{$v.goods_name}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">单位：</label>
          <span class="weui-form-preview__value">{$v.unit}
          	<span style="float: right;">单价：{$v.store_number}元</span>
          </span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">关联订单：</label>
          <span class="weui-form-preview__value">{$v.order_sn}</span>
        </div>
        <div class="weui-form-preview__item">
          <label class="weui-form-preview__label">采购单号：</label>
          <span class="weui-form-preview__value">{$v.po_sn}</span>
        </div>
      </div>
        <div class="button-block">
        	<button class="weui-btn weui-btn_mini weui-btn_plain-primary" onclick="window.location.href='{:url('info',['id' => $v['id']])}'">变动记录</button>
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

	function _cancel(){
	    $('body').on('click','.cancel_confirm',function(){
	        var _this = $(this);
			$.confirm('确认取消吗？',function(){
					var orderid = $(_this).attr('order-id');
					$.get("{:url('cancel_confirm')}",{id:orderid},function(res){
						if(res.code){
							$(_this).remove();
							$.toptip(res.msg,'success');
							setTimeout(function(){
								window.location.reload();
								},2000);
						}else{
							$.toptip(res.msg);
						}
					});
				},function(){

				});
	    });
	}
	_cancel();

	function _confirm(){
	    $('body').on('click','._confirm',function(){
	        var _this = $(this);
	        var orderid = $(_this).attr('order-id');
			$.get("{:url('confirm')}",{id:orderid},function(res){
				if(res.code){
					$(_this).remove();
					$.toptip(res.msg,'success');
					setTimeout(function(){
						window.location.reload();
						},2000);
				}else{
					$.toptip(res.msg);
				}
			});
	    });
	}
	_confirm();

	function _delete(){
	    $('body').on('click','._delete',function(){
	        var _this = $(this);
	        var orderid = $(_this).attr('order-id');
			$.get("{:url('delete')}",{id:orderid},function(res){
				if(res.code){
					$(_this).remove();
					$.toptip(res.msg,'success');
					//$(_this).parents('.list').remove();
					setTimeout(function(){
						window.location.reload();
						},2000);
				}else{
					$.toptip(res.msg);
				}
			});
	    });
	}
	_delete();

	function setfinish(){
	    $('body').on('click','.setfinish',function(){
	        var _this = $(this);
	        var orderid = $(_this).attr('order-id');
			$.get("{:url('setfinish')}",{id:orderid},function(res){
				if(res.code){
					$(_this).remove();
					$.toptip(res.msg,'success');
					//$(_this).parents('.list').remove();
					setTimeout(function(){
						window.location.reload();
						},2000);
				}else{
					$.toptip(res.msg);
				}
			});
	    });
	}
	setfinish();
    
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
					_cancel();_confirm();_delete();setfinish();
				}
	      });
	    });
    }
    </script>
{/block}