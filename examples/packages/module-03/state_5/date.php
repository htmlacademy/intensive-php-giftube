<?php
date_default_timezone_set("Europe/Moscow");

/* BEGIN STATE 01 */
// Покажем текущую дату
$curdate = date('d.m.Y');
print("Текущая дата: $curdate<br>");
/* END STATE 01 */

/* BEGIN STATE 02 */
// Покажем текущее время
$curtime = date('H:i:s');
print("Текущее время: $curtime<br>");
/* END STATE 02 */

/* BEGIN STATE 03 */
// Сколько времени сейчас в NY
date_default_timezone_set("America/New_York");
$nytime = $curtime = date('H:i:s');
print("Время в Нью-Йорке: $nytime<br>");
/* END STATE 03 */

/* BEGIN STATE 04 */
setlocale(LC_ALL, 'ru_RU');
// Какой сейчас день недели
$dow = strftime("%A");
print("День недели: $dow<br>");
/* END STATE 04 */

/* BEGIN STATE 05 */
// Сколько осталось дней до нового года
$curday = date('z');
$ydc = date('L') ? 366 : 365;
$days_remaining = $ydc - $curday;

print("До нового года осталось дней: $days_remaining");
/* END STATE 05 */