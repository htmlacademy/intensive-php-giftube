<?php
use GifTube\Router;
use League\Plates\Engine;

require_once '../vendor/autoload.php';

define('APP_PATH', __DIR__ . '/..');

$routes = include '../config/routes.php';

$template_engine = new Engine(APP_PATH . '/resources/views');

$router = new Router($routes);
$content = $router->dispatch($template_engine);

print $content;