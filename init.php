<?php
session_start();
$_SESSION['user_id'] = 1;

define('CACHE_DIR', basename(__DIR__ . DIRECTORY_SEPARATOR . 'cache'));
define('UPLOAD_PATH', basename(__DIR__ . DIRECTORY_SEPARATOR . 'uploads'));

$db_cfg = require_once 'config/db.php';
$db_cfg = array_values($db_cfg);
require_once 'functions.php';

$link = mysqli_connect(...$db_cfg);
mysqli_set_charset($link, "utf8");

$categories = [];
$content = '';