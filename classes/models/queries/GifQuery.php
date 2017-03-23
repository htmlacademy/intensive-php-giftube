<?php
namespace GifTube\models\queries;

class GifQuery extends BaseQuery {

    public function searchByQuery($query) {
        $this->where = 'WHERE t1.title LIKE \'%' . $query . '%\' OR description LIKE \'%' . $query . '%\'';

        return $this->getSql();
    }

    public function getByCategory($category_id) {
        $category_id = intval($category_id);
        $this->where = 'WHERE t1.category_id = ' . $category_id;

        return $this->getSql();
    }

    public function getFavorites($user_id) {
        $user_id = intval($user_id);
        $this->join .= ' INNER JOIN gifs_fav gf ON t1.id = gf.gif_id AND gf.user_id = ' . $user_id;

        return $this->getSql();
    }

    public function getNewestItems() {
        $this->setOrder('t1.dt_add DESC');

        return $this->getSql();
    }

    public function getTopItems() {
        $this->setOrder('show_count DESC');

        return $this->getSql();
    }

    protected function initSql() {
        $this->select = 'SELECT t1.*, u.name as authorName';
        $this->from   = 'FROM ' . $this->model->getTableName() . ' t1';
        $this->join   = 'INNER JOIN users u ON t1.user_id = u.id';
    }
}