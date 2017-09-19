<?php
session_start();
$_SESSION['user_id'] = 3;
define('CACHE_DIR', basename(__DIR__ . DIRECTORY_SEPARATOR . 'cache'));

require_once 'functions.php';

//$link = mysqli_connect("localhost", "giftube_edu", "cerMLxxY", "gifube_edu");
$link = mysqli_connect("localhost", "root", "", "giftube");

$categories = [];
$content = '';