
/* BEGIN STATE 01 */
SELECT COUNT(id) users_count FROM users;
/* END STATE 01 */
/* BEGIN STATE 02 */
SELECT SUM(show_count) total_shows FROM gifs;
/* END STATE 02 */
/* BEGIN STATE 03 */
SELECT AVG(like_count) total_likes FROM gifs;
/* END STATE 03 */
/* BEGIN STATE 04 */
SELECT MIN(dt_add) dt FROM gifs;
/* END STATE 04 */
