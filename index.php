<?php
require_once 'init.php';

$categories = [];

if (!$link) {
    $error = mysqli_connect_error();
    $content = include_template('error.php', ['error' => $error]);
}
else {
    // Запрос на получение списка категорий
    $sql = 'SELECT `id`, `name` FROM categories';

    // Выполняем запрос и получаем результат
    $result = mysqli_query($link, $sql);

    // запрос выполнен успешно
    if ($result) {
        // получаем все категории в виде двумерного массива
        $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    else { // запрос выполнился с ошибкой

        // получить текст последней ошибки
        $error = mysqli_error($link);
        $content = include_template('error.php', ['error' => $error]);
    }
}

print include_template('index.php', ['content' => $content, 'categories' => $categories]);