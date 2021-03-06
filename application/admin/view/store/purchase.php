{extend name="public/base"}
{block name="header"}

{/block}

{block name="main"}
            <div class="container-fluid">
                <!--内容开始-->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="console-title console-title-border clearfix">
                            <div class="pull-left">
                                <h5><span>{$title}</span></h5>
                            </div>
                            <div class="pull-right">
                                <a class="btn btn-primary" href="{:url('add')}">新增</a>
                                <a href="javascript:window.location.reload();" class="btn btn-default">
                                    <span class="glyphicon glyphicon-refresh"></span>
                                    <span>刷新</span></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-inline marginTop10">
                        <div class="col-lg-12">
                        
                        	<form action="" method="get">
                        	
                            	<div class="form-group">
                                    <label class="control-label" for="projectNameInput">入库日期 :</label>
                                    <input name="start_time" id="start_time" <?php if (isset($_GET['start_time'])):?>value="<?php echo $_GET['start_time'];?>"<?php endif;?> style="width:110px;" class="ipt form-control">
                                    <span>到</span>
                                </div>
                                
                                <div class="form-group">
                                    <input name="end_time" id="end_time" <?php if (isset($_GET['end_time'])):?>value="<?php echo $_GET['end_time'];?>"<?php endif;?> style="width:110px;" class="ipt form-control">
                                </div>
                            <div class="form-group">
                                <label class="control-label" for="po_sn">采购单号 :</label>
                                <input name="po_sn" id="po_sn" class="ipt form-control" value="<?php if(isset($_GET['po_sn'])){echo $_GET['po_sn'];}?>"/>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="store_sn">入库单号 :</label>
                                <input name="store_sn" id="store_sn" class="ipt form-control" value="<?php if(isset($_GET['store_sn'])){echo $_GET['store_sn'];}?>"/>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="supplier_name">供应商 :</label>
                                <input name="supplier_name" id="supplier_name" class="ipt form-control" value="<?php if(isset($_GET['supplier_name'])){echo $_GET['supplier_name'];}?>" data-toggle="tooltip" data-placement="top" title="供应商">
                                
                            </div>
                                                    
                            <div class="form-group">
                                <label class="control-label" for="delivery_company">送货公司 :</label>
                                <input name="delivery_company" id="delivery_company" class="ipt form-control" value="<?php if(isset($_GET['delivery_company'])){echo $_GET['delivery_company'];}?>" data-toggle="tooltip" data-placement="top" title="送货公司">
                                
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
                                <th>入库单号</th>
                                <th>入库时间</th>
                                <th>采购单号</th>
                                <th>供应商</th>
                                <th>送货公司</th>
                                <th>商品名称</th>
                                <th>单位</th>
                                <th>单价</th>
                                <th>入库数量</th>
                                <th>备注</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            {volist name="list" id="vo" empty="$empty"}
                                <tr>
                                <td>{$vo.store_sn}</td>
                                <td>{$vo.create_time|date='Y-m-d',###}</td>
                                <td>{$vo.po_sn}</td>
                                <td>{$vo.supplier_name}</td>
                                <td>{$vo.cus_name}</td>
                                <td>{$vo.goods_name}</td>
                                <td>{$vo.unit}</td>
                                <td>{$vo.goods_price}</td>
                                <td>{$vo.goods_number}</td>
                                <td>{$vo.goods_remark}</td>
                                <td>
                                	{if condition="$vo['is_cancel']"}
                                	<!-- <a href="javascript:_delete({$vo['id']});">删除</a> -->
                                	已取消
                                	{else}
                                	<a href="{:url('edit',['id' => $vo['id']])}">编辑</a>
                                	<span class="text-explode">|</span>
                                	<a href="javascript:cancel({$vo['id']});">取消</a>
                                	{/if}
                                </td>
                                </tr>
                            {/volist}
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="20">
                                    <div class="pull-left">
                                        
                                    </div>
                                    <div class="pull-right page-box">{$page}</div>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <!--内容结束-->
            </div>
{/block}
{block name="footer"}
<script type="text/javascript">
    $(document).ready(function() {
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
        if(confirm("是否取消此入库单？")){
            if (!isNaN(e) && e !== null && e !== '') {
                var data={name:'scrap',id:e};
                $.sycToAjax("{:url('cancelpur')}", data);
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
    function _delete(e) {
        if(confirm("确定删除入库单？")){
            if (!isNaN(e) && e !== null && e !== '') {
                var data={name:'scrap',id:e};
                $.sycToAjax("{:url('deletepur')}", data);
            }
        };
        return false;
    }
</script>
{/block}