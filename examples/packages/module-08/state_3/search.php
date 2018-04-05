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

	$gifs = [];

    /* BEGIN STATE 01 */
	mysqli_query($link, 'CREATE FULLTEXT INDEX gif_ft_search ON gifs(title, description)');
	/* END STATE 01 */

	/* BEGIN STATE 02 */
	$search = $_GET['q'] ?? '';
	/* END STATE 02 */

	/* BEGIN STATE 03 */
	if ($search) {
		/* BEGIN STATE 04 */
		$sql = "SELECT gifs.id, title, path, like_count, users.name FROM gifs "
		  . "JOIN users ON gifs.user_id = users.id "
		  . "WHERE MATCH(title, description) AGAINST(?)";
		/* END STATE 04 */

		/* BEGIN STATE 05 */
		$stmt = db_get_prepare_stmt($link, $sql, [$search]);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

		$gifs = mysqli_fetch_all($result, MYSQLI_ASSOC);
		/* END STATE 05 */
	}
	/* END STATE 03 */

	$content = include_template('search.php', ['gifs' => $gifs]);
}

print include_template('index.php', ['content' => $content, 'categories' => $categories]);