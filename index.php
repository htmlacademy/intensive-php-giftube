<?php
require_once 'init.php';
require_once 'DbHelper.php';

$dbHelper = new DbHelper(...$db_cfg);

if ($dbHelper->getLastError()) {
	show_error($content, $dbHelper->getLastError());
}
else {
	$dbHelper->executeQuery('SELECT `id`, `name` FROM categories');

	if (!$dbHelper->getLastError()) {
		$categories = $dbHelper->getResultAsArray();
	}
	else {
		show_error($content, $dbHelper->getLastError());
	}

	$cur_page = $_GET['page'] ?? 1;
	$page_items_count = 6;

	$dbHelper->executeQuery("SELECT COUNT(*) as cnt FROM gifs");

	$total_items_count = $dbHelper->getResultAsArray()[0]['cnt'];
	$pages_count = ceil($total_items_count / $page_items_count);
	$offset = ($cur_page - 1) * $page_items_count;

	$sql = 'SELECT gifs.id, title, path, like_count, users.name FROM gifs '
		 . 'JOIN users ON gifs.user_id = users.id '
		 . 'ORDER BY show_count DESC LIMIT ? OFFSET ?';

	$dbHelper->executeQuery($sql, [$page_items_count, $offset]);

	if (!$dbHelper->getLastError()) {
		$gifs = $dbHelper->getResultAsArray();

		$tpl_data = [
			'gifs' => $gifs,
			'pages' => range(1, $pages_count),
			'pages_count' => $pages_count,
			'cur_page' => $cur_page
		];

		$content = include_template('main.php', $tpl_data);
	}
	else {
		show_error($content, $dbHelper->getLastError());
	}
}

print include_template('index.php', ['content' => $content, 'categories' => $categories]);