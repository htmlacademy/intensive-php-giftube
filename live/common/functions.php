<?php

/**
 * Создает подготовленное выражение на основе готового SQL запроса и переданных данных
 *
 * @param $link mysqli Ресурс соединения
 * @param $sql string SQL запрос с плейсхолдерами вместо значений
 * @param array $data Данные для вставки на место плейсхолдеров
 *
 * @return mysqli_stmt Подготовленное выражение
 */
function db_get_prepare_stmt($link, $sql, $data = []) {
    $stmt = mysqli_prepare($link, $sql);

    if ($data) {
        $types = '';
        $stmt_data = [];

        foreach ($data as $value) {
            $type = null;

            if (is_int($value)) {
                $type = 'i';
            }
            else if (is_string($value)) {
                $type = 's';
            }
            else if (is_double($value)) {
                $type = 'd';
            }

            if ($type) {
                $types .= $type;
                $stmt_data[] = $value;
            }
        }

        $values = array_merge([$stmt, $types], $stmt_data);

        $func = 'mysqli_stmt_bind_param';
        $func(...$values);
    }

    return $stmt;
}

/**
 * Функция для показа ошибки
 * @param $content string Результатирущий html
 * @param $error string Текст ошибки
 * @return void
 */
function show_error(&$content, $error) {
    $content = include_template('error.php', ['error' => $error]);
}

/**
 * Подключение шаблона
 * @param $name string Имя шаблона
 * @param $data array Массив с данными для шаблона
 * @return false|string
 */
function include_template($name, $data) {
    $name = 'templates/' . $name;
    $result = '';

    if (!file_exists($name)) {
        return $result;
    }

    ob_start();
    extract($data);
    require $name;

    $result = ob_get_clean();

    return $result;
}

/**
 * Валидатор, проверяющий что такая категория существует
 * @param $id integer id категории
 * @param $allowed_list array массив из допустимых категорий
 * @return string|null
 */
function validateCategory($id, $allowed_list) {
    if (!in_array($id, $allowed_list)) {
        return "Указана несуществующая категория";
    }

    return null;
}

/**
 * Валидатор, проверяющий что длина строки находится в ограниченных пределах
 * @param $value string строка, которую проверяем
 * @param $min integer мин. длина
 * @param $max integer макс. длина
 * @return string|null
 */
function validateLength($value, $min, $max) {
    if ($value) {
        $len = strlen($value);
        if ($len < $min or $len > $max) {
            return "Значение должно быть от $min до $max символов";
        }
    }

    return null;
}

function getPostVal($name) {
    return filter_input(INPUT_POST, $name);
}