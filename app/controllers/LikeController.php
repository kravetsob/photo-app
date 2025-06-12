<?php
//
//namespace app\controllers;
//
//use app\core\View;
//use app\core\Route;
//use app\models\LikeModel;
//class LikeController
//{
//    public function __construct()
//    {
//        $this->view = new View();
//        $this->model = new LikeModel();
//    }
//    public function index() : void
//    {
//        $this->view->render('index_index', [
//            'title' => 'Likes',
//            'likes' => $this->model->all(),
//        ]);
//    }
//    public function create() : void
//    {
//        $this->view->render('index_create', [
//            'title' => 'Create new like',
//        ]);
//        Route::redirect(Route::url('task'));
//    }
//}


namespace app\controllers;

use app\core\View;
use app\core\Route;
use app\models\LikeModel;

class LikeController
{
    private LikeModel $model; //буде містити об'єкт моделі LikeModel, який виконує запити до БД.
    private View $view; //буде використовуватися для відображення HTML-сторінок.

    public function __construct()
    {
        $this->model = new LikeModel();
        $this->view = new View();
    }

    /**
     * Показати всі лайки
     * @return void
     */
    public function index(): void
    {
        $likes = $this->model->allLikes();

        $this->view->render('likes_index', [
            'title' => 'Likes Page',
            'likes' => $likes,
        ]);
    }

    /**
     * Додати лайк до картинки
     * @param int $imageId
     * @return void
     */
    public function like(int $imageId): void
    {
        $this->model->addLike($imageId);
        Route::redirect(Route::url('likes')); // або на іншу сторінку
    }
}