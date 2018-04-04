<?php
require_once 'init.php';

if (!$link) {
    $error = mysqli_connect_error();
    $content = include_template('error.php', ['error' => $error]);
}
/* BEGIN STATE 01 */
else {
    $sql = 'SELECT `id`, `name` FROM categories';
    $result = mysqli_query($link, $sql);

    /* BEGIN STATE 02 */
    if ($result) {
        $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    /* END STATE 02 */
    /* BEGIN STATE 03 */
    else {
        $error = mysqli_error($link);
        $content = include_template('error.php', ['error' => $error]);
    }
    /* END STATE 03 */
}
/* END STATE 01 */

/* BEGIN STATE 04 */
print include_template('index.php', ['content' => $content, 'categories' => $categories]);
/* END STATE 04 */