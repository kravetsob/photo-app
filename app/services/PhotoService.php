<?php

namespace app\services;

use app\models\PhotoModel;
use app\validators\PhotoValidator;

class PhotoService
{
    /**
     * @var PhotoModel
     */
    protected PhotoModel $photoModel;

    /**
     * @var PhotoValidator
     */
    protected PhotoValidator $photoValidator;

    /**
     * PhotoService constructor
     */
    public function __construct()
    {
        $this->checkDir();
        $this->photoModel = new PhotoModel();
        $this->photoValidator = new PhotoValidator();
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
    public function store(array $file): array
    {
        $errors = $this->photoValidator->validate($file);

        //у разі помилки
        if (!empty($errors)) {
            return [
                'success' => false,
                'errors' => $errors,
            ];
        }

        $newName = uniqid() . '_' . basename($file['name']);
        $destination = PHOTO_UPLOAD_DIR . DIRECTORY_SEPARATOR . $newName;

        if (!move_uploaded_file($file['tmp_name'], $destination)) {
            return [
                'success' => false,
                'errors' => ['Не вдалося зберегти файл.'],
            ];
        }

        //у разі успішного завантаження
        return [
            'success' => true,
            'filename' => $newName,
        ];
    }
}