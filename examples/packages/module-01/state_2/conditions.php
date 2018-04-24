<?php
/* BEGIN STATE 01 */
date_default_timezone_set('Europe/Moscow');
$day_of_week  = date('N');
$current_hour = date('G');
/* END STATE 01 */

/* BEGIN STATE 02 */
$rus_post_status = "";
/* END STATE 02 */

/* BEGIN STATE 03 */
if ($day_of_week == 6 or $day_of_week == 7) {
    $rus_post_status = "У нас выходной. Приходите в понедельник.";
}
/* END STATE 03 */
/* BEGIN STATE 04 */
else {

    /* BEGIN STATE 05 */
    if ($current_hour == 13) {
        $rus_post_status = "Вы что не видите, у нас обед";
    }
    /* END STATE 05 */
    /* BEGIN STATE 06 */
    else if ($current_hour > 8 and $current_hour < 19) {
        $rus_post_status = "Давайте ваше письмо… Стоп, а марки где?!";
    }
    /* END STATE 06 */
    /* BEGIN STATE 07 */
    else {
        $rus_post_status = "Мы закрыты, приходите завтра";
    }
    /* END STATE 07 */
}
/* END STATE 04 */

/* BEGIN STATE 08 */
print($rus_post_status);
/* END STATE 08 */
