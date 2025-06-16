<?php

namespace app\models;

class LikeModel extends BaseModel
{
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
            'UPDATE photos SET likes = COALESCE(likes, 0) + 1 WHERE id = ?',
            'i',
            [$imageId]
        );
    }
}

