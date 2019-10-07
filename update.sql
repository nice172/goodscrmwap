ALTER TABLE syc_customers ADD payment_way VARCHAR(50) NOT NULL DEFAULT '' COMMENT '付款方式' AFTER cus_order_ren;
ALTER TABLE syc_receivables ADD tax VARCHAR(50) NOT NULL DEFAULT '' COMMENT '税率' AFTER invoice_date;
ALTER TABLE syc_receivables ADD confirm_time int(10) NOT NULL DEFAULT '0' COMMENT '确认日期' AFTER invoice_date;
ALTER TABLE syc_payment_order ADD tax VARCHAR(50) NOT NULL DEFAULT '' COMMENT '税率' AFTER invoice_date;
ALTER TABLE syc_payment_order ADD confirm_time int(10) NOT NULL DEFAULT '0' COMMENT '确认日期' AFTER invoice_date;