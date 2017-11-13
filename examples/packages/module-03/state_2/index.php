<?php
/* BEGIN STATE 01 */
require_once('functions.php');
require_once('data.php');
/* END STATE 01 */

/* BEGIN STATE 02 */
$page_content = include_template('main.php', ['gifs' => $gifs]);
/* END STATE 02 */
/* BEGIN STATE 03 */
$layout_content = include_template('layout.php', [
	'content' => $page_content,
	'categories' => $categories,
	'title' => 'GifTube - Главная страница'
]);
/* END STATE 03 */

/* BEGIN STATE 04 */
print($layout_content);
/* END STATE 04 */