<?php
namespace GifTube\controllers;

use GifTube\helpers\AppRegistry;
use GifTube\models\UserModel;
use GifTube\services\AuthUser;
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

    /**
     * @var AuthUser
     */
    protected $user;

    protected $rules = [
        'guest' => ["/gif/add", "/logout"],
        'user'  => ["/signin", "/signup"]
    ];

    protected $pageTitle;

    public function __construct(Engine $templateEngine, ModelFactory $modelFactory) {
        $this->templateEngine = $templateEngine;
        $this->modelFactory = $modelFactory;
        $this->user = new AuthUser(UserModel::class, $modelFactory);

        $categoryModel = $this->modelFactory->getEmptyModel(CategoryModel::class);

        $this->templateEngine->addData(['categoryModel' => $categoryModel]);
        $this->templateEngine->addData(['ctrl' => $this]);
    }

    public function getTitle() {
        $title = AppRegistry::getTitle();

        if ($this->pageTitle) {
            $title = $this->pageTitle . ' | ' . $title;
        }

        return $title;
    }

    public function redirect($path) {
        header("Location: " . $path);
        exit;
    }

    public function beforeAction() {
        $this->user->proceedAuth();

        $uri = $_SERVER['REQUEST_URI'];
        $this->templateEngine->addData(['user' => $this->user]);

        $rules = $this->user->isGuest() ? $this->rules['guest'] : $this->rules['user'];

        if (in_array($uri, $rules)) {
            $this->redirect('/');
        }
    }

    public function getParam($name, $default = null) {
        $value = $_REQUEST[$name] ?? $default;

        return $value;
    }
}