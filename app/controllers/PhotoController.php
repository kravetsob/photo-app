<?php

namespace app\controllers;
use app\core\View;

class PhotoController
{
    protected $view;
    public function __construct(){
        $this->view = new View();
    }
    public function index()
    {
        $this->view->render('index_index', [
            'title' => 'Home',
        ]);
    }
}