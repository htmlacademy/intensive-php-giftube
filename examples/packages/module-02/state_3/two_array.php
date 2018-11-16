<?php
$first_gif = [
	'gif' => '/uploads/preview_gif58d28ce80e3a9.gif',
	'title' => 'Енотик',
	'likes_count' => 0
];

$second_gif = [
	'gif' => '/uploads/preview_gif58d29cfc805a2.gif',
	'title' => 'Кот-доминатор',
	'likes_count' => 0
];

/* BEGIN STATE 01 */
// Создаем двумерный массив
$gif_list = [$first_gif, $second_gif];

print("<pre>");
print_r($gif_list);
print("</pre>");
/* END STATE 01 */
/* BEGIN STATE 02 */
$gif_list = [
	[
		'gif' => '/uploads/preview_gif58d28ce80e3a9.gif',
		'title' => 'Енотик',
		'likes_count' => 0
	],
	[
		'gif' => '/uploads/preview_gif58d29cfc805a2.gif',
		'title' => 'Кот-доминатор',
		'likes_count' => 0
	]
];

print("<pre>");
print_r($gif_list);
print("</pre>");
/* END STATE 02 */
/* BEGIN STATE 03 */
$gif_list = [$first_gif, $second_gif];

// Обращение к значениям в двумерном массиве
print($gif_list[0]['title']);
/* END STATE 03 */
/* BEGIN STATE 04 */
$gif_list = [$first_gif, $second_gif];
