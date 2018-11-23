SELECT c.name, user_id, title, path
FROM gifs g
       JOIN categories c ON g.category_id = c.id;

SELECT c.name, email, title, path
FROM gifs g
JOIN categories c ON g.category_id = c.id
JOIN users u ON g.user_id = u.id;