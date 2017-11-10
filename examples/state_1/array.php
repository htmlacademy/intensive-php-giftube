<?php
/* BEGIN STATE 01 */
// объвление пустого массива
$categories = [];
/* END STATE 01 */
/* BEGIN STATE 02 */
// массив со значениями
$categories = ["Животные", "Люди", "Наука"];
/* END STATE 02 */
/* BEGIN STATE 03 */
// создать массив из строки
$categories = explode(",", "Животные,Люди,Наука");
/* END STATE 03 */
/* BEGIN STATE 04 */
$categories = ["Животные", "Люди", "Наука"];
// массив нельзя прочитать как простую переменную
print($categories);
/* END STATE 04 */
/* BEGIN STATE 05 */
$categories = ["Животные", "Люди", "Наука"];

print("<pre>");
print_r($categories);
print("</pre>");

print("<pre>");
var_dump($categories);
print("</pre>");
/* END STATE 05 */
/* BEGIN STATE 06 */
$categories = ["Животные", "Люди", "Наука"];

$cat_str = implode(", ", $categories);
print($cat_str);
/* END STATE 06 */
/* BEGIN STATE 07 */
$categories = ["Животные", "Люди", "Наука"];

$first = $categories[0];
print("Первое значение:" . $first);
/* END STATE 07 */
/* BEGIN STATE 08 */
$categories = ["Животные", "Люди", "Наука"];

// количество значений в массиве
$num = count($categories);
// индекс последнего значения
$last_index = $num - 1;

print("Последнее значение: " . $categories[$last_index]);
/* END STATE 08 */
/* BEGIN STATE 09 */
$categories = ["Животные", "Люди", "Наука"];

// добавить значение в конец
$categories[] = "Приколы";
/* END STATE 09 */
/* BEGIN STATE 10 */
$categories = ["Животные", "Люди", "Наука"];

// Обновить значение первого элемента
$categories[0] = "Спорт";
/* END STATE 10 */
/* BEGIN STATE 11 */
$categories = ["Животные", "Люди", "Наука"];

// Добавить значение в начало массива
array_unshift($categories, "Спорт");
/* END STATE 11 */
/* BEGIN STATE 12 */
$categories = ["Животные", "Люди", "Наука"];

// Удалим второй элемент массива
unset($categories[1]);
/* END STATE 12 */
/* BEGIN STATE 13 */
$categories = ["Животные", "Люди", "Наука"];

// Проверяем, существует ли элемент с индексом 2
$result = isset($categories[2]);

var_dump($result);
/* END STATE 13 */
/* BEGIN STATE 14 */
$categories = ["Животные", "Люди", "Наука"];

// Проверяем существование значения 'Наука'
$result = in_array("Наука", $categories);

var_dump($result);
/* END STATE 14 */
/* BEGIN STATE 15 */
$categories = ["Животные", "Люди", "Наука"];

// Получить первый элемент и удалить его из массива
$first = array_shift($categories);
print("Первое значение: " . $first);

// Получить последний элемент и удалить его из массива
$last = array_pop($categories);
print("Последнее значение: " . $last);
/* END STATE 15 */
/* BEGIN STATE 16 */
$categories = ["Животные", "Люди", "Наука"];

$new_cats = ["Видеоигры", "Спорт", "Фейлы"];

// Объединяем два массива в один
$categories = array_merge($categories, $new_cats);
/* END STATE 16 */
/* BEGIN STATE 17 */
$categories = ["Животные", "Люди", "Наука", "Видеоигры", "Спорт", "Фейлы"];

// Отсортировать значения массива в алфавитном порядке
sort($categories);
/* END STATE 17 */