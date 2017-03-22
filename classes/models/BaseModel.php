<?php
namespace GifTube\models;

use GifTube\services\{DatabaseConnect, ModelFactory};

class BaseModel {

    /**
     * @var \mysqli
     */
    protected $db;

    /**
     * @var ModelFactory
     */
    protected $modelFactory;

    protected $relations;
    public static $tableName;

    public function __get($name) {
        $result = null;

        if (property_exists($this, $name)) {
            $result = $this->$name;
        }

        return $result;
    }

    public function setDb(DatabaseConnect $databaseConnect) {
        $this->db = $databaseConnect->getDB();

        return $this;
    }

    /**
     * @param ModelFactory $modelFactory
     * @return $this
     */
    public function setModelFactory(ModelFactory $modelFactory) {
        $this->modelFactory = $modelFactory;

        return $this;
    }

    public function getAll($where = array()) {
        $rows = [];
        $sql = 'SELECT * FROM ' . static::$tableName;

        if ($where) {
            $sql .= ' WHERE ' . key($where) . ' = ?';
        }

        $stmt = $this->db->prepare($sql);

        if ($where) {
            $stmt->bind_param('s', current($where));
        }

        $stmt->execute();
        $res = $stmt->get_result();

        while ($row = $res->fetch_object(static::class)) {
            $row->setModelFactory($this->modelFactory);
            $rows[] = $row;
        }

        return $rows;
    }

    public function getRelation($name) {
        $result = null;

        if (isset($this->relations[$name])) {
            list($modelClass, $field) = $this->relations[$name];

            $model = $this->modelFactory->load($modelClass, $this->$field) ;
            $result = $model ?: $this->modelFactory->getEmptyModel($modelClass);
        }
        else {
            throw new \Exception("Связь с именем " . $name . " не существует!");
        }

        return $result;
    }
}