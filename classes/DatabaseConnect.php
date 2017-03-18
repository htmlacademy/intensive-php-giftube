<?php
namespace GifTube;

class DatabaseConnect {

    private static $instance;
    private $mysqli;

    public static function getInstance($params = null) {
        if (!self::$instance) {
            self::$instance = new self($params);
        }

        return self::$instance;
    }

    public function getDB() {
        return $this->mysqli;
    }

    private function __construct($params = null) {
        if ($params) {
            $this->mysqli = new \mysqli($params['host'], $params['user'], $params['password'], $params['database']);
            $this->mysqli->select_db($params['database']);
        }
    }
}