<?php

namespace app\controllers;
use app\core\View;
use app\core\Route;
use app\models\PhotoModel;

class PhotoController
{
    protected $view;
    protected $photoModel;
    public function __construct(){
        $this->view = new View();
        $this->photoModel = new PhotoModel();
    }
    public function index()
    {
        $photos = $this->photoModel->all();
        $this->view->render('index_index', [
            'title' => 'Home',
            'photos' => $photos,
        ]);
    }

    public function upload()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $img = $_FILES['image'];
            $imgPath = PHOTO_UPLOAD_DIR . '/'. $img['name'];
            $this->photoModel->upload($imgPath);
            Route::redirect(Route::url('photo'));
        }

        $this->view->render('index_upload', [
            'title' => 'Upload',
        ]);
    }
}