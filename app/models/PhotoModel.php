<?php

namespace app\models;

use app\core\Database;

class PhotoModel
{

    protected $db;
    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /**
     * Returns paginated list of photos count of five
     * @param int $page
     * @return array|bool
     */
    public function all(int $page): array|bool
    {
        $offset = ($page - 1) * IMG_LIMIT;
        $result = $this->db->query('SELECT id, path, likes FROM photos ORDER BY id LIMIT ? OFFSET ?', 'ii', [IMG_LIMIT, $offset]);
        if ($result === false) {
            exit('ошибка получения фото');
        }
        return $result;
    }

    /**
     * Returns the total number of photos
     * @return int
     */
    public function count() : int
    {
        $result = $this->db->query('SELECT COUNT(id) as totalCount FROM photos');
        if ($result === false) {
            exit('помилка підрахунку кількості');
        }
        return $result[0]['totalCount'];
    }

    /**
     * Saves the path to the photo
     * @param string $path
     * @return void
     */
    public function upload(string $path): void
    {
        $result = $this->db->query(
            'INSERT INTO photos (path) VALUES (?)',
            's',
            [$path]
        );
        if ($result === false) {
            exit('ошибка сохранения фото');
        }
    }

}