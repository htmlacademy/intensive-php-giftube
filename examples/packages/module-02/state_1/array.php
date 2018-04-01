<?php
// объвление пустого массива
$categories = [];

// объявление массива со значениями
$categories = ["Животные", "Люди", "Наука"];
/* BEGIN STATE 01 */
// массив нельзя прочитать как простую переменную
print($categories);
/* END STATE 01 */
/* BEGIN STATE 02 */
print("<pre>");
print_r($categories);
var_dump($categories);
print("</pre>");
/* END STATE 02 */
/* BEGIN STATE 03 */
$cat_str = implode(", ", $categories);
print($cat_str);
/* END STATE 03 */
/* BEGIN STATE 04 */
$first = $categories[0];
print("Первое значение:" . $first);
/* END STATE 04 */
/* BEGIN STATE 05 */
// количество значений в массиве
$num = count($categories);
// индекс последнего значения
$last_index = $num - 1;
print("Последнее значение: " . $categories[$last_index]);
/* END STATE 05 */
/* BEGIN STATE 06 */
// добавить значение в конец
$categories[] = "Приколы";
/* END STATE 06 */
/* BEGIN STATE 07 */
// Обновить значение первого элемента
$categories[0] = "Спорт";
var_dump($categories);
/* END STATE 07 */
/* BEGIN STATE 08 */
// Добавить значение в начало массива
array_unshift($categories, "Спорт");
var_dump($categories);
/* END STATE 08 */
/* BEGIN STATE 09 */
// Удалим второй элемент массива
unset($categories[1]);
var_dump($categories);
/* END STATE 09 */
/* BEGIN STATE 10 */
// Проверяем, существует ли элемент с индексом 2
$result = isset($categories[2]);
var_dump($result);
/* END STATE 10 */
/* BEGIN STATE 11 */
// Проверяем существование значения 'Наука'
$result = in_array("Наука", $categories);
var_dump($result);
/* END STATE 11 */
/* BEGIN STATE 12 */
// Получить первый элемент и удалить его из массива
$first = array_shift($categories);
print("Первое значение: " . $first);
// Получить последний элемент и удалить его из массива
$last = array_pop($categories);
print("Последнее значение: " . $last);
/* END STATE 12 */
/* BEGIN STATE 13 */
$new_cats = ["Видеоигры", "Спорт", "Фейлы"];
// Объединяем два массива в один
$categories = array_merge($categories, $new_cats);
/* END STATE 13 */
/* BEGIN STATE 14 */
// Отсортировать значения массива в алфавитном порядке
sort($categories);
var_dump($categories);
/* END STATE 14 */