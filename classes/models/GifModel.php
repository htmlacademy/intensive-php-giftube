<?php
namespace GifTube\models;

class GifModel extends BaseModel {

    public static $tableName = 'gifs';
    public static $queryName = 'GifQuery';

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
    protected $authorName;

    public function getFullPath() {
        $path = realpath(UPLOAD_PATH . '/' . $this->path);

        return $path;
    }

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

    public function changeCounter($name, $sign) {
        $sql = 'UPDATE ' . static::$tableName . ' SET ' . $name . ' = ' . $name . ' ' . $sign . ' 1 WHERE id = ' . $this->id;

        return $this->runSimpleQuery($sql);
    }

    public function addLike(UserModel $userModel) {
        $sql = "INSERT INTO gifs_like (user_id, gif_id) VALUES ({$userModel->id}, {$this->id})";
        $this->changeCounter('like_count', '+');

        return $this->runSimpleQuery($sql);
    }

    public function removeLike(UserModel $userModel) {
        $sql = "DELETE FROM gifs_like WHERE user_id = {$userModel->id} AND gif_id = {$this->id}";
        $this->changeCounter('like_count', '-');

        return $this->runSimpleQuery($sql);
    }

    public function addFav(UserModel $userModel) {
        $sql = "INSERT INTO gifs_fav (user_id, gif_id) VALUES ({$userModel->id}, {$this->id})";
        $this->changeCounter('fav_count', '+');

        return $this->runSimpleQuery($sql);
    }

    public function removeFav(UserModel $userModel) {
        $sql = "DELETE FROM gifs_fav WHERE user_id = {$userModel->id} AND gif_id = {$this->id}";
        $this->changeCounter('fav_count', '-');

        return $this->runSimpleQuery($sql);
    }
}