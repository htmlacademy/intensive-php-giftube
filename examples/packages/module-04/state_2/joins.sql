
/* BEGIN STATE 01 */
SELECT * FROM comments;
/* END STATE 01 */
/* BEGIN STATE 02 */
SELECT c.dt_add, c.content, u.name FROM comments c
/* BEGIN STATE 03 */
INNER JOIN users u ON c.user_id = u.id;
/* END STATE 03 */
/* END STATE 02 */
/* BEGIN STATE 04 */
SELECT c.name, u.name, show_count, title
FROM gifs g
JOIN categories c ON g.category_id = c.id
JOIN users u ON g.user_id = u.id
/* BEGIN STATE 05 */
LEFT JOIN comments c2 on g.id = c2.gif_id
/* END STATE 05 */
/* END STATE 04 */
