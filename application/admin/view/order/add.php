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
 <form enctype="multipart/form-data" class="form-horizontal ajaxForm2" method="post" action="<?php echo url('add');?>" id="form1">
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">基本信息</a></li>
    <li role="presentation"><a href="#goods" aria-controls="goods" role="tab" data-toggle="tab">商品</a></li>
  </ul>
  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">
    							<input type="hidden" name="cus_id" id="cus_id" />
								<input type="hidden" name="con_id" id="con_id" />
                    <table class="table contact-template-form">
                                <tbody>
                                <tr>
                                    <td width="15%" class="right-color"><span class="text-danger">*</span><span>订单号码:</span></td>
                                    <td width="35%">
                                        <input type="text" class="form-control w300" readonly="readonly" value="{$order_sn}" name="order_sn" id="order_sn">
                                    </td>
                                    <td width="15%" class="right-color"><span class="text-danger">*</span><span>下单日期:</span></td>
                                    <td width="35%"><input type="text" class="form-control w300" readonly="readonly" value="<?php echo date('Y-m-d');?>" name="create_date" id="create_date"></td>
                                </tr>
                                <tr>
                                <td width="15%" class="right-color"><span class="text-danger">*</span><span>客户名称:</span></td>
                                <td width="35%">
                                	<input type="text" class="form-control w350" style="display:inline-block;" name="company_name" id="company_name">
                                	<button type="button" class="btn btn-primary search_company" style="margin-top:-4px;">查找</button>
                                </td>
                                <td width="15%" class="right-color"><span class="text-danger">*</span><span>客户订单号:</span></td>
                                <td width="35%">
                                        <input type="text" class="form-control w300"  name="cus_order_sn" id="cus_order_sn">
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td width="15%" class="right-color"><span class="text-danger">*</span><span>客户简称:</span></td>
                                    <td width="35%">
                                        <input type="text" class="form-control w300" name="company_short" id="company_short">
                                    </td>
                                    <td width="15%" class="right-color"><span class="text-danger">*</span><span>联系人:</span></td>
                                    <td width="35%"><input type="text" class="form-control w300" name="contacts" id="contacts"></td>
                                </tr>
                                
                                <tr>
                                    <td width="15%" class="right-color">传真号码:</span></td>
                                    <td width="35%">
                                        <input type="text" class="form-control w300" name="fax" id="fax">
                                    </td>
                                    <td width="15%" class="right-color"><span class="text-danger">*</span><span>E-Mail:</span></td>
                                    <td width="35%"><input type="text" class="form-control w300" name="email" id="email"></td>
                                </tr> 
                                 <tr>
                                <td width="15%" class="right-color"><span class="text-danger">*</span><span>交货日期:</span></td>
                                <td width="35%">
                                	<input type="text" class="form-control w300" name="require_time" id="LAY-component-form-group-date">
                                </td>
                                <td width="15%" class="right-color"><span class="text-danger">*</span><span>上传附件:</span></td>
                                	<td width="35%" class="filelist">

                                        <input style="width:365px;" class="changefile" type="file" name="Filedata[]" multiple="multiple" />
                                    </td>
                                </tr>
                                   <tr>
                                    <td width="15%" class="right-color"><span>备注:</span></td>
                                    <td colspan="3"><textarea class="form-control" name="order_remark" id="order_remark" rows="6"></textarea> </td>
                                </tr>
                                
                    </tbody>
                    </table>
    </div>

<div role="tabpanel" class="tab-pane" id="goods">

		<div class="row">
                    <div class="col-lg-12">
                        <table class="table syc-table border table-hover">
                            <thead>
                                <tr>
                                    <th width="5%">序号</th>
                                    <th width="22%">商品名称</th>
                                    <th width="5%">单位</th>
                                    <th width="10%">标准单价</th>
                                    <th width="10%">实际单价</th>
                                    <th width="5%">下单数量</th>
									<!--added by wei on 2018-10-09 beign-->
									<th width="8%">下单金额</th>
									<!--end-->
                                    <th width="5%">已送数量</th>
                                    <th width="20%">备注</th>
                                    <th width="15%">操作</th>
                                </tr>
                            </thead>
                            <tbody class="goodsList"></tbody>
                            <tfoot>
                            	<tr>
                            	<td colspan="6">
                            	<a href="javascript:;" class="get_goods">请选择商品</a>
                            	</td>
                            	<td class="total_money">总计：0.00</td>
                            	<td colspan="4">
                            	<div class="pull-right page-box" style="display: none;"><button type="button" class="btn btn-primary saveAll">全部保存</button></div></td>
                            	</tr>
                            </tfoot>
                        </table>

                <!--内容结束-->
            </div>
        </div>

