SELECT * FROM users;
SELECT email, name, dt_add FROM users;
SELECT name, dt_add FROM users ORDER BY dt_add ASC;

SELECT id, email, name FROM users WHERE id = 1;
SELECT show_count, title, description FROM gifs WHERE show_count > 100;
SELECT show_count, title, description FROM gifs WHERE category_id IN (2,4);
SELECT id, email, name FROM users WHERE avatar_path IS NULL;