<?php
require_once 'functions.php';
$db = require_once 'db.php';

$link = mysqli_connect($db['host'], $db['user'], $db['password'], $db['database']);
mysqli_set_charset($link, "utf8");

$categories = [];
$content = '';