-- emp_tableで、emp_idが1のjobをCTOに変更してください。
UPDATE emp_table SET job = 'CTO' WHERE emp_id = 1;

-- emp_tableで、ageが40以上のレコードを削除してください。
DELETE FROM emp_table WHERE age >= 40;