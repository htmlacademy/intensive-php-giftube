<?php
/* BEGIN STATE 01 */
$young = false;
$beautiful = false;

$will_you_love = $young and $beautiful;
var_dump($will_you_love);
/* END STATE 01 */

/* BEGIN STATE 02 */
$day_of_week = date('N'); // номер дня недели
$cur_hour = date('G'); // который час

$get_beer = $day_of_week == 5 and $cur_hour > 18;
var_dump($get_beer);
/* END STATE 02 */

/* BEGIN STATE 03 */
$age = 25;
$mlp_fan = $age < 12 or $age > 35;

var_dump($mlp_fan);
/* END STATE 03 */
