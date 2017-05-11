<?php
namespace GifTube\models;

use GifTube\services\{DatabaseConnect, ModelFactory};

class BaseModel {

    /**
     * @var \mysqli
     */
    public $db;

    /**
     * @var ModelFactory
     */
    protected $modelFactory;

    protected $relations;
    public static $tableName;
    public static $queryName;

    public function __get($name) {
        $result = null;

        if (property_exists($this, $name)) {
            $result = $this->$name;
        }

        return $result;
    }

    public function getTableName() {
        return static::$tableName;
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

    public function getScalarValue($sql) {
        $result = null;

        if ($res = $this->getDb()->query($sql)) {
            $result = $res->fetch_array(MYSQLI_NUM)[0];
        }

        return $result;
    }

    public function findAllBy($where = array()) {
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

    public function findOneBy($where) {
        $result = $this->modelFactory->getEmptyModel(static::class);
        $sql = 'SELECT * FROM ' . static::$tableName . ' WHERE ' . key($where) . ' = ?';

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('s', current($where));
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res) {
            $result = $res->fetch_object(static::class);

            if ($result) {
                $result->setModelFactory($this->modelFactory);
                $result->db = $this->db;
            }
        }

        return $result;
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

    public function getQuery() {
        $result = null;
        $className = 'GifTube\\models\\queries\\' . static::$queryName;

        if (class_exists($className)) {
            $result = new $className($this);
        }

        return $result;
    }

    protected function runSimpleQuery($sql) {
        $res = $this->db->query($sql);

        return $res;
    }

    protected function getDb() {
        $db = DatabaseConnect::getInstance()->getDB();

        return $db;
    }
}