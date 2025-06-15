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
        $this->photoModel = new PhotoModel();
    }

    /**
     * Uploads an image file to the server and saves its name to the database
     * @param array $file
     * @return void
     */
    public function upload(array $file)     
    {
        //TODO Validation

        //Збереження на диск
        $newName = uniqid() . '_' . basename($file['name']);
        move_uploaded_file($file['tmp_name'],  PHOTO_UPLOAD_DIR . DIRECTORY_SEPARATOR .$newName);

        $this->photoModel->upload($newName);
    }

}