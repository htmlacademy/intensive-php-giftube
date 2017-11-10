<?php
require_once 'init.php';
require_once 'functions.php';

/* BEGIN STATE 01 */
$sql = "SELECT t1.*, u.name as authorName FROM gifs t1
        INNER JOIN users u     ON t1.user_id = u.id
        INNER JOIN gifs_fav gf ON t1.id = gf.gif_id AND gf.user_id = ?";
/* END STATE 01 */
/* BEGIN STATE 02 */
$gifs = cache_get_data($link, $sql, [$_SESSION['user_id']], 'user_fav');
$content = include_template('favorites.php', ['gifs' => $gifs]);
/* END STATE 02 */

print include_template('index.php', ['content' => $page_content, 'categories' => []]);