<?php
namespace GifTube\controllers;

use GifTube\DatabaseConnect;
use GifTube\forms\SignupForm;
use GifTube\models\UserModel;

class UserController extends BaseController {

    public function actionSignup() {
        $form = new SignupForm();
        $userModel = new UserModel(DatabaseConnect::getInstance());
        $form->setModel($userModel);

        if ($form->isSubmitted()) {
            $form->validate();

            if ($form->isValid()) {
                $user = $form->getData();
                $userModel->createNewUser($user['email'], $user['password'], $user['name'], $user['avatar']);

                $this->redirect('/');
            }
        }

        return $this->templateEngine->render('user/signup', ['form' => $form]);
    }
}