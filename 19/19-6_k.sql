-- 顧客毎の発注回数を取得し、名前と合わせて表示してください。
SELECT customer_table.customer_name, COUNT(customer_table.customer_name)
FROM order_table 
JOIN customer_table ON order_table.customer_id = customer_table.customer_id
GROUP BY customer_table.customer_name;

-- 値段が100円の商品に関して商品毎の売上数量を取得し、商品名と合わせて表示してください。
SELECT goods_table.goods_name, SUM(order_detail_table.quantity)
FROM goods_table 
JOIN order_detail_table ON goods_table.goods_id = order_detail_table.goods_id
JOIN order_table ON order_detail_table.order_id = order_table.order_id
GROUP BY  goods_table.goods_name;

-- 顧客毎の発注した全商品の合計金額を取得し、名前と合わせて表示してください。
SELECT customer_table.customer_name, SUM(order_detail_table.quantity * goods_table.price)
FROM order_table 
JOIN customer_table ON order_table.customer_id = customer_table.customer_id
JOIN order_detail_table ON order_table.order_id = order_detail_table.order_id
JOIN goods_table ON order_detail_table.goods_id = goods_table.goods_id
GROUP BY customer_table.customer_name;