<?php
namespace GifTube\models;

class CommentModel extends BaseModel {

    public static $tableName = 'comments';

    public function findAllByField($field, $value) {
        $result = null;

        $sql = "SELECT c.id, c.dt_add, user_id, content, u.email, u.name, u.avatar_path FROM comments c 
                INNER JOIN users u ON c.user_id = u.id WHERE " . $field . " = ?";

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('s', $value);
        $stmt->execute();

        $res = $stmt->get_result();
        $result = $res->fetch_all(MYSQLI_ASSOC);

        return $result;
    }

    public function createNewComment($user_id, $gif_id, $content) {
        $sql = 'INSERT INTO comments (dt_add, user_id, gif_id, content) VALUES (NOW(), ?, ?, ?)';

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('iis', $user_id, $gif_id, $content);
        $res = $stmt->execute();

        return $res;
    }
}