<?php
namespace GifTube\controllers;

use GifTube\models\GifModel;
use GifTube\models\queries\GifQuery;
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
                $this->user->loginByEmail($form->email);

                $this->redirect('/');
            }
        }

        return $this->templateEngine->render('user/signin', ['form' => $form]);
    }

    public function actionLogout() {
        $this->user->logout();
        $this->redirect('/');
    }

    public function actionFavorites() {
        $gifQuery = new GifQuery(new GifModel);
        $sql = $gifQuery->getFavorites($this->user->getUserModel()->id);

        $gifs = $this->modelFactory->getAllByQuery(GifModel::class, $sql);

        return $this->templateEngine->render('gif/grid', ['name' => 'Избранное', 'gifs' => $gifs]);
    }
}