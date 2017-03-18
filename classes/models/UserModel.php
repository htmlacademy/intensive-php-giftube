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
}