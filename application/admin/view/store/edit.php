{extend name="public/base"}
{block name="header"}
<style>.tab-pane{padding-top:15px;}</style>
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
                        </div>
                    </div>
                </div>           
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet margin-top-3">
 <form class="form-horizontal ajaxForm2" method="post" action="" id="form1">
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">基本信息</a></li>
    <li role="presentation"><a href="#goods" aria-controls="goods" role="tab" data-toggle="tab">商品信息</a></li>
  </ul>
  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">
    <input type="hidden" name="id" id="id" value="{$data.id}"/>
    <input type="hidden" name="po_id" id="po_id" value="{$data.po_id}"/>
    <input type="hidden" name="supplier_id" value="{$data.supplier_id}" id="supplier_id" />
                    <table class="table contact-template-form">
                                <tbody>
                                <tr>
                                    <td width="15%" class="right-color"><span class="text-danger">*</span><span>入库单号:</span></td>
                                    <td width="35%">
                                        <input type="text" class="form-control w300" readonly="readonly" value="{$data.store_sn}" name="store_sn" id="store_sn">
                                    </td>
                                    <td width="15%" class="right-color"><span class="text-danger">*</span><span>入库时间:</span></td>
                                    <td width="35%"><input type="text" class="form-control w300" readonly="readonly" value="<?php echo date('Y-m-d');?>" name="create_date" id="create_date"></td>
                                </tr>
								<tr>
                                <td width="15%" class="right-color"><span class="text-danger">*</span><span>采购单号:</span></td>
                                <td width="35%">
                                	<input type="text" class="form-control w300" style="display:inline-block;" value="{$data.po_sn}" name="po_sn" id="po_sn">
                                	<button type="button" class="btn btn-primary search_company" style="margin-top:-4px;">查找</button>
                                </td>
                                <td width="15%" class="right-color"><span class="text-danger">*</span><span>供应商:</span></td>
                                <td width="35%">
                                        <input type="text" class="form-control w300" value="{$data.supplier_name}" name="supplier_name" id="supplier_name">
                                    </td>
                                </tr>
                                <tr>
                                    <td width="15%" class="right-color"><span class="text-danger">*</span><span>采购日期:</span></td>
                                    <td width="35%"><input type="text" class="form-control w300" name="purchase_date" value="{$data.purchase_date}" id="purchase_date"></td>
                                    <td width="15%" class="right-color"><span class="text-danger">*</span><span>送货公司:</span></td>
                                    <td width="35%">
                                        <input type="text" class="form-control w300" name="cus_name" value="{$data.cus_name}" id="cus_name">
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td width="15%" class="right-color"><span class="text-danger"></span><span>备注:</span></td>
                                    <td colspan="3">
                                        <input type="text" class="form-control" name="store_remark" value="{$data.store_remark}" id="store_remark" />
                                    </td>
                                </tr> 
								
                    </tbody>
                    </table>
    </div>

<div role="tabpanel" class="tab-pane" id="goods">

		<div class="row">
                    <div class="col-lg-12">
                        <table class="table table-hover syc-table border">
                            <thead>
                                <tr>
                                    <th width="10%">序号</th>
                                    <th width="30%">商品名称</th>
                                    <th width="10%">单位</th>
                                    <th width="10%">单价</th>
                                    <th width="10%">采购数量</th>
                                    <th width="10%">入库数量</th>
                                    <th width="20%">备注</th>
                                </tr>
                            </thead>
                            <tbody class="goodsList"></tbody>
                        </table>
                <!--内容结束-->
            </div>
        </div>

</div>

  </div>
                
    <div class="modal-footer" style="border-top:none;">
        <div class="col-md-offset-5 col-md-12 left">
            <button type="submit" send="save" class="btn btn-primary">保 存</button>
<!--
            <button type="submit" send="confirm" class="btn btn-primary">确认采购单</button>
            <button type="submit" send="create" class="btn btn-primary">生成PDF并发送</button>
-->
            <button type="reset" onclick="history.go(-1);" class="btn btn-default">取消</button>
        </div>
    </div>
</form>
                        </div>
                    </div>
                </div>
                <!--内容结束-->
            </div>
{/block}
{block name="footer"}
<!-- Modal -->
<div class="modal fade" id="search_company_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">查找客户</h4>
      </div>
      <div class="modal-body">
		<form class="form-horizontal search_account" method="post" action="<?php echo url('search_account');?>" id="form1">
			
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
<!--         <button type="button" class="btn btn-primary">确认</button> -->
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" src="/assets/plugins/jquery-validation/js/jquery.validate.js"></script>

