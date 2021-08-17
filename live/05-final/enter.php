<?php
require_once '../common/init.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$form = $_POST;

	$required = ['email', 'password'];
	$errors = [];

	foreach ($required as $field) {
	    if (empty($form[$field])) {
	        $errors[$field] = 'Это поле надо заполнить';
        }
    }

	$email = mysqli_real_escape_string($link, $form['email']);
	$sql = "SELECT * FROM users WHERE email = '$email'";
	$res = mysqli_query($link, $sql);

	$user = $res ? mysqli_fetch_array($res, MYSQLI_ASSOC) : null;

	if (!count($errors) and $user) {
		if (password_verify($form['password'], $user['password'])) {
			$_SESSION['user'] = $user;
		}
		else {
			$errors['password'] = 'Неверный пароль';
		}
	}
	else {
		$errors['email'] = 'Такой пользователь не найден';
	}

	if (count($errors)) {
		$page_content = include_template('enter.php', ['form' => $form, 'errors' => $errors]);
	}
	else {
		header("Location: /index.php");
		exit();
	}
}
else {
    $page_content = include_template('enter.php', []);

    if (isset($_SESSION['user'])) {
        header("Location: /index.php");
        exit();
    }
}

$layout_content = include_template('layout.php', [
	'content'    => $page_content,
	'categories' => [],
	'title'      => 'GifTube'
]);

print($layout_content);
