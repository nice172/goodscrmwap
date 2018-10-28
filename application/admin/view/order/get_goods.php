<!DOCTYPE html>
<html lang="zh-CN">
<head>
{include file="public/header-model"}
<link href="/assets/plugins/fileinput/fileinput.css" rel="stylesheet" type="text/css" />
<script src="/assets/plugins/fileinput/fileinput.js" type="text/javascript"></script>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
  
        <div class="modal-body">
        
							<div class="sub-button-line form-inline">
                            <form class="pull-left" method="get" action="?">
               <input type="hidden" name="cus_id" value="<?php echo isset($_GET['cus_id']) ? $_GET['cus_id'] : '';?>" />	
                                   <div class="form-group">
                                    <label class="control-label" for="">商品分类 :</label>
                                    <select name="category_id" class="form-control" id="category_id">
                                     <option value="">--请选择商品分类--</option>
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
                                
                                <div class="form-group">
                                    <label class="control-label" for="cus_short">商品名称 :</label>
                                    <input name="goods_name" id="goods_name" class="ipt form-control" <?php if (isset($_GET['goods_name'])):?>value="<?php echo $_GET['goods_name'];?>"<?php endif;?> />
                                    </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary" id="searchprojectName">查找</button>
                                </div>
                            </form>
                        </div>
                        <div style="clear: both;"></div>
                        
                       
<div class="row">
                    <div class="col-lg-12">
                        <table class="table syc-table border table-hover">
                            <thead>
                                <tr>
                                    
                                    <th>商品分类</th>
                                    <th>供应商</th>
                                    <th>商品名称</th>
<!--                                     <th>品牌</th> -->
                                    <th>单位</th>
                                    <th>标准单价</th>
                                    <th>最新成交价</th>
                                    <th>最新成交日期</th>
                                    <th>成交历史</th>
                                </tr>
                            </thead>
                            <tbody>
                            {volist name="data" id="vo" empty="$empty"}
                                <tr style="cursor: pointer;" class="selected_goods" data-store_number="{$vo['store_number']}" data-last_price="{$vo['last_price']}" data-shop_price="{$vo['shop_price']}" data-market_price="{$vo['market_price']}" data-unit="{$vo['unit']}" data-remark="<?php echo htmlspecialchars($vo['remark']);?>" data-goods_name="<?php echo htmlspecialchars($vo['goods_name']);?>" data-goods_id="{$vo['goods_id']}">
                                    <td>{$vo.category_name}</td>
                                    <td>{$vo.supplier_name}</td>
                                    <td style="text-align:left;">{$vo.goods_name}</td>
<!--                                     <td>{$vo.brand_name}</td> -->
                                    <td>{$vo.unit}</td>
                                    <td>{$vo.market_price}</td>
                                    <td>{$vo.last_price}</td>
                                    <td>{$vo.last_time}</td>
                                    <td><a href="javascript:history_record({$vo['goods_id']},{$vo['order_id']});">查看</a></td>
                                </tr>
                            {/volist}
                            </tbody>
                            <tfoot>
                            <tr>
<!--                                 <td width="10"> -->
<!--                                     <input type="checkbox" class="mydomain-checkbox" id="ckSelectAll" name="ckSelectAll"> -->
<!--                                 </td> -->
                                <td colspan="19">
                                    <div class="pull-left">
<!--                                         <button id="DelAllAttr" type="button" class="btn btn-default">选中删除</button> -->
                                    </div>
                                    <div class="pull-right page-box">{$page}</div>
                                </td>
                            </tr>
                            </tfoot>
                        </table>

                <!--内容结束-->
            </div>
        </div>
                        

        </div>
        <div class="modal-footer">
			<button class="btn btn-default windowClose">关闭</button>
        </div>

        </div>
    </div>
</div>
<script>
$(document).ready(function () {
	$('.selected_goods').click(function(e){
		if($(e.target).text() != '查看'){
		var goods = {
			'goods_name': $(this).attr('data-goods_name'),
			//'shop_price': $(this).attr('data-shop_price'), //实际价格
			'shop_price': $(this).attr('data-last_price'), //实际价格
			'market_price': $(this).attr('data-market_price'),
			'unit': $(this).attr('data-unit'),
			'remark': $(this).attr('data-remark'),
			'goods_id': $(this).attr('data-goods_id'),
			'store_number': $(this).attr('data-store_number'),
			'goods_number':0,
			'send_num':0,
			'show_input':true
		};
		parent.window.goods(goods);
		}
	});
	$('.windowClose').click(function(){
		bDialog.close();
	});
	
});
function history_record(goods_id,order_id){
	var cus_id = <?php echo isset($_GET['cus_id']) ? $_GET['cus_id'] : 0;?>;
	var title = '成交记录';
    bDialog.open({
        title : title,
        height: 560,
        width:"95%",
        url: '{:url(\'history_record\')}?cus_id='+cus_id+'&goods_id='+goods_id+'&order_id='+order_id,
        callback:function(data){
            if(data && data.results && data.results.length > 0 ) {
                window.location.reload();
            }
        }
    });
}
</script>
</body>
</html>
