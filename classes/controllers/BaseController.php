<?php
namespace GifTube\controllers;

use GifTube\services\DatabaseConnect;
use GifTube\models\CategoryModel;
use GifTube\services\ModelFactory;
use League\Plates\Engine;

class BaseController {

    /**
     * @var Engine
     */
    protected $templateEngine;

    /**
     * @var ModelFactory
     */
    protected $modelFactory;

    protected $user;

    protected $rules = [
        'guest' => ["/gif/add", "/logout"],
        'user'  => ["/signin", "/signup"]
    ];

    public function __construct(Engine $templateEngine, ModelFactory $modelFactory) {
        $this->templateEngine = $templateEngine;
        $this->modelFactory = $modelFactory;

        $categoryModel = $this->modelFactory->getEmptyModel(CategoryModel::class);
        $this->templateEngine->addData(['categoryModel' => $categoryModel]);
    }

    public function redirect($path) {
        header("Location: " . $path);
        exit;
    }

    public function beforeAction() {
        $uri = $_SERVER['REQUEST_URI'];

        if (isset($_SESSION['user'])) {
            $this->user = $_SESSION['user'];
        }

        $this->templateEngine->addData(['user' => $this->user]);

        $rules = $this->user ? $this->rules['user'] : $this->rules['guest'];

        if (in_array($uri, $rules)) {
            $this->redirect('/');
        }
    }

    protected function getParam($name, $default = null) {
        $value = $_REQUEST[$name] ?? $default;

        return $value;
    }
}