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
        show_error($content, mysqli_error($link));
    }

    $id = intval($_GET['id']);

    $sql = "SELECT gifs.id, title, path, description, show_count, fav_count, users.name, category_id FROM gifs "
         . "JOIN users ON gifs.user_id = users.id "
         . "WHERE gifs.id = " . $id;

    if ($result = mysqli_query($link, $sql)) {

        if (!mysqli_num_rows($result)) {
            show_error($content, 'Гифка с этим идентификатором не найдена');
        }
        else {
            $gif = mysqli_fetch_array($result, MYSQLI_ASSOC);

            /* BEGIN STATE 01 */
            $sql = "SELECT gifs.id, title, path, description, show_count, like_count, users.name FROM gifs "
                 . "JOIN users ON gifs.user_id = users.id "
                 . "WHERE category_id = " . $gif['category_id'] . " LIMIT 3";

            $result = mysqli_query($link, $sql);
			/* END STATE 01 */
            /* BEGIN STATE 02 */
            $res = mysqli_query($link, "SELECT id FROM gifs_fav WHERE gif_id = $id AND user_id = " . $_SESSION['user_id']);
            $is_fav = mysqli_num_rows($res) > 0;

            $content = include_template('gif.php', ['gif' => $gif, 'result' => $result, 'is_fav' => $is_fav]);
            /* END STATE 02 */
        }
    }
    else {
        show_error($content, mysqli_error($link));
    }
}

print include_template('index.php', ['content' => $content, 'categories' => $categories]);