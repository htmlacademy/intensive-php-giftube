<?php

function getExampleFiles($path)
{
    $result = [];

    $objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));

    foreach ($objects as $name => $object) {
        $basename = basename($name);

        if ($basename !== '.' && $basename !== '..') {
            $filepath = str_replace($path . DIRECTORY_SEPARATOR, '', $name);
            $result[] = $filepath;
        }
    }

    return $result;
}

function getStatesContent($file_path, $cur_state = 0)
{
    $states = [];

    $lines = file($file_path);

    $start_pattern = 'BEGIN STATE';
    $end_pattern = 'END STATE';
    $line_num = 1;

    foreach ($lines as $num => $line) {
        if (stripos($line, $start_pattern)) {
            $cur_state++;
        }
        else if (stripos($line, $end_pattern)) {
            $cur_state--;
        }
        else {
            $states[$cur_state][$line_num] = trim($line, "\n");
            $line_num++;
        }
    }

    return $states;
}

function getExampleData($number, $base_path)
{
    $result = [];
    $states_path = $base_path . DIRECTORY_SEPARATOR . 'state_' . $number;

    if (file_exists($states_path)) {
        $files = getExampleFiles($states_path);

        foreach ($files as $file) {
            $result[] = [
                'filename' => $file,
                'states' => getStatesContent($states_path . DIRECTORY_SEPARATOR . $file)
            ];
        }
    }

    return $result;
}

function getExamplesList(array $desc, $path)
{
    $result = [];

    foreach ($desc['examples'] as $key => $item) {
        $num = $key + 1;
        $item['data'] = getExampleData($num, $path);
        $result[] = $item;
    }

    return $result;
}



$state_path = realpath(__DIR__ . '/../examples');
$app_dir = realpath(__DIR__ . '../');

$datasource_path = $state_path . DIRECTORY_SEPARATOR . 'info.json';
$description = json_decode(file_get_contents($datasource_path), true);

var_dump(getExamplesList($description, $state_path));