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
                                <a href="javascript:history.go(-1);" class="btn btn-default">
                                    <span class="icon-goback"></span><span>返回</span>
                                </a>
                            </div>
                            <div class="pull-right">
<!--                                 <a class="btn btn-primary" href="{:url('newcreate')}">新建</a> -->
                                <a href="javascript:window.location.reload();" class="btn btn-default">
                                    <span class="glyphicon glyphicon-refresh"></span>
                                    <span>刷新</span></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-hover syc-table border">
                            <thead>
                            <tr>
							
							    <th>序号</th>
                                <th>开票日期</th>
                                <th>发票号码</th>
                                <th>含税金额</th>
                                <th>创建人</th>
                                <th>创建时间</th>
								<th>备注</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            {volist name="list" id="vo" empty="$empty"}
                                <tr>
								
								<td>{$key+1}</td>
                                <td>{$vo.ticket_date}</td>
                               <td>{$vo.ticket_sn}</td>
                               <td>{$vo.money}</td>
                               <td>{$vo.user_nick}</td>
                               <td>{$vo.create_time|date='Y-m-d H:i:s',###}</td>
                                <td>{$vo.remark}</td>
                                <td><a href="javascript:;">查看</a></td>
                                </tr>
                            {/volist}
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="20">
                                    <div class="pull-left">
                                        
                                    </div>
                                    <div class="pull-right page-box"></div>
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
        $("#sidebar-account").addClass("sidebar-nav-active"); // 大分类
        $("#account-index").addClass("active"); // 小分类
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
    function _open(e) {
        //if(confirm("确认操作？")){
            if (!isNaN(e) && e !== null && e !== '') {
                var data={name:'scrap',id:e};
                //$.sycToAjax("{:url('open')}", data);
            	var title = '新增发票记录';
                bDialog.open({
                    title : title,
                    height: 450,
                    width:410,
                    url : '{:url(\'openticket\')}?id='+e,
                    callback:function(data){
                        if(data && data.results && data.results.length > 0 ) {
                            window.location.reload();
                        }
                    }
                });
            }
        //};
        return false;
    }
    function _status(e) {
        if(confirm("确认操作？")){
            if (!isNaN(e) && e !== null && e !== '') {
                var data={name:'scrap',id:e};
                $.sycToAjax("{:url('status')}", data);
            }
        };
        return false;
    }
    function _confirm(e) {
        if(confirm("确认操作？")){
            if (!isNaN(e) && e !== null && e !== '') {
                var data={name:'scrap',id:e};
                $.sycToAjax("{:url('confirm')}", data);
            }
        };
        return false;
    }
    function _close(e) {
        if(confirm("确认操作？")){
            if (!isNaN(e) && e !== null && e !== '') {
                var data={name:'scrap',id:e};
                $.sycToAjax("{:url('close')}", data);
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