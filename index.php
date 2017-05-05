<?php
require_once 'init.php';

if (!$link) {
    $error = mysqli_connect_error();
    show_error($content, $error);
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
        show_error($content, $error);
    }

    // запрос на показ девяти самых популярных гифок
    $sql = 'SELECT gifs.id, title, path, like_count, users.name FROM gifs '
        . 'JOIN users ON gifs.user_id = users.id '
        . 'ORDER BY show_count DESC LIMIT 9';

    if ($gifs = mysqli_query($link, $sql)) {

        // передаем в шаблон результат выполнения
        $content = include_template('main.php', ['gifs' => $gifs]);
    }
    else {
        show_error($content, mysqli_error($link));
    }
}

print include_template('index.php', ['content' => $content, 'categories' => $categories]);