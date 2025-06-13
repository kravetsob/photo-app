<?php

namespace app\models;

use app\core\Database;

class PhotoModel
{

    protected $db;
    private function __construct()
    {
        $this->db = Database::getInstance();
    }
    /**
     * Получения всех фото
     * 
     */
    public function allPhoto(): array|bool
    {
        $result = $this->db->query('SELECT * FROM photos');
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