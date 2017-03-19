<?php
namespace GifTube\models;

use GifTube\DatabaseConnect;

class BaseModel {

    protected $db;

    public function __construct(DatabaseConnect $databaseConnect) {
        $this->db = $databaseConnect->getDB();
    }

    public function findByField($field, $value) {
        $result = null;

        $sql = 'SELECT id, email, name, avatar_path FROM users WHERE ' . $field . ' = ?';

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('s', $value);
        $stmt->execute();

        $res = $stmt->get_result();
        $result = $res->fetch_row();

        return $result;
    }
}