<?php
require_once 'init.php';

if (!$link) {
    $error = mysqli_connect_error();
    $content = include_template('error.php', ['error' => $error]);
}
else {
    $sql = 'SELECT `id`, `name` FROM categories';

    $result = mysqli_query($link, $sql);

    if ($result) {
        $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    else {
        $error = mysqli_error($link);
        $content = include_template('error.php', ['error' => $error]);
    }

    /* BEGIN STATE 01 */
    $sort_field = 'show_count';
	/* END STATE 01 */

	/* BEGIN STATE 02 */
    if (isset($_GET['tab']) && $_GET['tab'] == 'new') {
    	$sort_field = 'dt_add';
	}
	/* END STATE 02 */

	/* BEGIN STATE 03 */
    $sql = 'SELECT gifs.id, title, path, like_count, users.name FROM gifs g '
         . 'JOIN users u ON gifs.user_id = users.id '
         . 'ORDER BY g.' . $sort_field  . ' DESC LIMIT 9';
    /* END STATE 03 */

    /* BEGIN STATE 04 */
    if ($res = mysqli_query($link, $sql)) {
        $gifs = mysqli_fetch_all($res, MYSQLI_ASSOC);
        $content = include_template('main.php', ['gifs' => $gifs]);
    }
    else {
        $content = include_template('error.php', ['error' => mysqli_error($link)]);
    }
    /* END STATE 04 */
}

print include_template('layout.php', ['content' => $content, 'categories' => $categories]);