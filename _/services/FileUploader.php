<?php
namespace GifTube\services;

class FileUploader {

    protected $upload_path;
    protected $file;
    protected $name;

    public function __construct($file, $upload_path, $name) {
        $this->file = $file;
        $this->upload_path = $upload_path;
        $this->name = $name;
    }

    public function upload($filename = null) {
        $name = $filename ?: $this->generateFilename();
        $result = move_uploaded_file($this->file['tmp_name'][$this->name], $this->upload_path . DIRECTORY_SEPARATOR . $name);

        return $result;
    }

    public function generateFilename($prefix = 'avatar') {
        $name = uniqid($prefix);
        $extension = pathinfo($this->file['name'][$this->name], PATHINFO_EXTENSION);

        $filename = $name . '.' . $extension;

        return $filename;
    }
}