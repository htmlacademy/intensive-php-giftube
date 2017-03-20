<?php
namespace GifTube\models;

use GifTube\services\DatabaseConnect;

class BaseModel {

    protected $db;

    public function __construct(DatabaseConnect $databaseConnect) {
        $this->db = $databaseConnect->getDB();
    }
}