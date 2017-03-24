<?php
namespace GifTube\controllers;

use GifTube\facades\GifFacade;
use GifTube\forms\CommentForm;
use GifTube\forms\GifForm;
use GifTube\models\CommentModel;
use GifTube\models\GifModel;
use GifTube\services\FileUploader;

class GifController extends BaseController {

    public function actionAdd() {
        $this->pageTitle = 'Добавление новой гифки';
        $form  = new GifForm();

        /**
         * @var GifModel $model
         */
        $model = $this->modelFactory->getEmptyModel(GifModel::class);

        if ($form->isSubmitted()) {
            $form->validate();

            if ($form->isValid()) {
                $fileUploader = new FileUploader($_FILES['gif'], UPLOAD_PATH, 'path');

                $gifFacade = new GifFacade($this->modelFactory, $model, $fileUploader, $this->user->getUserModel());
                $gifModel = $gifFacade->createAndSaveGif($form->getData());

                $this->redirect('/gif/view?id=' . $gifModel->id);
            }
        }

        return $this->templateEngine->render('gif/add', ['form' => $form]);
    }

    public function actionView() {
        $id = $this->getParam('id');

        /**
         * @var GifModel $gifModel
         */
        $gifModel  = $this->modelFactory->load(GifModel::class, $id);
        $this->pageTitle = $gifModel->title;

        /**
         * @var CommentModel $commentModel
         */
        $commentModel = $this->modelFactory->getEmptyModel(CommentModel::class);

        $form = new CommentForm();

        if ($form->isSubmitted()) {
            $form->validate();
            $comment = $form->getData();

            if ($form->isValid()) {
                $commentModel->createNewComment($this->user->getUserModel()->id, $id, $comment['content']);
                $this->redirect('/gif/view?id=' . $id);
            }
        }

        $gifModel->changeCounter('show_count', '+');

        $view_params = ['id' => $id, 'gif' => $gifModel, 'commentModel' => $commentModel, 'form' => $form];
        return $this->templateEngine->render('gif/view', $view_params);
    }

    public function actionLike() {
        $id  = $this->getParam('id');
        $rem = $this->getParam('rem');

        /**
         * @var GifModel $gifModel
         */
        $gifModel  = $this->modelFactory->load(GifModel::class, $id);
        $user = $this->user->getUserModel();

        if ($rem) {
            $gifModel->removeLike($user);
        }
        else {
            $gifModel->addLike($user);
        }

        $this->redirect('/gif/view?id=' . $id);
    }

    public function actionFav() {
        $id  = $this->getParam('id');
        $rem = $this->getParam('rem');

        /**
         * @var GifModel $gifModel
         */
        $gifModel  = $this->modelFactory->load(GifModel::class, $id);
        $user = $this->user->getUserModel();

        if ($rem) {
            $gifModel->removeFav($user);
        }
        else {
            $gifModel->addFav($user);
        }

        $this->redirect('/gif/view?id=' . $id);
    }
}