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
                            	<input type="hidden" name="order_id" value="<?php echo $_GET['order_id'];?>" />
                                <div class="form-group">
                                    <label class="control-label" for="cus_short">客户订单号 :</label>
                                    <input name="cus_order_sn" id="cus_order_sn" class="ipt form-control" <?php if (isset($_GET['cus_order_sn'])):?>value="<?php echo $_GET['cus_order_sn'];?>"<?php endif;?> />
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="cus_short">供应商 :</label>
                                    <input name="supplier_name" id="supplier_name" class="ipt form-control" <?php if (isset($_GET['supplier_name'])):?>value="<?php echo $_GET['supplier_name'];?>"<?php endif;?> />
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="cus_short">商品名称 :</label>
                                    <input name="goods_name" id="goods_name" class="ipt form-control" <?php if (isset($_GET['goods_name'])):?>value="<?php echo htmlspecialchars($_GET['goods_name']);?>"<?php endif;?> />
                                </div>
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
                                    <button type="submit" class="btn btn-primary">查找</button>
                                </div>
                            </form>
                        </div>
                        <div style="clear: both;"></div>
                        
                       
<div class="row">
                    <div class="col-lg-12">
                        <table class="table table-hover syc-table border">
                            <thead>
                                <tr>
                                    
                                    <th>采购号码</th>
                                    <th>入库单号</th>
                                    <th>客户订单号</th>
                                    <th>供应商</th>
                                    <th>商品分类</th>
                                    <th>商品名称</th>
                                    <th>单位</th>
                                    <th>采购数量</th>
                                    <th>入库数量</th>
                                    <th>出库数量</th>
                                    <th>状态</th>
                                    <th>入库时间</th>
                                </tr>
                            </thead>
                            <tbody>
                            {volist name="data" id="vo" empty="$empty"}
                            <?php if (($vo['goods_number']-$vo['out_number']) > 0){?>
                                <tr style="cursor: pointer;" index="{$key}" class="selected_po">
                                    <td>{$vo.po_sn}</td>
                                    <td>{$vo.store_sn}</td>
                                    <td>{$vo.cus_order_sn}</td>
                                    <td>{$vo.supplier_name}</td>
                                    <td>{$vo.category_name}</td>
                                    <td>{$vo.goods_name}</td>
                                    <td>{$vo.unit}</td>
                                    <td>{$vo.purchase_number}</td>
                                    <td>{$vo.goods_number}</td>
                                    <td>{$vo.out_number}</td>
                                    <td>正常</td>
                                    <td>{$vo.create_time|date='Y-m-d H:i:s',###}</td>
                                </tr>
                               <?php }?>
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

        </div>
    </div>
</div>
<script>
$(document).ready(function () {
    layui.use('laydate', function() {
        var laydate = layui.laydate;
		  	laydate.render({
		    elem: '#start_date'
		  });
		  	laydate.render({
		    elem: '#end_date'
		  });
    });
    var polist = <?php echo $pojson;?>;
	$('.selected_po').click(function(){
		parent.window.goods_merge(polist[$(this).attr('index')]);
		bDialog.close('');
	});
});
</script>
</body>
</html>