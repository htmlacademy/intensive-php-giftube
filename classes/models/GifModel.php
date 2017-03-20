<?php
namespace GifTube\models;

class GifModel extends BaseModel {

    public function createNewGif($user_id, $category_id, $title, $description, $path) {
        $sql = 'INSERT INTO gifs (dt_add, user_id, category_id, title, description, path) VALUES (NOW(), ?, ?, ?, ?, ?)';

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('iisss', $user_id, $category_id, $title, $description, $path);
        $res = $stmt->execute();

        if ($res) {
            $res = $this->db->insert_id;
        }

        return $res;
    }
}