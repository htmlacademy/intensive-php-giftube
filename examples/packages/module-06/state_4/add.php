<?php
require_once('functions.php');

/* BEGIN STATE 01 */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	/* BEGIN STATE 02 */
	$gif = $_POST;

	$required = ['title', 'description'];
	$dict = ['title' => 'Название', 'description' => 'Описание', 'file' => 'Гифка'];
	$errors = [];
/* END STATE 02 */
/* BEGIN STATE 03 */
	foreach ($required as $key) {
		if (empty($_POST[$key])) {
            $errors[$key] = 'Это поле надо заполнить';
		}
	}
	/* END STATE 03 */

	/* BEGIN STATE 04 */
	if (isset($_FILES['gif_img']['name'])) {
		$tmp_name = $_FILES['gif_img']['tmp_name'];
		$path = $_FILES['gif_img']['name'];

		/* BEGIN STATE 05 */
		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$file_type = finfo_file($finfo, $tmp_name);
		/* END STATE 05 */
		/* BEGIN STATE 06 */
		if ($file_type !== "image/gif") {
			$errors['file'] = 'Загрузите картинку в формате GIF';
		}
		/* END STATE 06 */
		/* BEGIN STATE 07 */
		else {
			move_uploaded_file($tmp_name, 'uploads/' . $path);
			$gif['path'] = $path;
		}
		/* END STATE 07 */
	}
	/* END STATE 04 */
	/* BEGIN STATE 08 */
	else {
		$errors['file'] = 'Вы не загрузили файл';
	}
	/* END STATE 08 */

	/* BEGIN STATE 09 */
	if (count($errors)) {
		$page_content = include_template('add.php', ['gif' => $gif, 'errors' => $errors, 'dict' => $dict]);
	}
	/* END STATE 09 */
	/* BEGIN STATE 10 */
	else {
		$page_content = include_template('view.php', ['gif' => $gif]);
	}
	/* END STATE 10 */
}
/* END STATE 01 */
/* BEGIN STATE 11 */
else {
	$page_content = include_template('add.php', []);
}
/* END STATE 11 */

/* BEGIN STATE 12 */
$layout_content = include_template('layout.php', [
	'content'    => $page_content,
	'categories' => [],
	'title'      => 'GifTube - Добавление гифки'
]);

print($layout_content);
/* END STATE 12 */