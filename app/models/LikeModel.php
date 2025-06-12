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

use mysqli;

class LikeModel
{
    private mysqli $db;

    /**
     * Встановлює з'єднання з базою даних.
     */
    public function __construct()
    {
        $this->db = new mysqli("localhost", "root", "", "our_db_name");
    }

    /**
     * Отримати кількість лайків по ID картинки
     * @param int $imageId
     * @return int
     */
    public function getLikes(int $imageId): int
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM likes WHERE imageId = ?");
        $stmt->bind_param("i", $imageId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc()['count'] ?? 0;
    }

    /**
     * Додати лайк до картинки
     * @param int $imageId
     * @return void
     */
    public function addLike(int $imageId): void
    {
        $stmt = $this->db->prepare("INSERT INTO likes (imageId) VALUES (?)");
        $stmt->bind_param("i", $imageId);
        $stmt->execute();
    }

    /**
     * Отримати всі лайки (масив: image_id => count)
     * @return array
     */
    public function allLikes(): array
    {
        $likes = [];
        $result = $this->db->query("SELECT imageId, COUNT(*) as count FROM likes GROUP BY imageId"); // підраховує кількість лайків, у яких image_id однаковий.
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $likes[$row['imageId']] = $row['count'];
            }
        }
        return $likes;
    }
}

