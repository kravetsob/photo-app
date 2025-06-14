<?php

namespace app\services;

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

        //Збереження на диск
        $newName = uniqid() . '_' . basename($file['name']);
        move_uploaded_file($file['tmp'],  PHOTO_UPLOAD_DIR . DIRECTORY_SEPARATOR .$newName);

        $this->photoModel->upload($newName);
    }

}