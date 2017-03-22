<?php
namespace GifTube\controllers;

use GifTube\services\DatabaseConnect;
use GifTube\services\FileUploader;
use GifTube\forms\LoginForm;
use GifTube\forms\SignupForm;
use GifTube\models\UserModel;

class UserController extends BaseController {

    public function actionSignup() {
        $form = new SignupForm();

        /**
         * @var UserModel $userModel
         */
        $userModel = $this->modelFactory->getEmptyModel(UserModel::class);
        $form->setModel($userModel);

        if ($form->isSubmitted()) {
            $form->validate();

            if ($form->isValid()) {
                $user = $form->getData();
                $avatar = null;

                if (isset($_FILES['signup'])) {
                    $fileUploader = new FileUploader($_FILES['signup'], APP_PATH . '/web/uploads', 'avatar');
                    $avatar = $fileUploader->generateFilename();
                    $fileUploader->upload($avatar);
                }

                $userModel->createNewUser($user['email'], $user['password'], $user['name'], $avatar);
                $this->redirect('/');
            }
        }

        return $this->templateEngine->render('user/signup', ['form' => $form]);
    }

    public function actionSignin() {
        $form = new LoginForm();
        $userModel = $this->modelFactory->getEmptyModel(UserModel::class);
        $form->setModel($userModel);

        if ($form->isSubmitted()) {
            $form->validate();

            if ($form->isValid()) {
                $form->login($form->email);

                $this->redirect('/');
            }
        }

        return $this->templateEngine->render('user/signin', ['form' => $form]);
    }

    public function actionLogout() {
        unset($_SESSION['user']);

        $this->redirect('/');
    }
}