<?php
namespace GifTube;

use GifTube\controllers\MainController;

class Router {

    protected $defaultController;
    protected $routes = [];

    public function __construct($routes, $default_controller = MainController::class) {
        $this->routes = $routes;
        $this->defaultController = $default_controller;
    }

    public function dispatch($templateEngine) {
        $uri = $_SERVER['REQUEST_URI'];

        if ($uri !== "/" && $controller = $this->matchController($uri)) {
            list($class, $action) = $controller;

            $ctrl = new $class($templateEngine);
            $ctrl->beforeAction();

            return $ctrl->$action();
        }
        else {
            $controller = new $this->defaultController($templateEngine);
            $controller->beforeAction();

            return $controller->actionIndex();
        }
    }

    protected function matchController($uri) {
        $result = null;
        $uri = substr($uri, 1);

        foreach ($this->routes as $route => $controller) {
            $regexp = '/' . $route . '/';

            if (preg_match($regexp, $uri) != false) {
                $result = $controller;
                break;
            }
        }

        return $result;
    }
}