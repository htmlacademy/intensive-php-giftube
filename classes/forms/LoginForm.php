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
        ['required', ['email', 'password']],
        ['email', ['email']],
        ['login', ['email', 'password']]
    ];

    public function __construct($data = false) {
        $this->name = 'login';

        parent::__construct($data);
    }

    public function login($email) {
        $user = $this->model->findByField('email', $email);

        if ($user) {
            $_SESSION['user'] = $user;
        }

        return $user;
    }

    protected function runLoginValidator($fields = null) {
        $result = false;
        $email = $this->formData['email'];
        $password = $this->formData['password'];

        $user = $this->model->findByField('email', $email);

        if (!$user) {
            $this->errors['email'] = "Пользователя с этим email на найдено";
        }
        else if (!password_verify($password, $user['password'])) {
            $this->errors['password'] = "Указан неверный пароль";
        }
        else {
            $result = true;
        }

        return $result;
    }
}