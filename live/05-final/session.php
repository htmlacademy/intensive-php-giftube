<?php
session_start();
$visit_count = 1;

if (isset($_SESSION["visit_count"])) {
	$visit_count = $_SESSION["visit_count"] + 1;
}

$_SESSION["visit_count"] = $visit_count;
print("<h1>$visit_count</h1>");
