<?php
require_once 'functions.php';

$content = '';
$categories = [];

$link = mysqli_connect("localhost", "giftube_edu", "cerMLxxY", "giftube_edu");


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

    $id = intval($_GET['id']);
    /* BEGIN STATE 01 */
    // запрос на показ гифки по ID
    $sql = "SELECT gifs.id, title, path, description, show_count, like_count, users.name, category_id FROM gifs "
         . "JOIN users ON gifs.user_id = users.id "
         . "WHERE gifs.id = " . $id;
    /* END STATE 01 */
    /* BEGIN STATE 02 */
    if ($result = mysqli_query($link, $sql)) {

        if (!mysqli_num_rows($result)) {
            http_response_code(404);
            $content = include_template('error.php', ['error' => 'Гифка с этим идентификатором не найдена']);
        }
        /* BEGIN STATE 03 */
        else {
            $gif = mysqli_fetch_array($result, MYSQLI_ASSOC);
            /* BEGIN STATE 04 */
            // запрос на поиск гифок по имени или описанию
            $sql = "SELECT gifs.id, title, path, description, show_count, like_count, users.name FROM gifs "
                 . "JOIN users ON gifs.user_id = users.id "
                 . "WHERE category_id = " . $gif['category_id'] . " LIMIT 3";

            $result = mysqli_query($link, $sql);

            // передаем в шаблон результат выполнения
            $content = include_template('gif.php', ['gif' => $gif, 'result' => $result]);
            /* END STATE 04 */
        }
        /* END STATE 03 */
    }
    else {
        show_error($content, mysqli_error($link));
    }
    /* END STATE 02 */
}

print include_template('index.php', ['content' => $content, 'categories' => $categories]);