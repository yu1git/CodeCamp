DELETE FROM customer_table;
INSERT INTO customer_table (customer_id, customer_name, address, phone_number) VALUES
(1, '佐藤一郎', '東京都港区六本木6-10-1', '0345670000'),
(2, '鈴木誠', '神奈川県横浜市中区立野2-1', '09099991111'),
(3, '山田葵', '東京都杉並区今川5-3', '0378902222');
 
DELETE FROM order_table;
INSERT INTO order_table (order_id, customer_id, order_date, payment) VALUES
(1, 1, '2017-10-01 10:22:30', 'クレジット'),
(2, 2, '2017-10-01 18:51:06', 'クレジット'),
(3, 3, '2017-10-02 09:14:35', '代金引換'),
(4, 1, '2017-10-03 11:00:57', 'クレジット');
 
DELETE FROM order_detail_table;
INSERT INTO order_detail_table (order_id, goods_id, quantity) VALUES
(1, 1, 3),(1, 5, 3),(2, 2, 1),(3, 1, 10),(3, 4, 10),(4, 1, 5);