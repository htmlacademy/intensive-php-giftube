<?php
require_once('captcha.php');
session_start();

/* BEGIN STATE 01 */
$text = generate_random_string();
/* END STATE 01 */
/* BEGIN STATE 02 */
$_SESSION['code'] = $text;
/* END STATE 02 */

/* BEGIN STATE 03 */
generate_captcha($text);
/* END STATE 03 */
