<?php
require_once 'init.php';
require_once 'functions.php';

$gif_id = intval($_GET['id']) ?? null;

if ($gif_id) {
    mysqli_query($link, "START TRANSACTION");

    $r1 = mysqli_query($link, "UPDATE gifs SET fav_count = fav_count + 1 WHERE id = " . $gif_id);
    $r2 = mysqli_query($link, "INSERT INTO gifs_fav (gif_id, user_id) VALUES ($gif_id, {$_SESSION['user_id']})");

    if ($r1 && $r2) {
        mysqli_query($link, "COMMIT");
        cache_del_data([$_SESSION['user_id']], 'user_fav');

    }
    else {
        mysqli_query($link, "ROLLBACK");
    }

    header("Location: /gif.php?id=" . $gif_id);
    exit;
}