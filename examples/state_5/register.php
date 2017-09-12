<?php
require_once 'functions.php';

$content = '';
$categories = [];


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

    /* BEGIN STATE 01 */
    $form = new SignupForm();

    // проверяем, что форма была отправлена
    if ($form->isSubmitted()) {
        // валидация формы
        $form->validate();

        if ($form->isValid()) { // форма заполнена корректно
           // регистрация пользователя
           $res = register_user($link, $form->getFormData());

            if ($res) {
                header("Location: /");
            }
            else {
                $error = mysqli_error($link);
                show_error($content, $error);
            }
        }
    }

    $content = include_template('register.php', ['form' => $form]);
}

print include_template('index.php', ['content' => $content, 'categories' => $categories]);