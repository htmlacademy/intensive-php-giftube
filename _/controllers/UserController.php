<?php
namespace GifTube\controllers;

use GifTube\models\GifModel;
use GifTube\models\queries\GifQuery;
use GifTube\services\FileUploader;
use GifTube\forms\LoginForm;
use GifTube\forms\SignupForm;
use GifTube\models\UserModel;
use GifTube\services\Paginator;

class UserController extends BaseController {

    public function actionSignup() {
        $this->pageTitle = 'Регистрация пользователя';
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
        $this->pageTitle = 'Вход на сайт';

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
        $this->pageTitle = 'Моё избранное';

        $page = $this->getParam('page', 1);

        $paginator = new Paginator($this->modelFactory, new GifModel);
        $paginator->setCurrentPage($page);
        $paginator->init('getFavorites', [$this->user->getUserModel()->id]);

        return $this->templateEngine->render('gif/grid', ['name' => 'Избранное', 'paginator' => $paginator]);
    }
}