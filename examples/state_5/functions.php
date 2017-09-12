<?php

function show_error(&$content, $error) {
    $content = include_template('error.php', ['error' => $error]);
}

function include_template($name, $data) {
    $name = 'templates/' . $name;
    $result = '';

    if (!file_exists($name)) {
        return $result;
    }

    ob_start();
    extract($data);
    require_once $name;

    $result = ob_get_clean();

    return $result;
}

function register_user($link, $user_data) {
    list($email, $password, $name, $avatar) = array_values($user_data);
    $password = password_hash($password, PASSWORD_DEFAULT);

    $sql = 'INSERT INTO users (dt_add, email, name, password, avatar_path) VALUES (NOW(), ?, ?, ?, ?)';

    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, 'ssss', $email, $name, $password, $avatar);

    $res = mysqli_stmt_execute($stmt);

    return $res;
}