<?php
require_once '../common/init.php';

$sql = 'SELECT `id`, `name` FROM categories';
$result = mysqli_query($link, $sql);

$cats_ids = [];

if ($result) {
    $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $cats_ids = array_column($categories, 'id');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$required = ['title', 'category_id'];
	$errors = [];

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
    $gif = filter_input_array(INPUT_POST, ['title' => FILTER_DEFAULT, 'description' => FILTER_DEFAULT,
        'category_id' => FILTER_DEFAULT], true);

    foreach ($gif as $key => $value) {
        if (isset($rules[$key])) {
            $rule = $rules[$key];
            $errors[$key] = $rule($value);
        }

        if (in_array($key, $required) && empty($value)) {
            $errors[$key] = "Поле $key надо заполнить";
        }
    }

    $errors = array_filter($errors);

	if (!empty($_FILES['gif_img']['name'])) {
		$tmp_name = $_FILES['gif_img']['tmp_name'];
		$path = $_FILES['gif_img']['name'];
        $filename = uniqid() . '.gif';

		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$file_type = finfo_file($finfo, $tmp_name);
		if ($file_type !== "image/gif") {
			$errors['file'] = 'Загрузите картинку в формате GIF';
		}
		else {
			move_uploaded_file($tmp_name, 'uploads/' . $filename);
			$gif['path'] = $filename;
		}
	}
	else {
		$errors['file'] = 'Вы не загрузили файл';
	}

	if (count($errors)) {
		$page_content = include_template('add2.php', ['gif' => $gif, 'errors' => $errors, 'categories' => $categories]);
	}
	else {
        $sql = 'INSERT INTO gifs (dt_add, user_id, title, description, category_id, path) VALUES (NOW(), 1, ?, ?, ?, ?)';
        $stmt = db_get_prepare_stmt($link, $sql, $gif);
        $res = mysqli_stmt_execute($stmt);

        if ($res) {
            $gif_id = mysqli_insert_id($link);

            header("Location: view.php?id=" . $gif_id);
        }
	}
}
else {
	$page_content = include_template('add2.php', ['categories' => $categories]);
}

$layout_content = include_template('layout.php', [
	'content'    => $page_content,
	'categories' => [],
	'title'      => 'GifTube - Добавление гифки'
]);

print($layout_content);
