<?php
namespace GifTube\controllers;

use GifTube\models\GifModel;
use GifTube\services\DatabaseConnect;
use GifTube\services\Paginator;

class MainController extends BaseController {

    public function actionIndex() {
        $this->pageTitle = 'Главная страница';

        $page = $this->getParam('page', 1);
        $tab  = $this->getParam('tab', 'top');

        $method = $tab == 'new' ? 'getNewestItems' : 'getTopItems';

        $paginator = new Paginator($this->modelFactory, new GifModel);
        $paginator->setCurrentPage($page);
        $paginator->init($method);

        return $this->templateEngine->render('main', ['paginator' => $paginator]);
    }

    public function actionSearch() {
        $this->pageTitle = 'Результаты поиска';

        $query = trim($this->getParam('q'));
        $page = $this->getParam('page', 1);

        $query = DatabaseConnect::getInstance()->getDB()->real_escape_string($query);

        $paginator = new Paginator($this->modelFactory, new GifModel);
        $paginator->setCurrentPage($page);

        if ($query) {
            $paginator->init('searchByQuery', [$query]);
        }

        return $this->templateEngine->render('gif/grid', ['name' => 'Результаты поиска', 'paginator' => $paginator]);
    }
}