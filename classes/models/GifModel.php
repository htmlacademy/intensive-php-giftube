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

    public function findById($id) {
        $sql = 'SELECT category_id, user_id, dt_add, show_count, like_count, title, description, path FROM gifs WHERE id = ?';

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $gif = $stmt->get_result()->fetch_assoc();

        return $gif;
    }

    public function findAllByCategory($category_id, $exclude_id, $limit = 3) {
        $sql = 'SELECT u.name, g.like_count, g.title, g.description, g.path, g.title FROM gifs g INNER JOIN users u 
                ON g.user_id = u.id WHERE category_id = ? AND g.id <> ? LIMIT ?';

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('iii', $category_id, $exclude_id, $limit);
        $stmt->execute();

        $gifs = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        return $gifs;
    }
}