/* BEGIN STATE 01 */
SELECT id, title, DATE_FORMAT(dt_add, '%d.%m.%y %H:%i') dt FROM gifs;
/* END STATE 01 */
/* BEGIN STATE 02 */
SELECT id, title FROM gifs
WHERE dt_add > DATE_SUB(NOW(), INTERVAL 7 DAY);
/* END STATE 02 */
/* BEGIN STATE 03 */
SELECT id, title FROM gifs
WHERE YEAR(dt_add) = 2017;
/* END STATE 03 */
/* BEGIN STATE 04 */
SELECT STR_TO_DATE("03.09.2001", "%d.%m.%Y") mysql_date;
/* END STATE 04 */
