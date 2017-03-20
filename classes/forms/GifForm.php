<?php
namespace GifTube\forms;


class GifForm extends BaseForm {

    protected $fields = ['category', 'title', 'description', 'path'];
    protected $labels = [
        'category' => 'Категория', 'title' => 'Название', 'description' => 'Описание', 'path' => 'Gif файл'
    ];
    protected $rules = [
        ['required', ['category', 'title', 'description']],
        ['gif', 'path'],
        ['numeric', 'category']
    ];

    public function __construct($data = false) {
        $this->name = 'gif';

        parent::__construct($data);
    }

    protected function runGifValidator($field) {
        $result = $this->runImageValidator($field, 'image/gif');

        if (!$result) {
            $this->errors[$field] = 'Загруженный файл должен быть gif изображением';
        }

        return $result;
    }
}