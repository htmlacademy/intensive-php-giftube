<?php
require_once('functions.php');
require_once('data.php');
require_once('func.php');

session_start();

/* BEGIN STATE 01 */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	/* BEGIN STATE 02 */
	$form = $_POST;

	$required = ['email', 'password'];
	$dict = ['email' => 'Email', 'password' => 'Пароль'];
	$errors = [];
	/* END STATE 02 */
	/* BEGIN STATE 03 */
	foreach ($_POST as $key => $value) {
		if (in_array($key, $required)) {
			if (!$value) {
				$errors[$dict[$key]] = 'Это поле надо заполнить';
			}
		}
	}
	/* END STATE 03 */

	/* BEGIN STATE 04 */
	if ($user = searchUserByEmail($form['email'], $users)) {
		/* BEGIN STATE 05 */
		if (password_verify($form['password'], $user['password'])) {
			$_SESSION['user'] = $user;
		}
		/* END STATE 05 */
		/* BEGIN STATE 06 */
		else {
			$errors[$dict['password']] = 'Неверный пароль';
		}
		/* END STATE 06 */
	}
	/* END STATE 04 */
	/* BEGIN STATE 07 */
	else {
		$errors[$dict['email']] = 'Такой пользователь не найден';
	}
	/* END STATE 07 */

	/* BEGIN STATE 08 */
	if (count($errors)) {
		$page_content = include_template('enter.php', ['form' => $form, 'errors' => $errors]);
	}
	/* END STATE 08 */
	/* BEGIN STATE 09 */
	else {
		header("Location: /search.php");
		exit();
	}
	/* END STATE 09 */
}
/* END STATE 01 */
/* BEGIN STATE 10 */
else {
	$page_content = include_template('enter.php', []);
}
/* END STATE 10 */

/* BEGIN STATE 11 */
$layout_content = include_template('layout.php', [
	'content'    => $page_content,
	'categories' => [],
	'title'      => 'GifTube - Вход на сайт'
]);

print($layout_content);
/* END STATE 11 */