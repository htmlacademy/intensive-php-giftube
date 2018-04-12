<?php
session_start();

/* BEGIN STATE 01 */
if (isset($_GET['code'])) {
	$code = $_GET['code'];

	/* BEGIN STATE 02 */
	if (isset($_SESSION['pass'])) {
		$pass_code = $_SESSION['pass'];

		/* BEGIN STATE 03 */
		if ($code == $pass_code[1]) {
			/* BEGIN STATE 04 */
			$new_password = substr(uniqid(), 0, 6);
			$hash = password_hash($new_password, PASSWORD_DEFAULT);
			/* END STATE 04 */
			/* BEGIN STATE 05 */
			$message = "Ваш новый пароль: " . $new_password;
			mail($pass_code[0], "Новый пароль", $message);
			// Здесь нужно сохранить новый пароль для пользователя

			print("<h1>Новый пароль был отправлен вам на email</h1>");
			/* END STATE 05 */
		}
		/* END STATE 03 */
		/* BEGIN STATE 06 */
		else {
			print("<h1>Код восстановления не совпадает</h1>");
		}
		/* END STATE 06 */
	}
	/* END STATE 02 */
}
/* END STATE 01 */