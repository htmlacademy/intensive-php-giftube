<?php
session_start();
$_SESSION['user_id'] = 3;

define('CACHE_DIR', basename(__DIR__ . DIRECTORY_SEPARATOR . 'cache'));

$db_cfg = require_once 'config/db.php';
$db_cfg = array_values($db_cfg);
require_once 'functions.php';

$link = mysqli_connect(...$db_cfg);

$categories = [];
$content = '';