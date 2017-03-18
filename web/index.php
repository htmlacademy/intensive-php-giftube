<?php
use GifTube\DatabaseConnect;
use GifTube\Router;
use League\Plates\Engine;

require_once '../vendor/autoload.php';

define('APP_PATH', __DIR__ . '/..');

$routes = include '../config/routes.php';
$database = include '../config/database.php';

$template_engine = new Engine(APP_PATH . '/resources/views');
$databaseConnect = DatabaseConnect::getInstance($database);

$router = new Router($routes);
$content = $router->dispatch($template_engine);

print $content;