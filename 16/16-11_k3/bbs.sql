-- テーブル作成
-- CREATE TABLE bbs_table(id int PRIMARY KEY AUTO_INCREMENT, name varchar(20) NOT NULL, comment varchar(250) NOT NULL, create_date DATETIME NOT NULL);
CREATE TABLE bbs_table(id int PRIMARY KEY AUTO_INCREMENT, name varchar(20) NOT NULL, comment varchar(100) NOT NULL, create_date DATETIME NOT NULL);
-- varchar(100)にした場合、日本語の全角文字数100まではいる
-- 参考：https://oreno-it3.info/archives/350