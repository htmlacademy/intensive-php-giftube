<?php
namespace GifTube\controllers;

class GifController extends BaseController {

    public function actionAdd() {

        return $this->templateEngine->render('gif/add');
    }
}