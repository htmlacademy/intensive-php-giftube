<?php
require_once 'init.php';

$sql = 'SELECT `id`, `name` FROM categories';
$result = mysqli_query($link, $sql);

$cats_ids = [];

if ($result) {
    $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $cats_ids = array_column($categories, 'id');
}

/* BEGIN STATE 01 */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
/* BEGIN STATE 02 */
	$required = ['title', 'category_id'];
	$errors = [];
/* END STATE 02 */

/* BEGIN STATE 03 */
    $rules = [
        'category_id' => function($value) use ($cats_ids) {
            return validateCategory($value, $cats_ids);
        },
        'title' => function($value) {
            return validateLength($value, 10, 200);
        },
        'description' => function($value) {
            return validateLength($value, 10, 3000);
        }
    ];
/* END STATE 03 */
/* BEGIN STATE 04 */
    $vals = filter_input_array(INPUT_POST, ['title' => FILTER_DEFAULT, 'description' => FILTER_DEFAULT,
        'category_id' => FILTER_DEFAULT], true);
/* END STATE 04 */

/* BEGIN STATE 05 */
    foreach ($vals as $key => $value) {
        if (isset($rules[$key])) {
            $rule = $rules[$key];
            $errors[$key] = $rule($value);
        }

        if (in_array($key, $required) && empty($value)) {
            $errors[$key] = 'Это поле надо заполнить';
        }
    }

    $errors = array_filter($errors);
/* END STATE 05 */

/* BEGIN STATE 06 */
	if (!empty($_FILES['gif_img']['name'])) {
		$tmp_name = $_FILES['gif_img']['tmp_name'];
		$path = $_FILES['gif_img']['name'];
        $filename = uniqid() . '.gif';

/* BEGIN STATE 07 */
		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$file_type = finfo_file($finfo, $tmp_name);
/* END STATE 07 */
/* BEGIN STATE 08 */
		if ($file_type !== "image/gif") {
			$errors['file'] = 'Загрузите картинку в формате GIF';
		}
/* END STATE 08 */
/* BEGIN STATE 09 */
		else {
			move_uploaded_file($tmp_name, 'uploads/' . $filename);
			$gif['path'] = $filename;
		}
/* END STATE 09 */
	}
/* END STATE 06 */
/* BEGIN STATE 10 */
	else {
		$errors['file'] = 'Вы не загрузили файл';
	}
/* END STATE 10 */

/* BEGIN STATE 11 */
	if (count($errors)) {
		$page_content = include_template('add.php', ['gif' => $vals, 'errors' => $errors, 'categories' => $categories]);
	}
/* END STATE 11 */
/* BEGIN STATE 12 */
	else {
        $sql = 'INSERT INTO gifs (dt_add, category_id, user_id, title, description, path) VALUES (NOW(), ?, 1, ?, ?, ?)';
        $stmt = db_get_prepare_stmt($link, $sql, $gif);
        $res = mysqli_stmt_execute($stmt);

        if ($res) {
            $gif_id = mysqli_insert_id($link);

            header("Location: gif.php?id=" . $gif_id);
        }
	}
/* END STATE 12 */
}
/* END STATE 01 */
/* BEGIN STATE 13 */
else {
	$page_content = include_template('add.php', ['categories' => $categories]);
}
/* END STATE 13 */

/* BEGIN STATE 14 */
$layout_content = include_template('layout.php', [
	'content'    => $page_content,
	'categories' => [],
	'title'      => 'GifTube - Добавление гифки'
]);

print($layout_content);
/* END STATE 14 */
