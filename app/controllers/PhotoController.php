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
        $page = ($_GET['page']) ?? 1;
        $nextPage = $page + 1;
        $prevPage = $page - 1;
        $rowCount = $this->photoModel->count();
        $pageCount = ceil($rowCount/ IMG_LIMIT);

        $photos = $this->photoModel->all($page);
        $this->view->render('index_index', [
            'title' => 'Home',
            'photos' => $photos,
            'page' => $page,
            'pageCount' => $pageCount,
            'prevPage' => $prevPage,
            'nextPage' => $nextPage,
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