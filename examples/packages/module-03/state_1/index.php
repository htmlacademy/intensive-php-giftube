<?php
/* BEGIN STATE 01 */
require_once('funcs.php');
require_once('config.php');
require_once('data.php');
/* END STATE 01 */

/* BEGIN STATE 02 */
if ($config['enable']) {
	/* BEGIN STATE 03 */
	$content = require_once($config['tpl_path'] . 'main.php');
	/* END STATE 03 */
}
else {
	/* BEGIN STATE 04 */
	$error_msg = "Сайт на техническом обслуживании";
	$content = require_once($config['tpl_path'] . 'off.php');
	/* END STATE 04 */
}
/* END STATE 02 */

/* BEGIN STATE 05 */
print($content);
/* END STATE 05 */