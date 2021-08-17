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
        show_error($content, mysqli_error($link));
    }

	$gifs = [];

	mysqli_query($link, 'CREATE FULLTEXT INDEX gif_ft_search ON gifs(title, description)');

	$search = $_GET['q'] ?? '';

	if ($search) {
		$sql = "SELECT gifs.id, title, path, like_count, users.name FROM gifs "
		  . "JOIN users ON gifs.user_id = users.id "
		  . "WHERE MATCH(title, description) AGAINST(?)";

		$stmt = db_get_prepare_stmt($link, $sql, [$search]);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

		$gifs = mysqli_fetch_all($result, MYSQLI_ASSOC);
	}

	$content = include_template('search.php', ['gifs' => $gifs]);
}

print include_template('layout.php', ['content' => $content, 'categories' => $categories, 'title' => "Поиск по названию"]);