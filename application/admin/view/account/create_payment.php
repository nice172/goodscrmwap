{extend name="public/base"}
{block name="header"}

{/block}
{block name="sub_sidebar"}
{include file="account/account_sidebar"}
{/block}
{block name="main"}
            <div class="container-fluid">
                <!--内容开始-->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="console-title console-title-border clearfix">
                            <div class="pull-left">
                                <h5><span>{$title}</span></h5>
                                <a href="javascript:history.go(-1);" class="btn btn-default">
                                    <span class="icon-goback"></span><span>返回</span>
                                </a>
                            </div>
                            <div class="pull-right">
                                <a href="javascript:window.location.reload();" class="btn btn-default">
                                    <span class="glyphicon glyphicon-refresh"></span>
                                    <span>刷新</span></a>
                            </div>
                        </div>
                    </div>
                </div>
<form class="ajaxForm" action="" method="post">
                <div class="row">
                    <div class="form-inline marginTop10">
                        <div class="col-lg-12">
                        
                            <div class="form-group">
                                <label class="control-label" for="cus_name">供应商 :</label>
                                <input name="cus_name" id="cus_name" disabled="disabled" value="{$supplier.supplier_name}" class="ipt form-control" style="width: 200px;" />
                            </div>
                                <div class="form-group">
                                	<label class="control-label" for="total_money">金额总计 :</label>
                                	<input name="total_money" id="total_money" disabled="disabled" value="{$total_money}" class="ipt form-control" />
                                </div>
                                  <div class="form-group">
                                	<label class="control-label" for="total_money">付款期 :</label>
                                	<input name="total_money" id="total_money" disabled="disabled" value="{$supplier.supplier_payment}" class="ipt form-control" />
                                </div>

                                 
                        </div>
                        <div class="col-lg-12">
                              <div class="form-group">
                                	<label class="control-label" for="invoice_sn">发票号码 :</label>
                                	<input name="invoice_sn" id="invoice_sn" class="ipt form-control" value="PR{:StrOrderOne()}" style="width: 188px;"  data-toggle="tooltip" data-placement="top" title="发票号码">
                                </div>
                            	<div class="form-group">
                                    <label class="control-label" for="invoice_date">发票日期 :</label>
                                    <input name="invoice_date" id="invoice_date" value="<?php echo date('Y-m-d');?>" class="ipt form-control">
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="last_date">到期日期 :</label>
                                    <input name="last_date" id="last_date" class="ipt form-control" style="width: 145px;">
                                </div>
                        </div>
                        
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-hover syc-table">
                            <thead>
                            <tr>
                                <th>采购订单</th>
                                <th>入库时间</th>
                                <th>入库单号</th>
                                <th>商品分类</th>
                                <th>客户名称</th>
                                <th>单位</th>
                                <th>单价</th>
                                <th>入库数量</th>
<!--                                 <th>待开票数量</th> -->
<!--                                 <th>本次开票数量</th> -->
                                <th>金额</th>
                            </tr>
                            </thead>
                            <tbody>
                            {volist name="list" id="vo" empty="$empty"}
                                <tr>
                                <td>{$vo.po_sn}</td>
                                <td>{$vo.delivery_date}</td>
                                <td>{$vo.order_dn}</td>
                                <td>{$vo.category_name}</td>
                                <td>{$vo.goods_name}</td>
                                <td>{$vo.unit}</td>
                                <td>{$vo.goods_price}</td>
<!--                                 <td>{$vo['current_send_number']+$vo['add_number']}</td> -->
<!--                                 <td>{$vo['current_send_number']+$vo['add_number']}</td> -->
                                <td>0</td>
                                <td>{$vo['count_money']}</td>
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
                        {if condition="!empty($list)"}
    <div class="modal-footer" style="border-top:none;">
        <div class="col-md-offset-5 col-md-12 left">
            <button type="submit" class="btn btn-primary confirm">保存</button>
            <button type="button" onclick="window.history.go(-1);" class="btn btn-default">取消</button>
        </div>
    </div>
    {/if}
                        
                    </div>
                    
                   
                </div>
 </form>
                <!--内容结束-->
            </div>
{/block}
{block name="footer"}
<script type="text/javascript">
    $(document).ready(function() {
        // 当前页面分类高亮
        $("#sidebar-account").addClass("sidebar-nav-active"); // 大分类
        $("#account-index").addClass("active"); // 小分类
        layui.use('laydate', function() {
            var laydate = layui.laydate;
            //日期选择器
            laydate.render({
                elem: '#invoice_date'
                //,type: 'date' //默认，可不填
            });
            laydate.render({
                elem: '#last_date'
                //,type: 'date' //默认，可不填
            });
        });
        $('[data-toggle="tooltip"]').tooltip(); //工具提示

		$('.cancel').click(function(){
			$.ajax({
				method:'POST',
				url:'<?php echo url('soset');?>',
				data:{},success:function(res){
					window.history.go('-1');
					if(res.code != 1){
					alert(res.msg);}
				}});
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
                $.sycToAjax("{:url('orders/huifu')}", data);
            }
        };
        return false;
    }

    //单条删除订单操作
    function deleteOrdersOne(e) {
        if(confirm("确定删除？")){
            if (!isNaN(e) && e !== null && e !== '') {
                var data={name:'scrap',id:e};
                $.sycToAjax("{:url('delete')}", data);
            }
        };
        return false;
    }
</script>
{/block}
