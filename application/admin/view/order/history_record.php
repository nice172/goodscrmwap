<!DOCTYPE html>
<html lang="zh-CN">
<head>
{include file="public/header-model"}
<style type="text/css">.w-e-text-container{height:200px !important;}</style>
</head>
<body>
            <div class="container-fluid">
                <!--内容开始-->
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table syc-table border table-hover">
                            <thead>
                            <tr>
                                <th>订单号</th>
                                <th>下单日期</th>
                                <th>简称</th>
                                <th>商品名称</th>
                                <th>单位</th>
                                <th>单价</th>
                                <th>数量</th>
                                <th>要求送货日期</th>
                                <th>实际送货日期</th>
                                <th>创建时间</th>
                            </tr>
                            </thead>
                            <tbody>
                            {volist name="list" id="vo" empty="$empty"}
                                <tr>
                                <td>{$vo.order_sn}</td>
                                <td>{$vo.create_time|date='Y-m-d',###}</td>
                                <td>{$vo.company_short}</td>
                                <td style="text-align:left;">{$vo.goods_name}</td>
                                <td>{$vo.unit}</td>
                                <td>{$vo.goods_price}</td>
                                <td>{$vo.goods_number}</td>
                                <td>{$vo.require_time|date='Y-m-d',###}</td>
                                <td>{if condition="$vo['deliver_time']"}{$vo.deliver_time|date='Y-m-d',###}{else}--{/if}</td>
                                <td>{$vo.create_time|date='Y-m-d H:i:s',###}</td>
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
</body>
</html>