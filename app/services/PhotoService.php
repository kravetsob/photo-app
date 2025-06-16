<?php

namespace app\services;

use app\models\PhotoModel;

class PhotoService
{
    /**
     * @var PhotoModel
     */
    protected PhotoModel $photoModel;

    /**
     * PhotoService constructor
     */
    public function __construct()
    {
        $this->checkDir();
        $this->photoModel = new PhotoModel();
    }

    /**
     * Check and create directory
     * @return void
     */
    protected function checkDir()
    {
        if(!is_dir(PHOTO_UPLOAD_DIR)){
            mkdir(PHOTO_UPLOAD_DIR, 0777, true);
        }
    }

    /**
     * Uploads an image file to the server and saves its name to the database
     * @param array $file
     * @return string
     */
    public function store(array $file): ?string
    {
        if ($file['size'] === 0) {
            return FILE_UPLOAD_ERR[4];
        }
        if (!in_array($file['type'], PHOTO_AVAILABLE_TYPES, true)){
            return FILE_UPLOAD_ERR[5];
        }

        if ($file['size'] > PHOTO_MAX_FILE_SIZE) {
            return FILE_UPLOAD_ERR[2];
        }

        //Збереження на диск
        $newName = uniqid() . '_' . basename($file['name']);
        if(!move_uploaded_file($file['tmp_name'],  PHOTO_UPLOAD_DIR . DIRECTORY_SEPARATOR .$newName)){
            $newName = null;
        }

        $this->photoModel->upload($newName);

        return $newName;
    }

}