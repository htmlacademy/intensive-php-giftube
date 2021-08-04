SELECT * FROM comments;

SELECT c.dt_add, c.content, u.name FROM comments c
INNER JOIN users u ON c.user_id = u.id;

SELECT c.name, u.name, show_count, title
FROM gifs g
JOIN categories c ON g.category_id = c.id
JOIN users u ON g.user_id = u.id
LEFT JOIN comments c2 on g.id = c2.gif_id;

SELECT title, path FROM gifs
JOIN gifs_fav ON gifs.id = gifs_fav.gif_id
JOIN users ON gifs_fav.user_id = users.id
WHERE users.email = 'tbaranov@bk.ru';
