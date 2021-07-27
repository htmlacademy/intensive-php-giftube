<?php
require_once('functions.php');
require_once('data.php');

$page_content = include_template('main.php', ['gifs' => $gif_list]);

$layout_content = include_template('layout.php', [
	'content' => $page_content,
	'categories' => $categories,
	'title' => 'GifTube - Главная страница'
]);

print($layout_content);
