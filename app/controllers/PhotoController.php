<?php

namespace app\controllers;
use app\core\View;
use app\core\Route;
//TODO Винести функціонал Page з Index і прибрати PhotoModel
use app\models\PhotoModel;
use app\services\PhotoService;


class PhotoController
{
    /**
     * @var View
     */
    protected $view;

    /**
     * @var PhotoModel
     */
    protected $photoModel;

    /**
     * @var PhotoService
     */
    protected $photoService;

    /**
     * PhotoController constructor
     */
    public function __construct()
    {
        $this->view = new View();
        $this->photoModel = new PhotoModel();
        $this->photoService = new PhotoService();
    }

    /**
     * Displays the homepage with a paginated list of photos.
     * @return void
     */
    public function index(): void
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

    /**
     * Handles image upload requests.
     * @return void
     */
    public function upload(): void
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $result = $this->photoService->upload($_FILES['image']);

            if (is_string($result)) {
                // Error - back to upload form
                $this->view->render('index_upload', [
                    'title' => 'Upload',
                    'error' => $result,
                ]);
                return;
            }

            $photoId = $this->photoModel->lastId();

            $rowCount = $this->photoModel->count();
            $pageCount = ceil($rowCount / IMG_LIMIT);

            Route::redirect(Route::url('photo', 'index') . 'page=' . $pageCount . '#photo' . $photoId);
        }

        $this->view->render('index_upload', [
            'title' => 'Upload',
        ]);
    }
}