<?php
namespace GifTube\controllers;

use GifTube\models\GifModel;
use GifTube\models\queries\GifQuery;

class MainController extends BaseController {

    public function actionIndex() {
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
}