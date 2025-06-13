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
     * Получения всех фото
     * 
     */
    public function all(): array|bool
    {
        $result = $this->db->query('SELECT id, path, likes FROM photos');
        if ($result === false) {
            exit('ошибка получения фото');
        }
        return $result;
    }

    /**
     * Сохранения фото
     * 
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