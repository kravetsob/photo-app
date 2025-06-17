<?php

namespace app\controllers;

use app\core\Route;
use app\models\LikeModel;
use app\core\Page;

class LikeController
{
    /**
     * @var LikeModel
     */
    private LikeModel $model; //will contain a LikeModel object that performs queries to the database.

    /**
     * LikeController constructor.
     */
    public function __construct()
    {
        $this->model = new LikeModel();
    }

    /**
     * Add a like to the photo
     * @param int $imageId
     * @return void
     */
    public function like(): void
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $imageId = $_POST['imageId'];
            $this->model->add($imageId);
            Route::redirect(Page::currentPage());
        }
    }
}