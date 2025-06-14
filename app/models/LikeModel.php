<?php

namespace app\models;
use app\core\Database;


class LikeModel
{
    private $db;

    /**
     * Establishes a connection to the database.
     */
    public function __construct()
    {
        $this->db = Database::getInstance();
    }
    /**
     *Get the number of likes by photo ID
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
     * Add a like to the photo
     * @param int $imageId
     * @return void
     */
    public function add(int $imageId): void
    {
        $this->db->query(
            'UPDATE photos SET likes = likes + 1 WHERE id = ?',
            'i',
            [$imageId]
        );
    }
}

