<?php
require_once('functions.php');
require_once('data.php');

/* BEGIN STATE 01 */
session_start();
$success_send = false;
/* END STATE 01 */

/* BEGIN STATE 02 */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$email = $_POST['email'];

	/* BEGIN STATE 03 */
	if (searchUserByEmail($email, $users)) {
		/* BEGIN STATE 04 */
		$code = uniqid();
		$url = "http://" . $_SERVER['HTTP_HOST'] . "/forgot.php?code=" . $code;
		$message = "Ссылка на восстановление пароля: " . $url;
		/* END STATE 04 */

		/* BEGIN STATE 05 */
		$_SESSION['pass'] = [$email, $code];
		mail($email, "Восстановление пароля", $url);
		/* END STATE 06 */

		/* BEGIN STATE 07 */
		$success_send = true;
		/* END STATE 07 */
	}
	/* END STATE 03 */
}
/* END STATE 02 */
/* BEGIN STATE 08 */
$page_content = include_template('send.php', ['success' => $success_send]);
/* END STATE 08 */
/* BEGIN STATE 09 */
$layout_content = include_template('layout.php', [
	'content'    => $page_content,
	'categories' => [],
	'title'      => 'GifTube - Восстановление пароля'
]);

print($layout_content);
/* END STATE 09 */

function searchUserByEmail($email, $users) {
	$result = null;
	foreach ($users as $user) {
		if ($user['email'] == $email) {
			$result = $user;
			break;
		}
	}

	return $result;
}