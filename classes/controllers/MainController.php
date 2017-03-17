<?php
namespace GifTube\controllers;

class MainController extends BaseController {

    public function actionIndex() {
        return $this->templateEngine->render('main');
    }
}