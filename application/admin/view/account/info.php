{extend name="public/base"}
{block name="header"}

{/block}

{block name="main"}
<form class="ajaxForm ajaxForm2" action="" method="post" enctype="multipart/form-data">
<input type="hidden" name="id" value="{$receivables.id}"/>
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
                            	<a href="{:url('info',['id' => $receivables['id'],'export'=> 1])}" class="btn btn-default">导出表格</a>
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
                        
                            <div class="form-group">
                                <label class="control-label" for="cus_name">客户名称 :</label>
                                <input name="cus_name" id="cus_name" disabled="disabled" value="{$receivables.cus_name}" class="ipt form-control" style="width: 200px;" />
                            </div>
                                <div class="form-group">
                                	<label class="control-label" for="total_money">金额总计 :</label>
                                	<input name="total_money" id="total_money" disabled="disabled" value="{$receivables.total_money}" style="width: 110px;" class="ipt form-control" />
                                </div>
                                <div class="form-group">
                                	<label class="control-label" for="invoice_sn">对账单号 :</label>
                                	<input name="invoice_sn" id="invoice_sn" disabled="disabled" value="{$receivables.invoice_sn}" class="ipt form-control" data-toggle="tooltip" data-placement="top" title="发票号码">
                                </div>
                            	<div class="form-group">
                                    <label class="control-label" for="invoice_date">对账日期 :</label>
                                    <input name="invoice_date" id="invoice_date" disabled="disabled" value="{$receivables.invoice_date}" style="width: 100px;" class="ipt form-control">
                                </div>
                                <div class="form-group">
                                	<label class="control-label" for="confirm_money">确认金额 :</label>
                                	<input name="confirm_money" {if condition="$receivables['is_confirm']"}disabled="disabled" value="{$receivables.confirm_money}"{else}{/if}id="confirm_money" style="width: 110px;" class="ipt form-control" />
                                </div>
                                {if condition="!$receivables['is_confirm']"}
								<div class="form-group">
                                	<label class="control-label" for="account_file">附件 :</label>
                                	<input type="file" name="Filedata[]" multiple="multiple" id="account_file" class="ipt form-control"/>
                                </div>
                                {else}
                                <div class="form-group">
                                <label class="control-label" for="files">附件 :</label>
                                <?php if (!empty($receivables['files'])){foreach ($receivables['files'] as $f){?>
                                <a href="<?php echo $f['path'];?>" target="_blank">
                                <?php echo $f['oldfilename'];?>
                                </a><br/>
                                <?php }}?>
                                </div>
                                {/if}
                        </div>
                        <div class="col-lg-12 filist"></div>
                    </div>
                    
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-hover syc-table border">
                            <thead>
                            <tr>
                                <th>送货单号</th>
                                <th>送货日期</th>
                                <th>客户名称</th>
                                <th>商品分类</th>
                                <th>商品名称</th>
                                <th>单位</th>
                                <th>单价</th>
                                <th>是否对账</th>
                                <th>交货数量</th>
                                <th>金额</th>
                                <th>客户单号</th>
                            </tr>
                            </thead>
                            <tbody>
                            {volist name="list" id="vo" empty="$empty"}
                                <tr>
                                <td>{$vo.order_dn}</td>
                                <td>{$vo.delivery_date}</td>
                                <td>{$vo.cus_name}</td>
                                <td>{$vo.category_name}</td>
                                <td style="text-align:left;" >{$vo.goods_name}</td>
                                <td>{$vo.unit}</td>
                                <td>{$vo.goods_price}</td>
                                <td>
                                {if condition="$receivables.is_confirm"}
                                	已对账
                                {else}未对账{/if}
                                </td>
                                <td>{$vo.current_send_number}</td>
                                <td>{$vo.count_money}</td>
                                <td>{$vo.cus_order_sn}</td>
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
                       
                       {if condition="$receivables['status']"}
                    {if condition="!$receivables['is_confirm']"} 
    			<div class="modal-footer" style="border-top:none;">
        			<div class="col-md-offset-5 col-md-12 left">
					<button type="submit" class="btn btn-primary confirm">确认</button>
					</div></div>
                    {/if}
                    {/if}
                    </div>
                    
                   
                </div>
				
                <!--内容结束-->
            </div>
            </form>
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
                //elem: '#invoice_date'
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
    $('#account_file').change(function(){
    	var _this = $(this);
    	$('.ajaxForm2').ajaxSubmit({
    		data:{type:'file'},
    		success: function(res){
    			if(res.code == 1){
    				//toastr.success(res.msg);
    				var html = '';
    				for(var i in res.data){
    					html += '<p style="padding-bottom: 0px;">';
    					html += '<input type="hidden" name="ext[]" value="'+res.data[i]['ext']+'" />';
    					html += '<input type="hidden" name="oldfilename[]" value="'+res.data[i]['oldfilename']+'" />';
    					html += '<input type="hidden" name="files[]" value="'+res.data[i]['path']+'" />';
    					html += '<a target="_blank" href="'+res.data[i]['path']+'">'+res.data[i]['oldfilename']+'</a><span style="padding-left:5px;cursor:pointer;">删除</span></p>';
    				}
    				//_this.after(html);
    				$('.filist').append(html);
    			}else{
    				toastr.error(res.msg);
    			}
    		}
    	});
    });
    $('body').on('click','.filist p span',function(){
    	$(this).parents('p').remove();
    });
</script>
{/block}