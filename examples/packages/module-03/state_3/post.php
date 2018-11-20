<?php
$comments = [];

if (isset($_POST['message'])) {
    $comments = [$_POST['message']];
}

return $comments;
