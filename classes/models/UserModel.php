<?php
namespace GifTube\models;

class UserModel extends BaseModel {

    protected $id;
    protected $dt_add;
    protected $email;
    protected $name;
    protected $password;
    protected $avatar_path;

    public static $tableName = 'users';

    public function createNewUser($email, $password, $name, $avatar = '') {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $token = $this->generateHash([$email, $password, $name]);

        $sql = 'INSERT INTO users (dt_add, email, name, password, avatar_path, token) VALUES (NOW(), ?, ?, ?, ?, ?)';

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('sssss', $email, $name, $password, $avatar, $token);
        $res = $stmt->execute();

        return $res;
    }

    public function updateToken($token) {
        $sql = 'UPDATE ' . static::$tableName . ' SET token = ? WHERE id = ?';

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('si', $token, $this->id);
        $res = $stmt->execute();

        return $res;
    }

    public function generateHash(array $user_data) {
        $ts  = microtime(true);
        $str = implode(';', array_merge([$ts], $user_data));

        $hash = md5($str);

        return $hash;
    }

    public function hasRelatedGif(GifModel $gifModel, $type) {
        $items = $this->getRelatedGifs($type);

        return isset($items[$gifModel->id]);
    }

    /**
     * @param string $type
     * @return GifModel[]
     */
    public function getRelatedGifs($type) {
        $gifs = [];
        $table = 'gifs_' . $type;

        $sql = 'SELECT g.* FROM ' . GifModel::$tableName . ' g INNER JOIN ' . $table . ' gl ON g.id = gl.gif_id 
        AND gl.user_id = ' . $this->id;

        $res = $this->getDb()->query($sql);

        if ($res) {
            while ($gif = $res->fetch_object(GifModel::class)) {
                $gifs[$gif->id] = $gif;
            }
        }

        return $gifs;
    }
}