<script type="text/javascript">
function _formatMoney(num){
	num = num.toString().replace(/\$|\,/g,'');
	if(isNaN(num))
	num = "0";
	sign = (num == (num = Math.abs(num)));
	num = Math.floor(num*100+0.50000000001);
	cents = num%100;
	num = Math.floor(num/100).toString();
	if(cents<10)
	cents = "0" + cents;
	return (((sign)?'':'-') + num + '.' + cents);
}
    $(document).ready(function() {
        layui.use('laydate', function() {
            var laydate = layui.laydate;
  		  	laydate.render({
    		    elem: '#LAY-component-form-group-date'
    		  });
        });
        
        // 当前页面分类高亮
        $("#sidebar-purchase").addClass("sidebar-nav-active"); // 大分类
        $("#purchase-index").addClass("active"); // 小分类

		$('.attrChange').change(function(){
			var goods_type_id = $(this).val();
			$.get('<?php echo url('change_type');?>',{goods_type_id:goods_type_id},function(res){
				$('.appendAttr').html(res);
			});
		});

		$('.search_companyx').click(function(){
			$('#search_company_modal').modal({
				show : true,
				keyboard : false,
				backdrop:'static'
			});
		});

        $('#supplier_id').change(function(){
			var supplier_id = $(this).val();
			if(supplier_id){
				$.get('{:url(\'getsupplier\')}?supid='+supplier_id,{},function(data){
					if(data.code == 1){
						client_info(data.data);
					}
				});
			}else{
				$('#cus_phome,#fax,#contacts,#email,#payment_type').val('');
			}
        });

        $(".search_company").click(function () {
            var title = '查找采购单';
            bDialog.open({
                title : title,
                height: 560,
                width:"90%",
                url : '{:url(\'search_purchase\')}',
                callback:function(data){
                    if(data && data.results && data.results.length > 0 ) {
                        window.location.reload();
                    }
                }
            });
        });

        $('.get_goods').click(function(){
        	var title = '选择商品';
            bDialog.open({
                title : title,
                height: 560,
                width:960,
                url : '{:url(\'get_goods\')}',
                callback:function(data){
                    if(data && data.results && data.results.length > 0 ) {
                        window.location.reload();
                    }
                }
            });
        });

    });

function put(data){
	$('#po_id').val(data.id);
	$('#po_sn').val(data.po_sn);
	$('#cus_name').val(data.cus_name);
	$('#purchase_date').val(data.create_date);
	$('#supplier_name').val(data.supplier_name);
	$('#supplier_id').val(data.supplier_id);
	$.get("{:url('load')}?po_id="+data.id,{},function(res){
		goodsList(res.data);
	});
}
    
function client_info(data){
	$('#cus_phome').val(data.cus_phome);
	$('#fax').val(data.fax);
	$('#contacts').val(data.contacts);
	$('#email').val(data.email);
	$('#payment_type').val(data.supplier_payment);
}

var goods_info = new Array();
<?php if(!empty($goodslist)){ ?>
goods_info = {$goodslist};
<?php }?>
if(goods_info.length > 0){
	goodsList(goods_info);
}

var status = 1;
function goods(data){
	var flag = false;
	for(var i in goods_info){
		if(goods_info[i]['goods_id'] == data.goods_id){
			flag = true;
			break;
		}
	}
	if(!flag){
		goods_info.push(data);
	}
	status = 1;
	goodsList(goods_info);
}

function goodsList(goods_info){
	console.log(goods_info);
	var html = '';
	for(var j in goods_info){
		var num = parseInt(j)+1;
		var show_input = goods_info[j]['show_input']==true?'block':'none';
		var show_span = goods_info[j]['show_input']==true?'none':'block';
		var text_update = goods_info[j]['show_input']==true?'保存':'修改';
		goods_info[j]['totalMoney'] = _formatMoney(goods_info[j]['purchase_number']*goods_info[j]['shop_price']);
		html += '<tr data-index="'+j+'" data-goods_id="'+goods_info[j]['goods_id']+'" class="goods_'+j+'">';
		html += '<td>'+num+'</td>';
		html += '<td>'+goods_info[j]['goods_name']+'</td>';
		html += '<td>'+goods_info[j]['unit']+'</td>';
		html += '<td class="goods_price" style="text-align:center;"><input type="text" data-goods_price="'+goods_info[j]['goods_price']+'" oninput="checkNum(this)" name="goods_price" style="width:80%;display:'+show_input+';" value="'+goods_info[j]['goods_price']+'" /><span class="inputspan" style="display:'+show_span+';">'+goods_info[j]['goods_price']+'</span></td>';
		//html += '<td class="goods_number"><span class="span">'+goods_info[j]['goods_number']+'</span></td>';
		html += '<td class="purchase_number" style="text-align:center;"><input type="text" data-purchase_number="'+goods_info[j]['goods_number']+'" oninput="checkNum2(this)" name="goods_number" style="width:80%;display:'+show_input+';" value="'+goods_info[j]['goods_number']+'" /><span class="inputspan" style="display:'+show_span+';">'+goods_info[j]['goods_number']+'</span></td>';
		html += '<td class="store_number"><span class="span"><input type="text" oninput="checkNum2(this)" name="input_store['+goods_info[j]['goods_id']+'][]" value="'+goods_info[j]['input_store']+'"/></span></td>';
		html += '<td><input type="text" name="remark['+goods_info[j]['goods_id']+']"/></td>';
		html += '</tr>';
	}
	$('.goodsList').html(html);
}

