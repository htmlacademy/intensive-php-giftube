<!doctype html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<style>
		body {
			font-size: 22px;
		}
	</style>
</head>
<body>
<?php
/* BEGIN STATE 01 */
$headers_keys = [
	'Язык браузера' => 'ACCEPT_LANGUAGE',
	'Страница перехода' => 'REFERER',
	'Поддерживаемый контент' => 'ACCEPT',
	'Браузер и ОС пользователя' => 'USER_AGENT',
	'Домен сайта' => 'HOST'
];
/* END STATE 01 */

/* BEGIN STATE 02 */
foreach ($headers_keys as $name => $key) {
	$server_key = 'HTTP_' . $key;

	/* BEGIN STATE 03 */
	if (isset($_SERVER[$server_key])) {
		$value = $_SERVER[$server_key];
		/* BEGIN STATE 04 */
		print("<b>$name</b>: $value<br>");
		/* END STATE 04 */
	}
	/* END STATE 03 */
}
/* END STATE 02 */
?>
</body>
</html>

