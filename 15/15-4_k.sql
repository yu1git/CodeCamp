-- テーブル作成
CREATE TABLE user_table(user_id int PRIMARY KEY AUTO_INCREMENT, user_name varchar(20) NOT NULL, mail_address varchar(50) UNIQUE NOT NULL, status int NOT NULL);

-- レコード追加
INSERT INTO user_table (user_name, mail_address, status) VALUES 
('一郎', 'hoge@example.com', 0),
('まる', 'fuga@example.com', 1),
('花子', 'hogehoge@example.com', 1),
('一郎', 'fugafuga@example.com', 0);