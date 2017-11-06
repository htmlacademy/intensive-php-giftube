<?php
require_once 'functions.php';
$db = require_once 'config/db.php';

$link = mysqli_connect($db['host'], $db['user'], $db['password'], $db['database']);

$categories = [];
$content = '';