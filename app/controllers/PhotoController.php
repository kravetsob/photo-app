<?php

namespace app\controllers;
use app\core\View;
use app\core\Route;
//TODO Винести функціонал Page з Index і прибрати PhotoModel
use app\models\PhotoModel;
use app\core\Page;
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
    protected Page $page;
    protected int $photosAmount;
    /**
     * PhotoController constructor
     */
    public function __construct()
    {
        $this->view = new View();
        $this->photoModel = new PhotoModel();
        $this->photoService = new PhotoService();
        $this->photosAmount = $this->photoModel->count();
        $this->page = new Page($this->photosAmount);
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
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $fileName = $this->photoService->store($_FILES['image']);
            if (is_string($fileName)) {
                // Error - back to upload form
                $this->view->render('index_upload', [
                    'title' => 'Upload',
                    'error' => $fileName,
                ]);
                return;
            }
            if ($fileName !== null) {
                $this->photoModel->upload($fileName);
            }

            $photoId = $this->photoModel->lastId();
            $pageCount = $this->page->getAll();
            if ($this->photosAmount % 5 === 0) {
                $pageCount++;
            }
            Route::redirect(Route::url('photo', 'index') . 'page=' . $pageCount . '#photo' . $photoId);
        }

        $this->view->render('index_upload', [
            'title' => 'Upload',
        ]);
    }
}