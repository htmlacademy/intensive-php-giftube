
/* BEGIN STATE 01 */
INSERT INTO users
/* BEGIN STATE 02 */
SET email = 'john.smith@gmail.com', name = 'John', dt_add = NOW(), password = 'supersecret';
/* END STATE 02 */
/* END STATE 01 */

/* BEGIN STATE 03 */
INSERT INTO categories (name)
/* BEGIN STATE 04 */
VALUES ('Мемы'), ('Новости');
/* END STATE 04 */
/* END STATE 03 */
