<?php
/**
 * Created by PhpStorm.
 * User: frexin
 * Date: 17.03.2017
 * Time: 19:10
 */

namespace GifTube\controllers;

use GifTube\forms\SignupForm;

class UserController extends BaseController{

    public function actionSignup() {
        $form = new SignupForm();

        if ($form->isSubmitted()) {
            $form->validate();

            if ($form->isValid()) {

            }
            else {
                $errors = $form->getErrors();
                var_dump($errors);
            }
        }

        return $this->templateEngine->render('user/signup', ['form' => $form]);
    }
}