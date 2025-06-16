<?php

namespace app\controllers;
use app\core\View;
use app\core\Route;
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

    /**
     * PhotoController constructor
     */
    public function __construct()
    {
        $this->view = new View();
        $this->photoModel = new PhotoModel();
        $this->photoService = new PhotoService();
        $this->page = new Page();
    }

    /**
     * Displays the homepage with a paginated list of photos.
     * @return void
     */
    public function index()
    {
        $page = $this->page->getCurrent();
        $nextPage = $this->page->next();
        $prevPage = $this->page->prev();
        $pageCount = $this->page->getAll();
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
            if ($fileName !== null) {
                $this->photoModel->upload($fileName);
            }
            //TODO повернутися на завантажене зображення
            Route::redirect(Route::url('photo'));
        }

        $this->view->render('index_upload', [
            'title' => 'Upload',
        ]);
    }
}