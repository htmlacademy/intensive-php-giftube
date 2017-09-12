<?php
require_once 'functions.php';

$content = '';
$categories = [];

$link = mysqli_connect("localhost", "root", "", "giftube");

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
    else {
        // получить текст последней ошибки
        $error = mysqli_error($link);
        $content = include_template('error.php', ['error' => $error]);
    }
    /* BEGIN STATE 01 */
    // запрос на показ девяти самых популярных гифок
    $sql = 'SELECT gifs.id, title, path, like_count, users.name FROM gifs '
         . 'JOIN users ON gifs.user_id = users.id '
         . 'ORDER BY show_count DESC LIMIT 9';
    /* END STATE 01 */

    /* BEGIN STATE 02 */
    if ($gifs = mysqli_query($link, $sql)) {
        // передаем в шаблон результат выполнения
        $content = include_template('main.php', ['gifs' => $gifs]);
    }
    /* END STATE 02 */
    /* BEGIN STATE 03 */
    else {
        $content = include_template('error.php', ['error' => mysqli_error($link)]);
    }
    /* END STATE 03 */

}

print include_template('index.php', ['content' => $content, 'categories' => $categories]);