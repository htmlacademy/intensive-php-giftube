/* BEGIN STATE 01 */
SELECT * FROM gifs WHERE MATCH(title, description) AGAINST('рыба*' IN BOOLEAN MODE);
/* END STATE 01 */
/* BEGIN STATE 02 */
SELECT * FROM gifs WHERE MATCH(title, description) AGAINST('кот -юзер' IN BOOLEAN MODE);
/* END STATE 02 */
/* BEGIN STATE 03 */
SELECT * FROM gifs WHERE MATCH(title, description) AGAINST('"горькая правда"' IN BOOLEAN MODE);
/* END STATE 03 */
