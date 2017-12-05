<?php

/* BEGIN STATE 01 */
function cache_get_key($sql, $params, $tag) {
	$str = md5(implode($params) . $tag);
	$key = $str . md5($sql);

	return $key;
}
/* END STATE 01 */

/* BEGIN STATE 02 */
function cache_save_data($filepath, $data) {
	$res = false;

	if (!file_exists($filepath)) {
		$res = file_put_contents($filepath, json_encode($data));
	}

	return $res;
}
/* END STATE 02 */

/* BEGIN STATE 03 */
function cache_del_data($data, $tag) {
	$cache_part = md5(implode($data) . $tag);
	$files = scandir(CACHE_DIR);

	foreach ($files as $file) {
		if (substr($file, 0, 32) == $cache_part) {
			unlink(CACHE_DIR . DIRECTORY_SEPARATOR . $file);
		}
	}
}
/* END STATE 03 */

/* BEGIN STATE 04 */
function is_cache_expired($filename, $ttl) {
	$res = false;

	$mod_time = filemtime($filename);

	if ($mod_time + $ttl < time()) {
		unlink($filename);
		$res = true;
	}

	return $res;
}
/* END STATE 04 */

/* BEGIN STATE 05 */
function cache_get_data($link, $sql, $params, $tag, $ttl = 86400) {
	$filename = cache_get_key($sql, $params, $tag) . '.json';
	$filepath = CACHE_DIR . DIRECTORY_SEPARATOR . $filename;

	if (file_exists($filepath) && !is_cache_expired($filepath, $ttl)) {
		$content = file_get_contents($filepath);
		$res_data = json_decode($content, true);
	}
	else {
		$stmt = db_get_prepare_stmt($link, $sql, $params);
		mysqli_stmt_execute($stmt);

		$res  = mysqli_stmt_get_result($stmt);

		$res_data = mysqli_fetch_all($res, MYSQLI_ASSOC);
		cache_save_data($filepath, $res_data);
	}

	return $res_data;
}
/* END STATE 05 */


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
