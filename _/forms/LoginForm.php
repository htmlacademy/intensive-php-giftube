<?php
namespace GifTube\forms;

use GifTube\models\UserModel;

class LoginForm extends BaseForm {

    /**
     * @var UserModel
     */
    protected $model;

    protected $fields = ['email', 'password'];
    protected $labels = [
        'email' => 'E-mail', 'password' => 'Пароль'
    ];
    protected $rules = [
        ['email', ['email']],
        ['login', ['email', 'password']],
        ['required', ['email', 'password']]
    ];

    public function __construct($data = false) {
        $this->name = 'login';

        parent::__construct($data);
    }

    protected function runLoginValidator($fields = null) {
        $result = false;
        $email = $this->formData['email'];
        $password = $this->formData['password'];

        $user = $this->model->findOneBy(['email' => $email]);

        if (!$user) {
            $this->errors['email'] = "Пользователя с этим email не существует";
        }
        else if (!password_verify($password, $user->password)) {
            $this->errors['password'] = "Указан неверный пароль";
        }
        else {
            $result = true;
        }

        return $result;
    }
}