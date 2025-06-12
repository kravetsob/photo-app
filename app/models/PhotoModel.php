<?php

namespace app\models;

use app\core\Database;
use Exception;

class PhotoModel
{
    /**
     * Получения всех фото
     * @throws Exception
     */
    public function allPhoto(): array|bool
    {
        $result = Database::getInstance()->query("SELECT * FROM photos");
        if($result === false){
            throw new Exception('ошибка получения фото');
        }
        return $result;
    }

    /**
     * Сохранения фото
     * @throws Exception
     */
    public function upload(string $image): void
    {
        $result = Database::getInstance()->query("INSERT INTO photos (path) VALUES ('$image')");
        if($result === false){
            throw new Exception('ошибка сохранения фото');
        }
    }

}