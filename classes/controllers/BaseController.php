<?php
namespace GifTube\controllers;

use League\Plates\Engine;

class BaseController {

    /**
     * @var Engine
     */
    protected $templateEngine;

    public function __construct($templateEngine) {
        $this->templateEngine = $templateEngine;
    }
}