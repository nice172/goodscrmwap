<!DOCTYPE html>
<html lang="zh-CN">
<head>
{include file="public/header-model"}
<link href="/assets/plugins/fileinput/fileinput.css" rel="stylesheet" type="text/css" />
<script src="/assets/plugins/fileinput/fileinput.js" type="text/javascript"></script>
</head>
<body>
            <div class="container-fluid">
                <!--内容开始-->
                <div class="row">
                    <div class="form-inline marginTop10">
                        <div class="col-lg-12">
                        
                        	<form action="" method="get">
                        	
                            <div class="form-group">
                                <label class="control-label" for="po_sn">采购单号 :</label>
                                <input name="po_sn" id="po_sn" class="ipt form-control" value="<?php if(isset($_GET['po_sn'])){echo $_GET['po_sn'];}?>"/>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="supplier_name">供应商 :</label>
                                <input name="supplier_name" id="supplier_name" class="ipt form-control" value="<?php if(isset($_GET['supplier_name'])){echo $_GET['supplier_name'];}?>"/>
                                
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="store_sn">商品名称 :</label>
                                <input name="store_sn" id="store_sn" class="ipt form-control" value="<?php if(isset($_GET['goods_name'])){echo $_GET['goods_name'];}?>"/>
                            </div>                    
                            <div class="form-group">
                                <label class="control-label" for="delivery_company">送货公司 :</label>
                                <input name="delivery_company" id="delivery_company" class="ipt form-control" value="<?php if(isset($_GET['delivery_company'])){echo $_GET['delivery_company'];}?>" />
                                
                            </div>
                              <div class="form-group">
                                    <label class="control-label" for="projectNameInput">采购日期 :</label>
                                    <input name="start_time" id="start_time" <?php if (isset($_GET['start_time'])):?>value="<?php echo $_GET['start_time'];?>"<?php endif;?> style="width:110px;" class="ipt form-control">
                                    <span>到</span>
                                </div>
                                
                                <div class="form-group">
                                    <input name="end_time" id="end_time" <?php if (isset($_GET['end_time'])):?>value="<?php echo $_GET['end_time'];?>"<?php endif;?> style="width:110px;" class="ipt form-control">
                                </div>
                            
                                <button type="submit" class="btn btn-primary" id="searchprojectName">查询</button>
                                </form>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-hover syc-table border">
                            <thead>
                            <tr>
                                <th>采购单号</th>
                                <th>采购日期</th>
                                <th>供应商</th>
                                <th>送货公司</th>
                                <th>商品名称</th>
                                <th>单位</th>
                                <th>单价</th>
                                <th>采购数量</th>
                            <!--<th>备注</th>-->
                                <th>已入库数</th>
                            </tr>
                            </thead>
                            <tbody>
                            {volist name="list" id="vo" empty="$empty"}
                                <tr class="select_row" style="cursor: pointer;" data-index="{$key}">
                                <td>{$vo.po_sn}</td>
                                <td>{$vo.create_time|date='Y-m-d',###}</td>
                                <td>{$vo.supplier_name}</td>
                                <td>{$vo.cus_name}</td>
                                <td>{$vo.goods_name}</td>
                                <td>{$vo.unit}</td>
                                <td>{$vo.goods_price}</td>
                                <td>{$vo.goods_number}</td>
                                <td>{$vo.input_store}</td>
                                </tr>
                            {/volist}
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="20">
                                    <div class="pull-left"></div>
                                    <div class="pull-right page-box">{$page}</div>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <!--内容结束-->
            </div>
<script type="text/javascript">
    $(document).ready(function() {

		var json = {$pjson};
		$('.select_row').click(function(){
			var index = $(this).attr('data-index');
			parent.window.put(json[index]);
			bDialog.close();
		});
        
        // 当前页面分类高亮
        $("#sidebar-purchase").addClass("sidebar-nav-active"); // 大分类
        $("#purchase-index").addClass("active"); // 小分类
        layui.use('laydate', function() {
            var laydate = layui.laydate;
            //日期选择器
            laydate.render({
                elem: '#start_time'
                //,type: 'date' //默认，可不填
            });
            laydate.render({
                elem: '#end_time'
                //,type: 'date' //默认，可不填
            });
        });
        $('[data-toggle="tooltip"]').tooltip(); //工具提示

        // 使用prop实现全选和反选
        $("#ckSelectAll").on('click', function () {
            $("input[name='ckbox[]']").prop("checked", $(this).prop("checked"));
        });
        // 获取选中元素
        $("#DelAllAttr").on('click', function () {
            layui.use(['layer'], function() {
                var layer = layui.layer;
                layer.open({
                    title: '温馨提示',
                    content: '是否要废除所有选择的订单？',
                    btn: ['我已确认', '放弃操作'],
                    yes: function(index, layero){
                        layer.close(index);
                        var valArr = new Array;
                        $("input[name='ckbox[]']:checked").each(function(i){
                            valArr[i] = $(this).val();
                        });
                        if (valArr.length !== 0 && valArr !== null && valArr !== '') {
                            var data={name:'delallattr',uid:valArr.join(',')};
                            $.sycToAjax("{:Url('orders/scrap')}", data);
                        };
                        return false;
                    }
                    ,btn2: function(index, layero){
                        layer.close(index);
                    }
                });
            });
        });
    });
    //单条订单操作
    function cancel(e) {
        if(confirm("是否取消此订单？")){
            if (!isNaN(e) && e !== null && e !== '') {
                var data={name:'scrap',id:e};
                $.sycToAjax("{:url('cancel')}", data);
            }
        };
        return false;
    }
    
    //单条恢复订单操作
    function huifuLogisticsOne(e) {
        if(confirm("确定恢复此订单？")){
            if (!isNaN(e) && e !== null && e !== '') {
                var data={name:'scrap',pid:e};
                $.sycToAjax("{:Url('orders/huifu')}", data);
            }
        };
        return false;
    }

    //单条删除订单操作
    function deleteOrdersOne(e) {
        if(confirm("确定删除订单？")){
            if (!isNaN(e) && e !== null && e !== '') {
                var data={name:'scrap',pid:e};
                $.sycToAjax("{:Url('orders/delete')}", data);
            }
        };
        return false;
    }
</script>
</body>
</html>