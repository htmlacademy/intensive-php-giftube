<?php
require_once 'functions.php';

$content = '';
$categories = [];

$link = mysqli_connect("localhost", "root", "", "giftube");

if (!$link) {
    $error = mysqli_connect_error();
    show_error($content, $error);
}
else {
    $sql = 'SELECT `id`, `name` FROM categories';
    $result = mysqli_query($link, $sql);

    if ($result) {
        $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    else {
        $error = mysqli_error($link);
        show_error($content, $error);
    }

    $content = include_template('add.php', ['categories' => $categories]);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $gif = $_POST['gif'];

        $filename = uniqid() . '.gif';
        $gif['path'] = $filename;
        move_uploaded_file($_FILES['gif_img']['tmp_name'], 'uploads/' . $filename);

        $sql = 'INSERT INTO gifs (dt_add, category_id, user_id, title, description, path) VALUES (NOW(), ?, 1, ?, ?, ?)';
        $stmt = mysqli_prepare($link, $sql);

        mysqli_stmt_bind_param($stmt, 'isss', $gif['category'], $gif['title'], $gif['description'], $gif['path']);
        $res = mysqli_stmt_execute($stmt);
        
        if ($res) {
            $gif_id = mysqli_insert_id($link);

            header("Location: gif.php?id=" . $gif_id);
        }
        else {
            $content = include_template('error.php', ['error' => mysqli_error($link)]);
        }
    }
}

print include_template('index.php', ['content' => $content, 'categories' => $categories]);