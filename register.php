<?php
require_once 'init.php';

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

    if (!empty($_POST)) {
        list($email, $password, $name) = array_values($_POST['signup']);
        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql = 'INSERT INTO users (email, name, password) VALUES (?, ?, ?)';

        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, 'sss', $email, $name, $password);

        $res = mysqli_stmt_execute($stmt);

        if ($res) {
            header("Location: /");
        }
        else {
            $error = mysqli_error($link);
            show_error($content, $error);
        }
    }
    else {
        $content = include_template('register.php', []);
    }
}

print include_template('index.php', ['content' => $content, 'categories' => $categories]);