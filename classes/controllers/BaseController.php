<?php
namespace GifTube\controllers;

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