<?php
namespace GifTube\controllers;

use GifTube\models\CategoryModel;
use GifTube\models\GifModel;
use GifTube\models\queries\GifQuery;
use GifTube\services\Paginator;

class CategoryController extends BaseController {

    public function actionIndex() {
        $id   = $this->getParam('id');
        $page = $this->getParam('page', 1);

        $category = $this->modelFactory->load(CategoryModel::class, $id);
        $this->pageTitle = 'Все гифки в категории «' . $category->name . '»';

        $paginator = new Paginator($this->modelFactory, new GifModel);
        $paginator->setCurrentPage($page);
        $paginator->init('getByCategory', [$id]);

        return $this->templateEngine->render('gif/grid', ['name' => $category->name, 'paginator' => $paginator]);
    }
}