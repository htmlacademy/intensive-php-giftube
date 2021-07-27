<?php
require_once 'data.php';

print("Начало работы цикла\n");

for ($i = 0; $i < 10; $i++) {
    print("Текущий элемент: $i\n");
}

print("Окончание работы цикла\n");

/* ----------------------- */

$num = count($categories);

for ($i = 0; $i < $num; $i++) {
    print($categories[$i] . "\n");
}