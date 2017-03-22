<?php
namespace GifTube\models;

class GifModel extends BaseModel {

    public static $tableName = 'gifs';

    protected $relations = [
        'author' => [UserModel::class, 'user_id'],
        'category' => [CategoryModel::class, 'category_id']
    ];

    protected $id;
    protected $category_id;
    protected $user_id;
    protected $dt_add;
    protected $show_count;
    protected $like_count;
    protected $fav_count;
    protected $title;
    protected $description;
    protected $path;

    public function createNewGif($user_id, array $gif_data) {
        list($category, $title, $description, $path) = array_values($gif_data);
        $sql = 'INSERT INTO gifs (dt_add, user_id, category_id, title, description, path) VALUES (NOW(), ?, ?, ?, ?, ?)';

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('iisss', $user_id, $category, $title, $description, $path);
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

//    public function addLike($)
}