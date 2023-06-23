-- character_table
-- テーブル作成
CREATE TABLE character_table(character_id int PRIMARY KEY, character_name varchar(20), pref varchar(20));

-- レコード追加
INSERT INTO character_table(character_id, character_name, pref) VALUES 
(1, 'ふなっしー', '千葉県'),
(2, 'ひこにゃん', '滋賀県'),
(3, 'まりもっこり', '北海道');

-- 全データを表示
SELECT * FROM character_table;

-- emp_table
-- テーブル作成
CREATE TABLE emp_table(emp_id int PRIMARY KEY, emp_name varchar(20), job varchar(20), age int);

-- レコード追加
INSERT INTO emp_table(emp_id, emp_name, job, age) VALUES
(1, '山田太郎', 'manager', 50),
(2, '伊藤静香', 'manager', 45),
(3, '鈴木三郎', 'analyst', 30),
(4, '山田花子', 'clerk', 24);

-- emp_idとemp_nameのみ表示
SELECT emp_id, emp_name FROM emp_table;