</div>

  </div>
                
    <div class="modal-footer">
        <div class="col-md-offset-5 col-md-8 left">
            <button type="submit" send="save" class="btn btn-primary">保 存</button>
            <!--<button type="submit" send="confirm" class="btn btn-primary">确 认</button>
            <button type="submit" send="create" class="btn btn-primary">创建采购单</button>-->
            <button type="button" onclick="history.go(-1);" class="btn btn-default">取消</button>
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
        $("#sidebar-schedule").addClass("sidebar-nav-active"); // 大分类
        $("#order-index").addClass("active"); // 小分类

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
        

        $(".search_company").click(function () {
            var title = '查找客户';
            bDialog.open({
                title : title,
                height: 560,
                width:960,
                url : '{:url(\'search_company\')}',
                callback:function(data){
                    if(data && data.results && data.results.length > 0 ) {
                        window.location.reload();
                    }
                }
            });
        });

        $('.get_goods').click(function(){
            if($('#cus_id').val() == ''){
				alert('请先选择客户');
				return;
            }
        	var title = '选择商品';
            bDialog.open({
                title : title,
                height: 560,
                width:960,
                url : '{:url(\'get_goods\')}?cus_id='+$('#cus_id').val(),
                callback:function(data){
                    if(data && data.results && data.results.length > 0 ) {
                        window.location.reload();
                    }
                }
            });
        });

    });

function client_info(data){
	$('#cus_id').val(data.id);
	$('#company_name').val(data.company_name);
	$('#company_short').val(data.company_short);
	$('#fax').val(data.fax);
	$('#contacts').val(data.user);
	$('#email').val(data.email);
	$('#con_id').val(data.con_id);
}
var goods_info = new Array();
//var status = 1;
function goods(data){
	$('.page-box').show();
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
	//status = 1;
	goodsList(goods_info);
}

function goodsList(goods_info){
	var html = '';
	var total_money = 0;
	for(var j in goods_info){
		var num = parseInt(j)+1;
		var show_input = goods_info[j]['show_input']==true?'inline':'none';
		var show_span = goods_info[j]['show_input']==true?'none':'inline';
		var text_update = goods_info[j]['show_input']==true?'保存':'修改';
		html += '<tr data-index="'+j+'" data-goods_id="'+goods_info[j]['goods_id']+'" class="goods_'+j+'">';
		html += '<td width="5%">'+num+'</td>';
		html += '<td width="22%">'+goods_info[j]['goods_name']+'</td>';
		html += '<td width="5%">'+goods_info[j]['unit']+'</td>';
		html += '<td width="10%" class="market_price">'+goods_info[j]['market_price']+'</td>';
		html += '<td width="10%" class="shop_price"><input type="text" data-shop_price="'+goods_info[j]['shop_price']+'" oninput="checkNum(this)" name="shop_price" style="width:80%;display:'+show_input+';" value="'+goods_info[j]['shop_price']+'" /><span class="inputspan" style="display:'+show_span+';">'+goods_info[j]['shop_price']+'</span></td>';
		html += '<td width="5%" class="goods_number"><input type="text" data-goods_number="'+goods_info[j]['goods_number']+'" oninput="checkNum2(this)" name="goods_number" style="width:80%;display:'+show_input+';" value="'+goods_info[j]['goods_number']+'" /><span class="inputspan" style="display:'+show_span+';">'+goods_info[j]['goods_number']+'</span></td>';
		
		//added by wei on 2018-10-09 begin
		html += '<td width="8%" class="send_num">'+_formatMoney(parseFloat(goods_info[j]['shop_price'])*parseInt(goods_info[j]['goods_number']))+'</td>';
		//end
		html += '<td width="5%" class="send_num">'+goods_info[j]['send_num']+'</td>';
		html += '<td width="20%" class="remark"><input type="text" name="remark" style="width:80%;display:'+show_input+';" value="'+goods_info[j]['remark']+'" /><span class="inputspan" style="display:'+show_span+';">'+goods_info[j]['remark']+'</span></td>';
		html += '<td width="15%"><a href="javascript:;" onclick="update('+j+')" class="update">'+text_update+'</a><span class="text-explode">|</span><a href="javascript:;" onclick="_delete('+j+')" class="delete">删除</a></td>';
		html += '</tr>';
		total_money += parseFloat(goods_info[j]['shop_price'])*parseInt(goods_info[j]['goods_number']);
	}
	$('.goodsList').html(html);
	$('.total_money').text('总计：'+_formatMoney(total_money));
}

