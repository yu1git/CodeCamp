-- 1.発注に関して、customer_idとgoods_idを除く全情報を取得
SELECT order_table.order_id, order_table.order_date, customer_table.customer_name, customer_table.address, customer_table.phone_number, order_table.payment, goods_table.goods_name, goods_table.price, order_detail_table.quantity 
FROM order_table 
JOIN customer_table ON order_table.customer_id = customer_table.customer_id
JOIN order_detail_table ON order_table.order_id = order_detail_table.order_id
JOIN goods_table ON order_detail_table.goods_id = goods_table.goods_id;

-- 2.佐藤一郎さんの発注した商品情報を取得
SELECT order_table.order_id, order_table.order_date, customer_table.customer_name, goods_table.goods_name, goods_table.price, order_detail_table.quantity 
FROM order_table 
JOIN customer_table ON order_table.customer_id = customer_table.customer_id
JOIN order_detail_table ON order_table.order_id = order_detail_table.order_id
JOIN goods_table ON order_detail_table.goods_id = goods_table.goods_id
WHERE customer_table.customer_id = 1;
-- 基本的にはidで検索

-- 3.コーラの売上情報を取得
SELECT goods_table.goods_name, goods_table.price, order_detail_table.quantity, order_table.order_date
FROM goods_table 
JOIN order_detail_table ON goods_table.goods_id = order_detail_table.goods_id
JOIN order_table ON order_detail_table.order_id = order_table.order_id
WHERE goods_table.goods_name = 'コーラ';

-- 4.1回あたりの購入数が多い順に全商品の売上情報を取得
SELECT goods_table.goods_name, goods_table.price, order_detail_table.quantity, order_table.order_date
FROM goods_table 
LEFT JOIN order_detail_table ON goods_table.goods_id = order_detail_table.goods_id
LEFT JOIN order_table ON order_detail_table.order_id = order_table.order_id
ORDER BY order_detail_table.quantity DESC;