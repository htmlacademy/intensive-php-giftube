<?php
require_once('functions.php');

/* BEGIN STATE 01 */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$gif = $_POST;

	/* BEGIN STATE 02 */
	if (isset($_FILES['gif_img']['name'])) {
		$path = $_FILES['gif_img']['name'];
		/* BEGIN STATE 03 */
		$res = move_uploaded_file($_FILES['gif_img']['tmp_name'], 'uploads/' . $path);
		/* END STATE 03 */
	}
	/* END STATE 02 */

	/* BEGIN STATE 04 */
	if (isset($path)) {
		$gif['path'] = $path;
	}
	/* END STATE 04 */

	/* BEGIN STATE 05 */
	$page_content = include_template('view.php', ['gif' => $gif]);
	/* END STATE 05 */
}
/* END STATE 01 */
/* BEGIN STATE 06 */
else {
	$page_content = include_template('add.php', []);
}
/* END STATE 06 */

/* BEGIN STATE 07 */
$layout_content = include_template('layout.php', [
	'content'    => $page_content,
	'categories' => [],
	'title'      => 'GifTube - Добавление гифки'
]);

print($layout_content);
/* END STATE 07 */