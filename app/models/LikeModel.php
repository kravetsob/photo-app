<?php
//
//namespace app\models;
//
////use app\controllers;
//use mysqli;
//
//class LikeModel
//{
//    public function all(): array
//    {
//        $likes = [];
//        $result = $this->db->query("SELECT * FROM likes");
//
//        if ($result) {
//            while ($like = $result->fetch_assoc()) {
//                $likes[] = $like;
//            }
//        }
//
//        return $likes;
//    }
//    public function add(int $id): void
//    {
//        $stmt = $this->db->prepare("INSERT INTO likes ($id) VALUES (?)");
//        $stmt->bind_param("i", $id);
//        $stmt->execute();
//    }
//
//}

namespace app\models;
use app\core\Database;

class LikeModel
{
    private $db;

    /**
     * Встановлює з'єднання з базою даних.
     */
    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /**
     * Отримати кількість лайків по ID картинки
     * @param int $imageId
     * @return int
     */
    public function getLikes(int $imageId): int
    {
        $result = $this->db->query(
            "SELECT likes FROM photos WHERE id = ?",
            "i",
            [$imageId]
        );
        $likes = $result[0]['likes'] ?? 0;
        return $likes;
    }

    /**
     * Додати лайк до картинки
     * @param int $imageId
     * @return void
     */
    public function addLike(int $imageId): void
    {
        $this->db->query(
            'UPDATE photos SET likes = likes + 1 WHERE id = ?',
            'i',
            [$imageId]
        );
    }
}

