<?php
namespace GifTube\models;

class UserModel extends BaseModel {

    public function createNewUser($email, $password, $name, $avatar = '') {
        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql = 'INSERT INTO users (dt_add, email, name, password, avatar_path) VALUES (NOW(), ?, ?, ?, ?)';

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('ssss', $email, $name, $password, $avatar);
        $res = $stmt->execute();

        return $res;
    }

    public function findByField($field, $value) {
        $sql = 'SELECT id, email, name, avatar_path, password FROM users WHERE ' . $field . ' = ?';

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('s', $value);
        $stmt->execute();

        $res = $stmt->get_result();
        $result = $res->fetch_assoc();

        return $result;
    }
}