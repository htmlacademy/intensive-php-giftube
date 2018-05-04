SELECT AVG(show_count) FROM gifs;
SELECT COUNT(id) FROM users;
SELECT SUM(fav_count) FROM gifs;

SELECT user_id, COUNT(id) as upload_count FROM gifs GROUP BY user_id;
