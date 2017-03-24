<?php
namespace GifTube\controllers;

use GifTube\models\GifModel;
use GifTube\models\queries\GifQuery;
use GifTube\services\DatabaseConnect;

class MainController extends BaseController {

    public function actionIndex() {
        $this->pageTitle = 'Главная страница';

        $gifQuery = new GifQuery(new GifModel);
        $sql = '';

        $tab = $this->getParam('tab', 'top');

        switch ($tab) {
            case 'top':
                $sql = $gifQuery->getTopItems();
                break;
            case 'new':
                $sql = $gifQuery->getNewestItems();
                break;
        }

        $gifs = $this->modelFactory->getAllByQuery(GifModel::class, $sql);

        return $this->templateEngine->render('main', ['gifs' => $gifs]);
    }

    public function actionSearch() {
        $this->pageTitle = 'Результаты поиска';

        $query = trim($this->getParam('q'));
        $query = DatabaseConnect::getInstance()->getDB()->real_escape_string($query);

        $gifQuery = new GifQuery(new GifModel);
        $sql = $gifQuery->searchByQuery($query);

        $gifs = $this->modelFactory->getAllByQuery(GifModel::class, $sql);

        return $this->templateEngine->render('gif/grid', ['name' => 'Результаты поиска', 'gifs' => $gifs]);
    }
}