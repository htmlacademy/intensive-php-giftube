<?php
require_once('functions.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$gif = $_POST;

	$required = ['title', 'description'];
	$dict = ['title' => 'Название', 'description' => 'Описание'];
	$errors = [];

	foreach ($_POST as $key => $value) {
		if (in_array($key, $required)) {
			if (!$value) {
				$errors[$dict[$key]] = 'Это поле надо заполнить';
			}
		}
	}

	if (isset($_FILES['gif_img']['name'])) {
		$tmp_name = $_FILES['gif_img']['tmp_name'];
		$path = $_FILES['gif_img']['name'];

		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$file_type = finfo_file($finfo, $tmp_name);

		if ($file_type !== "image/gif") {
			$errors['Файл'] = 'Загрузите картинку в формате GIF';
		}
		else {
			move_uploaded_file($tmp_name, 'uploads/' . $path);
			$gif['path'] = $path;

		}
	}
	else {
		$errors['Файл'] = 'Вы не загрузили файл';
	}

	if (count($errors)) {
		$page_content = include_template('add.php', ['gif' => $gif, 'errors' => $errors]);
	}
	else {
		$page_content = include_template('view.php', ['gif' => $gif]);
	}
}
else {
	$page_content = include_template('add.php', []);
}

$layout_content = include_template('layout.php', [
	'content'    => $page_content,
	'categories' => [],
	'title'      => 'GifTube - Добавление гифки'
]);

print($layout_content);