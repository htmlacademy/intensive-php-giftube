<?php
/* BEGIN STATE 01 */
header("X-Academy: keks");
/* END STATE 01 */
/* BEGIN STATE 02 */
$response_headers = headers_list();
print_r($response_headers);
/* END STATE 02 */

/* BEGIN STATE 03 */
sleep(3);
header("Location: /search.php");
/* END STATE 03 */