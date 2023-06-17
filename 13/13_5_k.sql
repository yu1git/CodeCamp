-- goods_tableで、priceが500以下のデータを表示してください。
SELECT * FROM goods_table WHERE price <= 500;

-- character_tableで、 prefが「県」で終わるデータのcharacter_idとcharacter_nameを表示してください。
SELECT character_id, character_name FROM character_table WHERE pref LIKE '%県';

-- emp_tableでjobがclerkのemp_idとageを表示してください。
SELECT emp_id, age FROM emp_table WHERE job = 'clerk';

-- emp_tableでjobがanalyst または ageが20以上25以下のemp_idとemp_nameを表示してください。
SELECT emp_id, emp_name FROM emp_table WHERE job = 'analyst' OR age BETWEEN 20 AND 25;