<?php
namespace GifTube\services;

use GifTube\models\BaseModel;

class ModelFactory {

    private static $instance;

    /**
     * @var DatabaseConnect
     */
    protected $databaseConnect;

    public static function getInstance(DatabaseConnect $databaseConnect = null) {
        if (!self::$instance) {
            self::$instance = new self($databaseConnect);
        }

        return self::$instance;
    }

    public function getEmptyModel($className) : BaseModel {
        $model = new $className;
        $model->setDb($this->databaseConnect)->setModelFactory($this);

        return $model;
    }

    public function load($className, $id) : BaseModel {
        $table = $className::$tableName;

        $sql = 'SELECT * FROM ' . $table . ' WHERE id = ? LIMIT 1';

        $stmt = $this->databaseConnect->getDB()->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $model = $stmt->get_result()->fetch_object($className);
        $model->setDb($this->databaseConnect)->setModelFactory($this);

        return $model;
    }

    public function getAllByQuery($className, $sql) {
        $items = [];

        if ($res = $this->databaseConnect->getDB()->query($sql)) {
            while ($item = $res->fetch_object($className)) {
                $items[] = $item;
            }
        }

        return $items;
    }

    private function __construct(DatabaseConnect $databaseConnect = null) {
        if ($databaseConnect) {
            $this->databaseConnect = $databaseConnect;
        }
    }
}