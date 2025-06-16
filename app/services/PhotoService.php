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
        //TODO Validation

        //Збереження на диск
        $newName = uniqid() . '_' . basename($file['name']);
        $path = PHOTO_UPLOAD_DIR . DIRECTORY_SEPARATOR .$newName;
        move_uploaded_file($file['tmp_name'],  PHOTO_UPLOAD_DIR . DIRECTORY_SEPARATOR .$newName);

        $this->photoModel->upload($newName);
    }

}