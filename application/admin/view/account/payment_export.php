<html xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">
<head>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<meta name=ProgId content=Excel.Sheet>
<meta name=Generator content="Microsoft Excel 11">
<style>p{padding:0 0 10pt 10pt;margin:0;text-align:left;}</style>
</head>
<body>
<table border=1 cellpadding=0 cellspacing=0 width="100%">
     <tr>
         <td colspan="11" align="center">
             <h2 style="padding-top: 20pt;">{$title}</h2>
             <p>供应商：{$info.supplier_name}</p>
             <p>金额总计：{$total_money}</p>
             <p>付款期：{$info.payment_date}</p>
             <p>发票号码：{$info.invoice_sn}</p>
             <p>发票日期：{$info.invoice_date}</p>
             <p style="padding-bottom: 20pt;">到期日期：{$info.last_date}</p>
         </td>
     </tr>
     
     <tr>
         <td style="width:150pt;background-color: #00CC00;" align="center">采购单号</td>
         <td style="width:54pt;background-color: #00CC00;" align="center">入库日期</td>
         <td style="width:150pt;background-color: #00CC00;" align="center">入库单号</td>
         <td style="width:100pt;background-color: #00CC00;" align="center">商品分类</td>
         <td style="width:280pt;background-color: #00CC00;" align="center">商品名称</td>
         <td style="width:54pt;background-color: #00CC00;" align="center">单位</td>
         <td style="width:54pt;background-color: #00CC00;" align="center">单价</td>
         <td style="width:54pt;background-color: #00CC00;" align="center">入库数量</td>
         <td style="width:54pt;background-color: #00CC00;" align="center">金额</td>
     </tr>
{volist name="list" id="vo" empty="$empty"}
<tr>
       <td align="center">{$vo.po_sn}</td>
       <td align="center">{$vo.delivery_date}</td>
        <td align="center">{$vo.delivery_dn}</td>
    	<td align="center">{$vo.category_name}</td>
 		<td align="center">{$vo.goods_name}</td>
      <td align="center">{$vo.unit}</td>
      <td align="center">{$vo.goods_price}</td>
      <td align="center">{$vo['rec_number']}</td>
    <td align="center">{$vo['count_money']}</td>
    </tr>
{/volist}
</table>
</body>
</html>