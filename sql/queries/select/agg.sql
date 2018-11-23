SELECT COUNT(id) FROM users;

SELECT AVG(like_count) FROM gifs;

SELECT email, COUNT(g.id) FROM users u
JOIN gifs g ON u.id = g.user_id
GROUP BY email;