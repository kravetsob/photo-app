<?php

include_once '..' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'config.php';
include_once '..' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'cred.php';

spl_autoload_register(function ($className){
    $classPath = '../' . str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';
    if(file_exists($classPath)){
        include_once $classPath;
        return true;
    }
    return false;
});

\app\core\Route::init();