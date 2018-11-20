<?php
require_once('functions.php');
/* BEGIN STATE 01 */
function esc($str) {
	$text = htmlspecialchars($str);
	//$text = strip_tags($str);

	return $text;
}
/* END STATE 01 */

/* BEGIN STATE 02 */
$comments = require('post.php');
/* END STATE 02 */
/* BEGIN STATE 03 */
$page_content = include_template('view.php', ['comments' => $comments]);
$layout_content = include_template('layout.php', [
	'content' => $page_content,
	'categories' => [], 'title' => 'GifTube - Просмотр гифки'
]);
print($layout_content);
/* END STATE 03 */
