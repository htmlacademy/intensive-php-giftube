<?php
// отключаем компрессию вывода
ini_set('zlib.output_compression',0);

/* BEGIN STATE 01 */
print("<h1>Подождите 10 секунд</h1>");
/* END STATE 01 */

/* BEGIN STATE 02 */
$counter = 1;

while ($counter <= 10) {
	/* BEGIN STATE 03 */
	print($counter);
	print("<br>");
	// хак, чтобы преодолеть минимальный размер буфера
	print(str_repeat(' ', 1024*64));
	/* END STATE 03 */
	/* BEGIN STATE 04 */
	flush();
	/* END STATE 04 */

	/* BEGIN STATE 05 */
	$counter++;
	sleep(1);
	/* END STATE 05 */
}
/* END STATE 02 */