<?php
namespace GifTube\models\queries;

use GifTube\models\BaseModel;

abstract class BaseQuery {

    /**
     * @var BaseModel
     */
    protected $model;

    protected $select;
    protected $where;
    protected $from;
    protected $join;

    protected $offset;
    protected $limit;
    protected $order;

    protected $sql;

    /**
     * BaseQuery constructor.
     * @param BaseModel $model
     */
    public function __construct(BaseModel $model) {
        $this->model = $model;

        $this->initSql();
    }

    /**
     * @param mixed $offset
     */
    public function setOffset($offset) {
        $this->offset = $offset;
    }

    /**
     * @param mixed $limit
     */
    public function setLimit($limit) {
        $this->limit = $limit;
    }

    /**
     * @param mixed $order
     */
    public function setOrder($order) {
        $this->order = 'ORDER BY ' . $order;
    }

    public function getSql($with_limit = true, $replace = array()) {
        $parts = [$this->select, $this->from, $this->join, $this->where, $this->order];
        $parts = array_replace($parts, $replace);

        if ($with_limit) {
            $parts[] = $this->getLimitSql();
        }

        $sql = implode(' ', $parts);

        return $sql;
    }

    public function getCountSql() {
        $select = ['SELECT COUNT(t1.id)'];

        return $this->getSql(false, $select);
    }

    protected function getLimitSql() {
        $sql = '';

        if ($this->limit !== null && $this->offset !== null) {
            $sql = 'LIMIT ' . $this->offset . ', ' . $this->limit;
        }

        return $sql;
    }

    protected abstract function initSql();
}