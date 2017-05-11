<?php
namespace GifTube\forms;

class CommentForm extends BaseForm {

    protected $name = 'comment';

    protected $fields = ['gif_id', 'content'];
    protected $labels = [
        'gif_id' => 'Гифка', 'content' => 'Текст комментария'
    ];
    protected $rules = [
        ['required', ['gif_id', 'content']],
        ['numeric', 'gif_id']
    ];
}