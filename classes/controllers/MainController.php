<?php
namespace GifTube\controllers;

use GifTube\models\GifModel;
use GifTube\services\ModelFactory;

class MainController extends BaseController {

    public function actionIndex() {
        return $this->templateEngine->render('main');
    }
}