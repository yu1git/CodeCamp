-- SELECT カラム名 FROM テーブル1 JOIN テーブル2 ON テーブル1のカラム = テーブル2のカラム
SELECT * 
FROM order_table 
JOIN customer_table ON order_table.customer_id = customer_table.customer_id;

SELECT order_table.order_date, customer_table.customer_name, order_table.payment 
FROM order_table 
JOIN customer_table ON order_table.customer_id = customer_table.customer_id;