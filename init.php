<?php
ini_set('display_errors', 0);
require_once 'functions.php';
require_once 'classes/BaseForm.php';
require_once 'classes/SignupForm.php';

//$link = mysqli_connect("localhost", "giftube_edu", "cerMLxxY", "gifube_edu");
$link = mysqli_connect("localhost", "root", "", "giftube");

$categories = [];
$content = '';