<?php
require_once '../common/init.php';

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
        $error = mysqli_error($link);
        show_error($content, $error);
    }

    $cur_page = $_GET['page'] ?? 1;
    $page_items = 6;

    $result = mysqli_query($link, "SELECT COUNT(*) as cnt FROM gifs");
    $items_count = mysqli_fetch_assoc($result)['cnt'];

    $pages_count = ceil($items_count / $page_items);
    $offset = ($cur_page - 1) * $page_items;

    $pages = range(1, $pages_count);

    // запрос на показ девяти самых популярных гифок
    $sql = 'SELECT gifs.id, title, path, like_count, users.name FROM gifs '
        . 'JOIN users ON gifs.user_id = users.id '
        . 'ORDER BY show_count DESC LIMIT ' . $page_items . ' OFFSET ' . $offset;

    if ($gifs = mysqli_query($link, $sql)) {
        $tpl_data = [
            'gifs' => $gifs,
            'pages' => $pages,
            'pages_count' => $pages_count,
            'cur_page' => $cur_page
        ];

        $content = include_template('main.php', $tpl_data);
    }
    else {
        show_error($content, mysqli_error($link));
    }
}

print include_template('layout.php', ['content' => $content, 'categories' => $categories, 'title' => 'Главная страница']);