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

    /**
     * @var Page
     */
    protected Page $page;

    /**
     * @var int
     */
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = $this->photoService->store($_FILES['image']);

            if (!$result['success']) {
                // якщо є помилки при збереженні файлу
                $this->view->render('index_upload', [
                    'title' => 'Upload',
                    'error' => $result['errors'],
                ]);
                return;
            }

            // у разі успіху завантажуємо файл до БД
            $this->photoModel->upload($result['filename']);

            //визначаємо ID фото, щоб повернутися до нього після завантаження
            $photoId = $this->photoModel->lastId();
            $pageCount = $this->page->getAll();

            if ($this->photosAmount % IMG_LIMIT === 0) {
                $pageCount++;
            }

            Route::redirect(Route::url('photo', 'index') . 'page=' . $pageCount . '#photo' . $photoId);
        }

        $this->view->render('index_upload', [
            'title' => 'Upload',
        ]);
    }
}