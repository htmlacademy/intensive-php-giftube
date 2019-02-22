<?php
require_once('init.php');
require_once('functions.php');

$tpl_data = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $form = $_POST['signup'];
    $errors = [];

    $req_fields = ['email', 'password', 'name'];

    foreach ($req_fields as $field) {
        if (empty($form[$field])) {
            $errors[] = "Не заполнено поле " . $field;
        }
    }

    if (empty($errors)) {
        /* BEGIN STATE 01 */
        $email = mysqli_real_escape_string($link, $form['email']);
        $sql = "SELECT id FROM users WHERE email = '$email'";
        $res = mysqli_query($link, $sql);
        /* END STATE 01 */

        /* BEGIN STATE 02 */
        if (mysqli_num_rows($res) > 0) {
            $errors[] = 'Пользователь с этим email уже зарегистрирован';
        }
        /* END STATE 02 */
        /* BEGIN STATE 03 */
        else {
            $password = password_hash($form['password'], PASSWORD_DEFAULT);

            $sql = 'INSERT INTO users (dt_add, email, name, password) VALUES (NOW(), ?, ?, ?)';
            $stmt = db_get_prepare_stmt($link, $sql, [$form['email'], $form['name'], $password]);
            $res = mysqli_stmt_execute($stmt);
        }
        /* END STATE 03 */

        /* BEGIN STATE 04 */
        if ($res && empty($errors)) {
            header("Location: /enter.php");
            exit();
        }
        /* END STATE 04 */
    }

    /* BEGIN STATE 05 */
    $tpl_data['errors'] = $errors;
    $tpl_data['values'] = $form;
    /* END STATE 05 */
}

$page_content = include_template('reg.php', $tpl_data);

$layout_content = include_template('layout.php', [
    'content'    => $page_content,
    'categories' => [],
    'title'      => 'GifTube | Регистрация'
]);

print($layout_content);
