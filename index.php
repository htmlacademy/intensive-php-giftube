<?php
ini_set('display_errors', 0);
require_once 'functions.php';

$link = mysqli_connect("localhost", "root", "", "giftube");
$content = '';

if (!$link) {
    $error = mysqli_connect_error();
    $content = include_template('error.php', ['error' => $error]);
}
else {

}

print include_template('index.php', ['content' => $content]);