<?php
/* BEGIN STATE 01 */
$counter_name = "visitcount";
/* END STATE 01 */
/* BEGIN STATE 02 */
$counter_value = 1;
/* END STATE 02 */
/* BEGIN STATE 03 */
$expire = strtotime("+30 days");
/* END STATE 03 */
/* BEGIN STATE 04 */
$path = "/";
/* END STATE 04 */

/* BEGIN STATE 05 */
if (isset($_COOKIE['visitcount'])) {
	$counter_value = $_COOKIE['visitcount'];
	$counter_value++;
}
/* END STATE 05 */

/* BEGIN STATE 06 */
setcookie($counter_name, $counter_value, $expire, $path);
/* END STATE 06 */
/* BEGIN STATE 07 */
print("<h1>$counter_value</h1>");
/* END STATE 07 */