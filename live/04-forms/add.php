<?php
require_once '../common/init.php';

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
        $gif = $_POST;
        $filename = uniqid() . '.gif';
        $gif['path'] = $filename;
        move_uploaded_file($_FILES['gif_img']['tmp_name'], 'uploads/' . $filename);

        $sql = 'INSERT INTO gifs (dt_add, category_id, user_id, title, description, path) VALUES (NOW(), ?, 1, ?, ?, ?)';

        $stmt = db_get_prepare_stmt($link, $sql, $gif);
        $res = mysqli_stmt_execute($stmt);

        if ($res) {
            $gif_id = mysqli_insert_id($link);

            header("Location: view.php?id=" . $gif_id);
        }
        else {
            $content = include_template('error.php', ['error' => mysqli_error($link)]);
        }
    }
}

print include_template('layout.php', ['content' => $content, 'categories' => $categories]);
