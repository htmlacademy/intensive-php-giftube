/* BEGIN STATE 01 */
SELECT title, description, MATCH(title,description) AGAINST('когда') as score FROM gifs
WHERE MATCH(title,description) AGAINST('когда');
/* END STATE 01 */
/* BEGIN STATE 02 */
SELECT * FROM gifs WHERE MATCH(title,description) AGAINST('рыба');
/* END STATE 02 */
/* BEGIN STATE 03 */
SELECT * FROM gifs WHERE MATCH(title,description) AGAINST('енотик кот');
/* END STATE 03 */
