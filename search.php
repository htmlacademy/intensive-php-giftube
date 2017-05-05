<?php
require_once 'init.php';

$categories = [];
$content = '';

if (!$link) {
    $error = mysqli_connect_error();
    show_error($content, $error);
}
else {
    $sql = 'SELECT `id`, `name` FROM categories';
    $result = mysqli_query($link, $sql);

    if ($result) {
        $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    else {
        show_error($content, mysqli_error($link));
    }

    $search = $_GET['q'];

    // запрос на поиск гифок по имени или описанию
    $sql = "SELECT gifs.id, title, path, like_count, users.name FROM gifs "
        . "JOIN users ON gifs.user_id = users.id "
        . "WHERE `title` LIKE '%$search%' OR `description` LIKE '%$search%'";

    if ($gifs = mysqli_query($link, $sql)) {

        // передаем в шаблон результат выполнения
        $content = include_template('search.php', ['gifs' => $gifs]);
    }
    else {
        show_error($content, mysqli_error($link));
    }
}

print include_template('index.php', ['content' => $content, 'categories' => $categories]);