function update(index){
// 		var market_price = $('.goods_'+index+' input[name=market_price]').val();
// 		if(market_price == ''){
// 			market_price = $('.goods_'+index+' input[name=market_price]').attr('data-market_price');
// 		}
		if(!goods_info[index]['show_input']){
			goods_info[index]['show_input'] = true;
			$('.goods_'+index+' .update').text('保存');
			$('.goods_'+index+' span.inputspan').hide();
			$('.goods_'+index+' input').show().css('display','inline');
			return;
		}
		var shop_price = $('.goods_'+index+' input[name=shop_price]').val();
		if(shop_price == ''){
			shop_price = $('.goods_'+index+' input[name=shop_price]').attr('data-shop_price');
		}
		var goods_number = $('.goods_'+index+' input[name=goods_number]').val();
		if(goods_number == ''){
			goods_number = $('.goods_'+index+' input[name=goods_number]').attr('data-goods_number');
		}
		if(parseInt(goods_number) > goods_info[index]['store_number']){
			//alert('下单数量不能大于库存量');
			//status = 2;
			//return;
		}
// 		var send_num = $('.goods_'+index+' input[name=send_num]').val();
// 		if(send_num == ''){
// 			send_num = $('.goods_'+index+' input[name=send_num]').attr('data-send_num');
// 		}
		goods_info[index]['goods_number'] = parseInt(goods_number);
		//goods_info[index]['send_num'] = parseInt(send_num);
		//goods_info[index]['market_price'] = parseFloat(market_price);
		goods_info[index]['shop_price'] = _formatMoney(parseFloat(shop_price));
		goods_info[index]['remark'] = $('.goods_'+index+' input[name=remark]').val();

		$('tbody.goodsList tr').each(function(idx){
			var eIndex = $('tbody.goodsList tr').eq(idx).attr('data-index');
			if(eIndex == index){
				goods_info[index]['show_input'] = false;
		    	$('.goods_'+index+' .update').text('修改');
		    	$('.goods_'+index+' span.inputspan').show().css('display','inline');
		    	$('.goods_'+index+' input').hide();
			}else{
				saveOther(eIndex,true);
			}
		});
		goodsList(goods_info);
}

function saveOther(eIndex,is_show){
	var shop_price = $('.goods_'+eIndex+' input[name=shop_price]').val();
	if(shop_price == ''){
		shop_price = $('.goods_'+eIndex+' input[name=shop_price]').attr('data-shop_price');
	}
	var goods_number = $('.goods_'+eIndex+' input[name=goods_number]').val();
	if(goods_number == ''){
		goods_number = $('.goods_'+eIndex+' input[name=goods_number]').attr('data-goods_number');
	}
	goods_info[eIndex]['goods_number'] = parseInt(goods_number);
	goods_info[eIndex]['shop_price'] = _formatMoney(parseFloat(shop_price));
	goods_info[eIndex]['remark'] = $('.goods_'+eIndex+' input[name=remark]').val();
	if(!goods_info[eIndex]['show_input']){
		goods_info[eIndex]['show_input'] = false;
	}else{
		goods_info[eIndex]['show_input'] = is_show;
	}
}

$('.saveAll').click(function(){
	$('tbody.goodsList tr').each(function(index){
		var eIndex = $('tbody.goodsList tr').eq(index).attr('data-index');
		if(goods_info[eIndex]['show_input']){
			saveOther(eIndex,false);
		}
	});
	goodsList(goods_info);
});

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
	if(goods_info.length <= 0){
		$('.page-box').hide();
	}
}

$('.changefile').change(function(){
	var _this = $(this);
	$('.ajaxForm2').ajaxSubmit({
		data:{type:'file'},
		success: function(res){
			if(res.code == 1){
				//toastr.success(res.msg);
				var html = '';
				for(var i in res.data){
					html += '<p style="padding-bottom: 10px;">';
					html += '<input type="hidden" name="ext[]" value="'+res.data[i]['ext']+'" />';
					html += '<input type="hidden" name="oldfilename[]" value="'+res.data[i]['oldfilename']+'" />';
					html += '<input type="hidden" name="files[]" value="'+res.data[i]['path']+'" />';
					html += '<a target="_blank" href="'+res.data[i]['path']+'">'+res.data[i]['oldfilename']+'</a><span style="padding-left:5px;cursor:pointer;">删除</span></p>';
				}
				_this.before(html);
			}else{
				toastr.error(res.msg);
			}
		}
	});
});

$('body').on('click','.filelist p span',function(){
	$(this).parents('p').remove();
});

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