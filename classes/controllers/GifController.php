<?php
namespace GifTube\controllers;

use GifTube\forms\GifForm;
use GifTube\models\GifModel;
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
}