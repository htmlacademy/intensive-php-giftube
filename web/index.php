<?php
use GifTube\helpers\AppRegistry;
use GifTube\services\DatabaseConnect;
use GifTube\services\ModelFactory;
use GifTube\services\Router;
use League\Plates\Engine;

require_once '../vendor/autoload.php';

define('APP_PATH', __DIR__ . '/..');
define('UPLOAD_PATH', APP_PATH . '/web/uploads');

session_start();

$routes   = include '../config/routes.php';
$database = include '../config/database.php';
$app      = include '../config/app.php';

$template_engine = new Engine(APP_PATH . '/resources/views');
$databaseConnect = DatabaseConnect::getInstance($database);

$modelFactory = ModelFactory::getInstance($databaseConnect);
AppRegistry::$config = $app;

$router = new Router($routes);
$content = $router->dispatch($template_engine, $modelFactory);

print $content;