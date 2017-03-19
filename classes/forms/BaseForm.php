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
        $result = null;

        if (isset($this->formData[$name])) {
            $result = $this->formData[$name];
        }

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

    public function getErrors() {
        return $this->errors;
    }

    public function getData() {
        return $this->formData;
    }

    public function getLabelFor($field) {
        $result = null;

        if (isset($this->labels[$field])) {
            $result = $this->labels[$field];
        }

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
            $row = $this->model->findByField($field, $value);

            if ($row) {
                $result = false;

                $this->errors[$field] = "Это поле должно быть уникальным";
            }
        }

        return $result;
    }

    protected function runImageValidator($field) {
        $result = true;

        if (isset($_FILES[$this->name])) {
            $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/tiff'];
            $file = $_FILES[$this->name]['tmp_name'][$field];

            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime  = finfo_file($finfo, $file);

            $result = in_array($mime, $allowed_types);
        }

        if (!$result) {
            $this->errors[$field] = "Загруженный файл должен быть изображением";
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