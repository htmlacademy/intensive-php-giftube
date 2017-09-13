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
    $seq = [0];

    $lines = file($file_path);

    $start_pattern = '/BEGIN STATE (\d+)/';
    $end_pattern = 'END STATE';
    $line_num = 1;

    foreach ($lines as $num => $line) {
        if (preg_match($start_pattern, $line, $matches)) {
            $num = (int) $matches[1];
            $seq[] = $num;
        }
        else if (stripos($line, $end_pattern)) {
            array_pop($seq);
        }
        else {
            $cur_state = end($seq);

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

function loadExample($number, $base_path, $app_path)
{
    $path = $base_path . DIRECTORY_SEPARATOR . 'state_' . $number;
    $files = getExampleFiles($path);

    foreach ($files as $file) {
        updateState($number, $file, $base_path, $app_path);
    }
}

function updateState($example_number, $file, $base_path, $app_path, $state_number = null)
{
    $result = [];

    $filepath = $base_path . DIRECTORY_SEPARATOR . 'state_' . $example_number . DIRECTORY_SEPARATOR . $file;
    $states_content = getStatesContent($filepath);

    foreach ($states_content as $number => $lines) {
        if ($state_number && $number > $state_number) {
            break;
        }

        $result = array_replace($result, $lines);
    }

    ksort($result);
    $content = implode("\n", $result);

    file_put_contents($app_path . DIRECTORY_SEPARATOR . $file, $content);

    return $content;
}

function updateContent($file, $content, $app_path)
{
    $filepath = $app_path . DIRECTORY_SEPARATOR . $file;

    if (file_exists($filepath)) {
        file_put_contents($filepath, $content);
    }
}

function getArg($name, $default = null)
{
    return $_REQUEST[$name] ?? $default;
}

$state_path = realpath(__DIR__ . '/../examples');
$app_dir = realpath(__DIR__ . '/../');

$datasource_path = $state_path . DIRECTORY_SEPARATOR . 'info.json';
$description = json_decode(file_get_contents($datasource_path), true);

$response = [];

switch (getArg('action')) {
    case "getData":
        $response = getExamplesList($description, $state_path);
        break;
    case "loadExample":
        loadExample(getArg('example'), $state_path, $app_dir);
        break;
    case "updateState":
        updateState(getArg('example'), getArg('file'), $state_path, $app_dir, getArg('state'));
        break;
    case "updateContent":
        updateContent(getArg('file'), getArg('body'), $app_dir);
        break;
}

header("Content-Type: application/json; charset=utf-8");
print json_encode($response, JSON_UNESCAPED_UNICODE);