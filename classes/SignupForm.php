<?php

/**
 * Class SignupForm
 */
class SignupForm extends BaseForm {

    public $formName = 'signup';

    protected $fields = ['email', 'password', 'name', 'avatar'];

    protected $rules = [
        ['email', ['email']],
        ['image', 'avatar'],
        ['required', ['email', 'password', 'name']]
    ];

    /**
     * Проверяет, что переданное значение - это корректный email
     * @param array $fields Список полей для проверки
     * @return bool Результат проверки
     */
    protected function runEmailValidator($fields) {
        $result = true;

        foreach ($fields as $value) {
            $field = $this->formData[$value];

            if (!filter_var($field, FILTER_VALIDATE_EMAIL)) {
                $result = false;

                $this->errors[$value] = "Введите корректный email";
            }
        }

        return $result;
    }

    /**
     * Проверяет, что загруженный файл является изображением
     * @param string $field Поле с изображением
     * @param string $allowed_mime Допустимые mime_type
     * @return bool Результат проверки
     */
    protected function runImageValidator($field, $allowed_mime = '') {
        $result = true;

        if (isset($_FILES[$this->formName])) {
            $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/tiff'];

            if ($allowed_mime) {
                $allowed_types = [$allowed_mime];
            }

            $file = $_FILES[$this->formName]['tmp_name'][$field];

            if ($file) {
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mime = finfo_file($finfo, $file);

                $result = in_array($mime, $allowed_types);
            }

            if (!$result) {
                $this->errors[$field] = "Загруженный файл должен быть изображением";
            }
        }

        return $result;
    }
}