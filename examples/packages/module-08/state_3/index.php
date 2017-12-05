<?php
require_once 'init.php';

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

    /* BEGIN STATE 01 */
    $cur_page = $_GET['page'] ?? 1;
    $page_items = 6;
    /* END STATE 01 */

    /* BEGIN STATE 02 */
    $result = mysqli_query($link, "SELECT COUNT(*) as cnt FROM gifs");
    $items_count = mysqli_fetch_assoc($result)['cnt'];

    $pages_count = ceil($items_count / $page_items);
    $offset = ($cur_page - 1) * $page_items;
    /* END STATE 02 */

    /* BEGIN STATE 03 */
    $pages = range(1, $pages_count);
    /* END STATE 03 */

    /* BEGIN STATE 04 */
    // запрос на показ девяти самых популярных гифок
    $sql = 'SELECT gifs.id, title, path, like_count, users.name FROM gifs '
        . 'JOIN users ON gifs.user_id = users.id '
        . 'ORDER BY show_count DESC LIMIT ' . $page_items . ' OFFSET ' . $offset;
    /* END STATE 04 */

    /* BEGIN STATE 05 */
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
    /* END STATE 05 */
}

print include_template('index.php', ['content' => $content, 'categories' => $categories]);