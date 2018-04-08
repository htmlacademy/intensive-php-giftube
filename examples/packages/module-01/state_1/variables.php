<?php
/* BEGIN STATE 01 */
$empty;
/* END STATE 01 */

/* BEGIN STATE 02 */
$username = "frexin";
/* END STATE 02 */

/* BEGIN STATE 03 */
$items_count = 25;
/* END STATE 03 */

/* BEGIN STATE 04 */
$is_finish = false;
/* END STATE 04 */

/* BEGIN STATE 05 */
$items_count += 5;
/* END STATE 05 */

/* BEGIN STATE 06 */
$greeting = "welcome " . $username;
/* END STATE 06 */

/* BEGIN STATE 07 */
print($greeting);
/* END STATE 07 */

/* BEGIN STATE 08 */
var_dump($items_count);
/* END STATE 08 */
