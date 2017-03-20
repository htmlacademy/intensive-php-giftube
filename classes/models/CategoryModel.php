<?php
namespace GifTube\models;

class CategoryModel extends BaseModel {

    public function getAll() {
        $sql = 'SELECT id, name FROM categories';
        $res = $this->db->query($sql);

        $rows = $res->fetch_all(MYSQLI_ASSOC);

        return $rows;
    }
}