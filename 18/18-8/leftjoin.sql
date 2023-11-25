-- SELECT カラム名 FROM テーブル1 LEFT JOIN テーブル2 ON テーブル1のカラム = テーブル2のカラム
SELECT goods_table.goods_id, goods_table.goods_name, goods_table.price, order_detail_table.quantity 
FROM goods_table 
LEFT JOIN order_detail_table ON order_detail_table.goods_id = goods_table.goods_id;
