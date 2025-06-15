<?php

namespace app\services;

use app\core\Route;
use app\models\PhotoModel;

class PhotoService {
    protected PhotoModel $photoModel;

    public function __construct()
    {
        $this->photoModel = new PhotoModel();
    }

    public function upload(array $file)
    {
        //TODO Validation
        if ($file['size'] === 0) {
            return FILE_UPLOAD_ERR[9];
        }
        if (!in_array($file['type'], PHOTO_AVAILABLE_TYPES, true)){
            return FILE_UPLOAD_ERR[10];
        }

// 2. Перевірка розміру вручну
        if ($file['size'] > PHOTO_MAX_FILE_SIZE) {
            return FILE_UPLOAD_ERR[2];
        }

        //Збереження на диск
        $newName = uniqid() . '_' . basename($file['name']);
        move_uploaded_file($file['tmp_name'],  PHOTO_UPLOAD_DIR . DIRECTORY_SEPARATOR .$newName);

        $this->photoModel->upload($newName);

        return null;
    }

}