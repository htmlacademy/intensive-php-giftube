
/* BEGIN STATE 01 */
DELETE FROM categories
/* BEGIN STATE 02 */
WHERE id = 1;
/* END STATE 02 */
/* END STATE 01 */
/* BEGIN STATE 03 */
DELETE FROM gifs WHERE like_count < 10;
/* END STATE 02 */
