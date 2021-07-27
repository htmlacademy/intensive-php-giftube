<?php
function include_template($name, $data) {
    $name = 'templates/' . $name;

    ob_start();
    extract($data);
    require $name;

    return ob_get_clean();
}
