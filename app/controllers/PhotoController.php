<?php

namespace app\controllers;
use app\core\View;
use app\core\Route;
//TODO Винести функціонал Page з Index і прибрати PhotoModel
use app\models\PhotoModel;
use app\services\PhotoService;

class PhotoController
{
    protected $view;
    protected $photoModel;
    protected $photoService;
    public function __construct(){
        $this->view = new View();
        $this->photoModel = new PhotoModel();
        $this->photoService = new PhotoService();
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

    public function upload(): void
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $error = $this->photoService->upload($_FILES['image']);
            if ($error){
            $this->view->render('index_upload', [
                'title' => 'Upload',
                'error' => $error
            ]);
            return;
            } else {
                Route::redirect(Route::url('photo'));
            }
        }

        $this->view->render('index_upload', [
            'title' => 'Upload',
            'error' => null,
        ]);
    }
}