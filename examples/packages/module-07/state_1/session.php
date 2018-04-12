<?php
/* BEGIN STATE 01 */
session_start();
$visit_count = 1;
/* END STATE 01 */

/* BEGIN STATE 02 */
if (isset($_SESSION["visit_count"])) {
	$visit_count = $_SESSION["visit_count"] + 1;
}
/* END STATE 02 */

/* BEGIN STATE 03 */
$_SESSION["visit_count"] = $visit_count;
print("<h1>$visit_count</h1>");
/* END STATE 03 */