function update(index){
	if(!goods_info[index]['show_input']){
		goods_info[index]['show_input'] = true;
		$('.goods_'+index+' .update').text('保存');
		$('.goods_'+index+' span.inputspan').hide();
		$('.goods_'+index+' input').show();
		return;
	}
		var shop_price = $('.goods_'+index+' input[name=shop_price]').val();
		if(shop_price == ''){
			shop_price = $('.goods_'+index+' input[name=shop_price]').attr('data-shop_price');
		}
		if(parseFloat(shop_price) > goods_info[index]['shop_price']){
			if(!confirm('采购单价高于关联订单商品单价')){
				status = 2;
				return;
			}
		}
		//var goods_number = $('.goods_'+index+' input[name=goods_number]').val();
		//if(goods_number == ''){
		//	goods_number = $('.goods_'+index+' input[name=goods_number]').attr('data-goods_number');
		//}
		var purchase_number = $('.goods_'+index+' input[name=purchase_number]').val();
		if(purchase_number == ''){
			purchase_number = $('.goods_'+index+' input[name=purchase_number]').attr('data-purchase_number');
		}
		//if(parseInt(purchase_number) > goods_info[index]['store_number']){
		//	alert('采购数量不能大于库存量');
		//	status = 2;
		//	return;
		//}
		//goods_info[index]['goods_number'] = goods_number;
		goods_info[index]['purchase_number'] = parseInt(purchase_number);
		goods_info[index]['shop_price'] = _formatMoney(parseFloat(shop_price));
		goods_info[index]['show_input'] = false;
		goodsList(goods_info);
		
	$('.goods_'+index+' .update').text('修改');
	$('.goods_'+index+' span.inputspan').show();
	$('.goods_'+index+' input').hide();
}

function checkNum(obj){
	obj.value = obj.value.replace(/[^\d.]/g,"");//清除"数字"和"."以外的字符
	obj.value = obj.value.replace(/^\./g,"");//验证第一个字符是数字而不是
	obj.value = obj.value.replace(/\.{2,}/g,".");//只保留第一个. 清除多余的
	obj.value = obj.value.replace(".","$#$").replace(/\./g,"").replace("$#$",".");
	obj.value = obj.value.replace(/^(\-)*(\d+)\.(\d\d).*$/,'$1$2.$3');//只能输入三个小数.(\d\d\d) 修改个数  加\d
}

function checkNum2(obj){
	obj.value = obj.value.replace(/[^\d]/g,"");//清除"数字"和"."以外的字符
	obj.value = obj.value.replace(/^\./g,"");//验证第一个字符是数字而不是
	obj.value = obj.value.replace(/\.{1}/g,"");//如果有一个. 就清除
}

function _delete(index){
	status = 1;
	var newGoodsList = new Array();
	for(var i in goods_info){
		if(i != index){
			newGoodsList.push(goods_info[i]);
		}
	}
	goods_info = newGoodsList;
	goodsList(goods_info);
}
$('button[type=submit]').click(function(){
	var send = $(this).attr('send');
	$('.ajaxForm2').ajaxSubmit({
		data:{goods_info:goods_info,type:send},
		success: function(res){
			if(res.code == 1){
				toastr.success(res.msg);
				if(res.url != '' && typeof res.url != 'undefined'){
					setTimeout(function(){window.location.href = res.url;},2000);
					}else{
						setTimeout(function(){window.location.reload();},2000);
						}
			}else{
				toastr.error(res.msg);
				}
		}
	});
	return false;});
</script>
{/block}