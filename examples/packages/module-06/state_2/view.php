<?php
/* BEGIN STATE 01 */
require_once('functions.php');
require_once('data.php');
/* END STATE 01 */

/* BEGIN STATE 02 */
$gif = null;
/* END STATE 02 */

/* BEGIN STATE 03 */
if (isset($_GET['gif_id'])) {
	$gif_id = $_GET['gif_id'];

	/* BEGIN STATE 04 */
	foreach ($gif_list as $item) {
		if ($item['id'] == $gif_id) {
			$gif = $item;
			break;
		}
	}
	/* END STATE 04 */
}
/* END STATE 03 */

/* BEGIN STATE 05 */
if (!$gif) {
	http_response_code(404);
}
/* END STATE 05 */

/* BEGIN STATE 06 */
$page_content = include_template('view.php', ['gif' => $gif]);
$layout_content = include_template('layout.php', [
	'content' => $page_content,
	'categories' => [],
	'title' => 'GifTube - Просмотр гифки'
]);
print($layout_content);
/* END STATE 06 */