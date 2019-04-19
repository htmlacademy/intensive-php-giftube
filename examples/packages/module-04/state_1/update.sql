
/* BEGIN STATE 01 */
UPDATE gifs SET title = 'описание' WHERE id = 2;
/* END STATE 01 */
/* BEGIN STATE 02 */
UPDATE users SET password = 'secretpass', name = 'joker07' WHERE id = 1;
/* END STATE 02 */
/* BEGIN STATE 03 */
UPDATE gifs SET like_count = like_count + 1 WHERE id = 2;
/* END STATE 03 */
