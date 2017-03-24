<?php
namespace GifTube\helpers;

class AppRegistry {

    public static $config = array();

    public static function __callStatic($name, $arguments) {
        $result = null;

        if (preg_match('/^get([\w]+)/i', $name, $matches)) {
            $key = strtolower($matches[1]);
            $result = self::$config[$key] ?? null;
        }

        return $result;
    }

}