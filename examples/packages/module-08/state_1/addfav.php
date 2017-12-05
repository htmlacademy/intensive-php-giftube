<?php
require_once 'init.php';

$gif_id = intval($_GET['id']) ?? null;

if ($gif_id) {
    /* BEGIN STATE 01 */
    mysqli_query($link, "START TRANSACTION");
    /* END STATE 01 */
    /* BEGIN STATE 02 */
    $r1 = mysqli_query($link, "UPDATE gifs SET fav_count = fav_count + 1 WHERE id = " . $gif_id);
    $r2 = mysqli_query($link, "INSERT INTO gifs_fav (gif_id, user_id) VALUES ($gif_id, {$_SESSION['user_id']})");
    /* END STATE 02 */

    /* BEGIN STATE 03 */
    if ($r1 && $r2) {
        mysqli_query($link, "COMMIT");
    }
    /* END STATE 03 */
    /* BEGIN STATE 04 */
    else {
        mysqli_query($link, "ROLLBACK");
    }
    /* END STATE 04 */

    /* BEGIN STATE 05 */
    header("Location: /gif.php?id=" . $gif_id);
    exit;
    /* END STATE 05 */
}