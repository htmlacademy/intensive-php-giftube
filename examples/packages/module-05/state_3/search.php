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

    /* BEGIN STATE 01 */
    $search = trim($_GET['q']) ?? '';
    $search = mysqli_real_escape_string($link, $search);
    /* END STATE 01 */

    /* BEGIN STATE 02 */
	if (!strlen($search)) {
		$content = include_template('search.php', ['gifs' => []]);
	}
	else {
		/* BEGIN STATE 03 */
		// запрос на поиск гифок по имени или описанию
		$sql = "SELECT gifs.id, title, path, like_count, users.name FROM gifs "
		  . "JOIN users ON gifs.user_id = users.id "
		  . "WHERE `title` LIKE '%$search%' OR `description` LIKE '%$search%'";
		/* END STATE 03 */

		/* BEGIN STATE 04 */
		if ($gifs = mysqli_query($link, $sql)) {
			$gifs = mysqli_fetch_all($gifs, MYSQLI_ASSOC);
			// передаем в шаблон результат выполнения
			$content = include_template('search.php', ['gifs' => $gifs]);
		}
		/* END STATE 04 */
		/* BEGIN STATE 05 */
		else {
			$content = include_template('error.php', ['error' => mysqli_error($link)]);
		}
		/* END STATE 05 */
	}
	/* END STATE 02 */
}

print(include_template('index.php', ['content' => $content, 'categories' => $categories]));