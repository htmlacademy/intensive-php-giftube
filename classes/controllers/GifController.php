<?php
namespace GifTube\controllers;

use GifTube\forms\CommentForm;
use GifTube\forms\GifForm;
use GifTube\models\CommentModel;
use GifTube\models\GifModel;
use GifTube\models\UserModel;
use GifTube\services\DatabaseConnect;
use GifTube\services\FileUploader;

class GifController extends BaseController {

    public function actionAdd() {
        $form  = new GifForm();

        /**
         * @var GifModel $model
         */
        $model = $this->modelFactory->getEmptyModel(GifModel::class);

        if ($form->isSubmitted()) {
            $form->validate();

            if ($form->isValid()) {
                $gif = $form->getData();

                $fileUploader = new FileUploader($_FILES['gif'], APP_PATH . '/web/uploads', 'path');
                $gif['path'] = $fileUploader->generateFilename('gif');
                $fileUploader->upload($gif['path']);

                $id = $model->createNewGif($this->user['id'], $gif);

                $this->redirect('/gif/view?id=' . $id);
            }
        }

        return $this->templateEngine->render('gif/add', ['form' => $form]);
    }

    public function actionView() {
        $id = $this->getParam('id');

        $gifModel  = $this->modelFactory->load(GifModel::class, $id);

        /**
         * @var CommentModel $commentModel
         */
        $commentModel = $this->modelFactory->getEmptyModel(CommentModel::class);

        $form = new CommentForm();

        if ($form->isSubmitted()) {
            $comment = $form->getData();
            $commentModel->createNewComment($this->user['id'], $id, $comment['content']);

            $this->redirect('/gif/view?id=' . $id);
        }

        $view_params = ['id' => $id, 'gif' => $gifModel, 'commentModel' => $commentModel, 'form' => $form];
        return $this->templateEngine->render('gif/view', $view_params);
    }

    public function actionLike() {
        $id = $this->getParam('id');


    }
}