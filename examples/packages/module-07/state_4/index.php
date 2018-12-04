<?php
require_once('functions.php');
require_once('captcha.php');
session_start();

$comments = [];
$message = '';
$errors = [];

/* BEGIN STATE 01 */
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    /* BEGIN STATE 02 */
    $user_code = $_POST['captcha'] ?? null;
    /* END STATE 02 */

    /* BEGIN STATE 03 */
    if (isset($_SESSION['code']) && $_SESSION['code'] == $user_code) {
        /* BEGIN STATE 04 */
       $comments[] = $_POST['message'] ?? "";
       /* END STATE 04 */
    }
    /* END STATE 03 */
    /* BEGIN STATE 05 */
    else {
        $errors['captcha'] = "Неверный код капчи";
    }
    /* END STATE 05 */
}
/* END STATE 01 */

/* BEGIN STATE 06 */
$page_content = include_template('view.php', [
    'comments' => $comments, 'msg' => $message, 'errors' => $errors
]);
$layout_content = include_template('layout.php', [
	'content' => $page_content, 'categories' => [], 'title' => 'GifTube',
]);
/* END STATE 06 */

/* BEGIN STATE 07 */
print($layout_content);
/* END STATE 07 */
