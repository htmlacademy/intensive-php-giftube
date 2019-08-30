<?php
require_once('init.php');
require_once('functions.php');

/* BEGIN STATE 01 */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	/* BEGIN STATE 02 */
	$form = $_POST;

	$required = ['email', 'password'];
	$errors = [];
	/* END STATE 02 */
	/* BEGIN STATE 03 */
	foreach ($required as $field) {
	    if (empty($form[$field])) {
	        $errors[$field] = 'Это поле надо заполнить';
        }
    }
	/* END STATE 03 */

	/* BEGIN STATE 04 */
	$email = mysqli_real_escape_string($link, $form['email']);
	$sql = "SELECT * FROM users WHERE email = '$email'";
	$res = mysqli_query($link, $sql);

	$user = $res ? mysqli_fetch_array($res, MYSQLI_ASSOC) : null;

	if (!count($errors) and $user) {
		/* BEGIN STATE 05 */
		if (password_verify($form['password'], $user['password'])) {
			$_SESSION['user'] = $user;
		}
		/* END STATE 05 */
		/* BEGIN STATE 06 */
		else {
			$errors['password'] = 'Неверный пароль';
		}
		/* END STATE 06 */
	}
	/* END STATE 04 */
	/* BEGIN STATE 07 */
	else {
		$errors['email'] = 'Такой пользователь не найден';
	}
	/* END STATE 07 */

	/* BEGIN STATE 08 */
	if (count($errors)) {
		$page_content = include_template('enter.php', ['form' => $form, 'errors' => $errors]);
	}
	/* END STATE 08 */
	/* BEGIN STATE 09 */
	else {
		header("Location: /index.php");
		exit();
	}
	/* END STATE 09 */
}
/* END STATE 01 */
/* BEGIN STATE 10 */
else {
    $page_content = include_template('enter.php', []);

    if (isset($_SESSION['user'])) {
        header("Location: /index.php");
        exit();
    }
}
/* END STATE 10 */

/* BEGIN STATE 11 */
$layout_content = include_template('layout.php', [
	'content'    => $page_content,
	'categories' => [],
	'title'      => 'GifTube'
]);

print($layout_content);
/* END STATE 11 */
