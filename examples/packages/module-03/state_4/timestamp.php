<?php
date_default_timezone_set("Europe/Moscow");

/* BEGIN STATE 01 */
// Получить текущий timestamp
$ts = time();

print("С начала 1970 года прошло $ts секунд!<br>");
/* END STATE 01 */
/* BEGIN STATE 02 */
// Узнаем когда закончится интенсив
$int_end = "10 June 2019";
$end_ts = strtotime($int_end);

print("TS для окончания интенсива: $end_ts<br>");
/* END STATE 02 */
/* BEGIN STATE 03 */
$ts = time();

// В одном дне 86400 секунд
$secs_in_day = 86400;
$end_ts = strtotime("10 June 2019");
$ts_diff = $end_ts - $ts;
$days_until_end = floor($ts_diff / $secs_in_day);

print("До окончания интенсива осталось дней: $days_until_end<br>");
/* END STATE 03 */
/* BEGIN STATE 04 */
// TS для полночи
$ts_midnight = strtotime('tomorrow');
$secs_to_midnight = $ts_midnight - time();

$hours = floor($secs_to_midnight / 3600);
$minutes = floor(($secs_to_midnight % 3600) / 60);

print("До полночи осталось: $hours часов и $minutes минут");
/* END STATE 04 */
