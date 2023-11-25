SELECT * 
FROM order_table 
JOIN order_detail_table ON order_table.order_id = order_detail_table.order_id 
JOIN goods_table ON order_detail_table.goods_id = goods_table.goods_id;