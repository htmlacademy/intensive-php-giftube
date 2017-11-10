<?php
$gif = [
	'gif' => '/uploads/preview_gif58d28ce80e3a9.gif',
	'title' => 'Енотик',
	'likes_count' => 0
];
/* BEGIN STATE 01 */
// Добавить новое значение с ключом
$gif['author'] = "frexin";
/* END STATE 01 */
/* BEGIN STATE 02 */

// Получить значение по ключу
print($gif['title']);
/* END STATE 02 */
/* BEGIN STATE 03 */

$gif['likes_count'] = $gif['likes_count'] + 1;
$gif['title'] = 'Бегущий енотик';
/* END STATE 03 */
/* BEGIN STATE 04 */
// Получить все ключи из массива
$keys = array_keys($gif);

// Получить последний ключ
$last_key = array_pop($keys);

// Получить значение по этому ключу
$last_val = $gif[$last_key];
/* END STATE 04 */