<?php
namespace GifTube\forms;

use GifTube\models\BaseModel;

class BaseForm {

    protected $name;
    protected $isValid = null;
    protected $errors  = [];

    protected $tableName;

    /**
     * @var BaseModel
     */
    protected $model;

    protected $fields = [];
    protected $rules  = [];
    protected $labels = [];

    protected $formData = [];

    public function __construct($data = false) {
        $this->fillFormData();
    }

    public function __get($name) {
        $result = $this->formData[$name] ?? null;

        return $result;
    }

    public function validate() {
        foreach ($this->rules as $rule) {
            list($rulename, $fields) = $rule;

            $this->runValidator($rulename, $fields);
        }
    }

    public function isSubmitted() {
        return isset($_POST[$this->name]);
    }

    public function isValid() {
        return count($this->errors) == 0;
    }

    public function getError($field) {
        return $this->errors[$field] ?? null;
    }

    public function getAllErrors() {
        return $this->errors;
    }

    public function getData() {
        return $this->formData;
    }

    public function getLabelFor($field) {
        $result = $this->labels[$field] ?? null;

        return $result;
    }

    public function setModel(BaseModel $model) {
        $this->model = $model;
    }

    protected function runValidator($name, $fields) {
        $method_name = 'run' . ucfirst($name) . 'Validator';

        if (method_exists($this, $method_name)) {
            $this->$method_name($fields);
        }
    }

    protected function runRequiredValidator($fields) {
        $result = true;

        foreach ($fields as $key => $value) {
            if (!$this->formData[$value]) {
                $result = false;

                $this->errors[$value] = "Это поле должно быть заполнено";
            }
        }

        return $result;
    }

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

    protected function runUniqueValidator($field) {
        $result = true;
        $value = $this->formData[$field];

        if ($this->model) {
            $row = $this->model->findOneBy([$field => $value]);

            if ($row->id) {
                $result = false;

                $this->errors[$field] = "Это поле должно быть уникальным";
            }
        }

        return $result;
    }

    protected function runNumericValidator($field) {
        $result = true;
        $value = $this->formData[$field];

        if (!preg_match('/\d+/', $value)) {
            $result = false;
            $this->errors[$field] = "Значение поля должно быть цифровым";
        }

        return $result;
    }

    protected function runImageValidator($field, $allowed_mime = false) {
        $result = true;

        if (isset($_FILES[$this->name])) {
            $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/tiff'];

            if ($allowed_mime) {
                $allowed_types = [$allowed_mime];
            }

            $file = $_FILES[$this->name]['tmp_name'][$field];

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

    private function fillFormData($data = false) {
        if (!$this->isSubmitted()) {
            return;
        }

        $fillData = $data ?: $_POST[$this->name];

        foreach ($this->fields as $field) {
            $this->formData[$field] = array_key_exists($field, $fillData) ? $fillData[$field] : null;
        }
    }
}