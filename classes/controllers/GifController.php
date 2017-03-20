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
        $model = new GifModel(DatabaseConnect::getInstance());

        if ($form->isSubmitted()) {
            $form->validate();

            if ($form->isValid()) {
                $gif = $form->getData();

                $fileUploader = new FileUploader($_FILES['gif'], APP_PATH . '/web/uploads', 'path');
                $gif['path'] = $fileUploader->generateFilename('gif');
                $fileUploader->upload($gif['path']);

                $id = $model->createNewGif($this->user['id'], $gif['category'], $gif['title'], $gif['description'],
                    $gif['path']);

                $this->redirect('/gif/view?id=' . $id);
            }
        }

        return $this->templateEngine->render('gif/add', ['form' => $form]);
    }

    public function actionView() {
        $id = $this->getParam('id');

        $gifModel     = new GifModel(DatabaseConnect::getInstance());
        $userModel    = new UserModel(DatabaseConnect::getInstance());
        $commentModel = new CommentModel(DatabaseConnect::getInstance());

        $form = new CommentForm();

        if ($form->isSubmitted()) {
            $comment = $form->getData();
            $commentModel->createNewComment($this->user['id'], $id, $comment['content']);

            $this->redirect('/gif/view?id=' . $id);
        }

        return $this->templateEngine->render('gif/view', ['id' => $id, 'gifModel' => $gifModel,
            'userModel' => $userModel, 'commentModel' => $commentModel, 'form' => $form]);
    }
}