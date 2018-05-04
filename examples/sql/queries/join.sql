SELECT c.id, email, content FROM comments c JOIN users u ON c.user_id = u.id

SELECT c.name as catname, u.name as gifname, g.title FROM gifs g
JOIN categories c ON g.category_id = c.id
JOIN users u ON g.user_id = u.id

SELECT u.name, COUNT(*) AS upload_count
FROM gifs g
JOIN users u ON g.user_id = u.id
GROUP BY u.name
ORDER BY upload_count DESC