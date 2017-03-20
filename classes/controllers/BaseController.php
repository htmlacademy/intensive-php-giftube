<?php
namespace GifTube\controllers;

use GifTube\DatabaseConnect;
use GifTube\models\CategoryModel;
use League\Plates\Engine;

class BaseController {

    /**
     * @var Engine
     */
    protected $templateEngine;

    protected $rules = [
        'guest' => ["/gif/add", "/logout"],
        'user'  => ["/signin", "/signup"]
    ];

    public function __construct($templateEngine) {
        $this->templateEngine = $templateEngine;

        $categoryModel = new CategoryModel(DatabaseConnect::getInstance());
        $categories = $categoryModel->getAll();

        $this->templateEngine->addData(['categories' => $categories], 'layout');
    }

    public function redirect($path) {
        header("Location: " . $path);
        exit;
    }

    public function beforeAction() {
        $uri = $_SERVER['REQUEST_URI'];
        $user = null;

        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
        }

        $this->templateEngine->addData(['user' => $user], 'layout');

        $rules = $user ? $this->rules['user'] : $this->rules['guest'];

        if (in_array($uri, $rules)) {
            $this->redirect('/');
        }
    }
}