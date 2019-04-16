<?php
date_default_timezone_set("Europe/Moscow");
setlocale(LC_ALL, 'ru_RU');

/* BEGIN STATE 01 */
$int_end_str = "10.06.2019";
/* END STATE 01 */
/* BEGIN STATE 02 */
$dt_end = date_create($int_end_str);
/* END STATE 02 */
/* BEGIN STATE 03 */
$dt_now = date_create("now");
/* END STATE 03 */
/* BEGIN STATE 04 */
$dt_diff = date_diff($dt_end, $dt_now);
/* END STATE 04 */
/* BEGIN STATE 05 */
$days_count = date_interval_format($dt_diff, "%a");
/* END STATE 05 */
/* BEGIN STATE 06 */
print("До окончания интенсива осталось $days_count дней");
/* END STATE 06 */


/* BEGIN STATE 07 */
$interval = date_interval_create_from_date_string("23 day");
/* END STATE 07 */
/* BEGIN STATE 08 */
$future_dt = date_add($dt_now, $interval);
/* END STATE 08 */
/* BEGIN STATE 09 */
$dt_format = date_format($future_dt, "d.m.Y");
/* END STATE 09 */
/* BEGIN STATE 10 */
print("Через 23 дня будет $dt_format");
/* END STATE 10 */
