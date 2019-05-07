/* BEGIN STATE 01 */
SELECT * FROM users
WHERE id IN (SELECT user_id FROM gifs GROUP BY user_id);
/* END STATE 01 */
/* BEGIN STATE 02 */
SELECT email, (SELECT COUNT(g.id) FROM gifs g WHERE g.user_id = u.id) gifs_count
FROM users u
HAVING gifs_count > 0;
/* END STATE 02 */
/* BEGIN STATE 03 */
SELECT email, dt_add
FROM users
WHERE dt_add < (SELECT AVG(`dt_add`) FROM users);
/* END STATE 03 */
