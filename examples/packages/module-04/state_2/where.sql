/* BEGIN STATE 01 */
SELECT * FROM users WHERE name = 'John';
/* END STATE 01 */
/* BEGIN STATE 02 */
SELECT * FROM users WHERE email LIKE '%@gmail.com';
/* END STATE 02 */
/* BEGIN STATE 03 */
SELECT * FROM users WHERE email LIKE '%@gmail.com' AND dt_add < '2019-01-01';
/* END STATE 03 */
/* BEGIN STATE 04 */
SELECT * FROM categories WHERE id BETWEEN 1 AND 5;
/* END STATE 04 */

