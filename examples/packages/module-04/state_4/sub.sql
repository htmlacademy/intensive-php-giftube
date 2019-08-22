SELECT * FROM users WHERE id IN
(SELECT user_id FROM gifs GROUP BY user_id);

