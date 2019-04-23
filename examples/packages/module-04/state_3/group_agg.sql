
/* BEGIN STATE 01 */
SELECT category_id FROM gifs GROUP BY category_id;
/* END STATE 01 */
/* BEGIN STATE 02 */
SELECT COUNT(id) gifs_cnt, category_id FROM gifs GROUP BY category_id;
/* END STATE 02 */
/* BEGIN STATE 03 */
SELECT email, COUNT(g.id) gifs_total FROM users u
JOIN gifs g ON u.id = g.user_id
GROUP BY email ORDER BY gifs_total DESC;
/* END STATE 03 */
/* BEGIN STATE 04 */
SELECT SUM(show_count) total_show, COUNT(g.id) total_count, c.name
FROM gifs g INNER JOIN categories c ON g.category_id = c.id
GROUP BY category_id ORDER BY total_show DESC;
/* END STATE 04 */
