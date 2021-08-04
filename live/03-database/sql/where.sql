SELECT * FROM users WHERE name = 'John';
SELECT * FROM users WHERE email LIKE '%@gmail.com';
SELECT * FROM users WHERE email LIKE '%@gmail.com' AND dt_add < '2019-01-01';
SELECT * FROM categories WHERE id BETWEEN 1 AND 5;
SELECT * FROM users WHERE avatar_path IS NULL;
