/* BEGIN STATE 01 */
SELECT id, title, description FROM gifs WHERE title LIKE 'рыбак';
/* END STATE 01 */
/* BEGIN STATE 02 */
SELECT id, title, description FROM gifs WHERE description LIKE 'когда%';
/* END STATE 02 */
/* BEGIN STATE 03 */
SELECT id, title, description FROM gifs WHERE title LIKE '%рыба%' OR description LIKE '%рыба%';
/* END STATE 03 */
/* BEGIN STATE 04 */
SELECT id, title, description FROM gifs WHERE title LIKE '%енотик кот%' OR description LIKE '%енотик кот%';
/* END STATE 04 */
