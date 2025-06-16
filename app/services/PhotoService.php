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

    protected function checkDir()
    {
        if(!is_dir(PHOTO_UPLOAD_DIR)){
            mkdir(PHOTO_UPLOAD_DIR, 0777, true);
        }
    }

    /**
     * Uploads an image file to the server and saves its name to the database
     * @param array $file
     * @return void
     */
    public function upload(array $file)
    {
        if ($file['size'] === 0) {
            return FILE_UPLOAD_ERR[9];
        }
        if (!in_array($file['type'], PHOTO_AVAILABLE_TYPES, true)){
            return FILE_UPLOAD_ERR[10];
        }

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