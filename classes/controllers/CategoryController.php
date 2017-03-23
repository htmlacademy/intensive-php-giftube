<?php
namespace GifTube\controllers;

use GifTube\models\CategoryModel;
use GifTube\models\GifModel;
use GifTube\models\queries\GifQuery;

class CategoryController extends BaseController {

    public function actionIndex() {
        $id = $this->getParam('id');

        $category = $this->modelFactory->load(CategoryModel::class, $id);

        $gifQuery = new GifQuery(new GifModel);
        $sql = $gifQuery->getByCategory($id);
        $gifs = $this->modelFactory->getAllByQuery(GifModel::class, $sql);

        return $this->templateEngine->render('category/index', ['category' => $category, 'gifs' => $gifs]);
    }
}