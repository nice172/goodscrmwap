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
<table border=1 cellpadding=0 cellspacing=0 width="100%" >
     <tr>
         <td colspan="11" align="center">
             <h2 style="padding-top: 20pt;">{$title}</h2>
             <p>客户名称：{$receivables.cus_name}</p>
             <p>金额总计：{$receivables.total_money}</p>
             <p>对账单号：{$receivables.invoice_sn}</p>
             <p>对账日期：{$receivables.invoice_date}</p>
             <p style="padding-bottom: 20pt;">确认金额：{$receivables.confirm_money}</p>
         </td>
     </tr>
     
     <tr>
         <td style="width:150pt;background-color: #00CC00;" align="center">送货单号</td>
         <td style="width:54pt;background-color: #00CC00;" align="center">送货日期</td>
         <td style="width:150pt;background-color: #00CC00;" align="center">订单号</td>
         <td style="width:54pt;background-color: #00CC00;" align="center">下单日期</td>
         <td style="width:200pt;background-color: #00CC00;" align="center">客户名称</td>
         <td style="width:100pt;background-color: #00CC00;" align="center">商品分类</td>
         <td style="width:280pt;background-color: #00CC00;" align="center">商品名称</td>
         <td style="width:54pt;background-color: #00CC00;" align="center">单位</td>
         <td style="width:54pt;background-color: #00CC00;" align="center">单价</td>
         <td style="width:54pt;background-color: #00CC00;" align="center">是否对账</td>
         <td style="width:54pt;background-color: #00CC00;" align="center">交货数量</td>
     </tr>
{volist name="list" id="vo" empty="$empty"}
     <tr>
        <td align="center">{$vo.order_dn}</td>
        <td align="center">{$vo.delivery_date}</td>
        <td align="center">{$vo.order_sn}</td>
        <td align="center">{$vo.order_create_time|date='Y-m-d',###}</td>
        <td align="center">{$vo.cus_name}</td>
        <td align="center">{$vo.category_name}</td>
        <td align="center">{$vo.goods_name}</td>
        <td align="center">{$vo.unit}</td>
        <td align="center">{$vo.goods_price}</td>
        <td align="center">{if condition="$receivables.is_confirm"}
                                	已对账
                                {else}未对账{/if}</td>
        <td align="center">{$vo.current_send_number}</td>
     </tr>
{/volist}
</table>
</body>
</html>