<?php
namespace app\core;

class Route
{
    const DEFAULT_CONTROLLER = 'photo';
    const DEFAULT_ACTION = 'index';

    /**
     * Routing
     * @return void
     */
    static public function init() : void
    {
        $controllerName = self::DEFAULT_CONTROLLER;
        $actionName = self::DEFAULT_ACTION;
        if(isset($_GET['controller'])){
            $controllerName = strtolower($_GET['controller']);
        }
        if(isset($_GET['action'])){
            $actionName = strtolower($_GET['action']);
        }
        $controllerClass = 'app\controllers\\' . ucfirst($controllerName) . 'Controller';
        if(!class_exists($controllerClass)){
            self::notFound();
        }
        $controller = new $controllerClass();
        if(!method_exists($controller, $actionName)){
            self::notFound();
        }
        $controller->$actionName();
    }

    /**
     * Generates a URL
     * @param string $controller
     * @param string $action
     * @param array $params
     * @return string
     */
    static public function url(string $controller = self::DEFAULT_CONTROLLER, string $action = self::DEFAULT_ACTION, array $params = []) : string
    {
        $getParams = '';
        foreach ($params as $param => $value){
            $getParams .= $param . '=' . $value . '&';
        }
        return '/?controller=' . strtolower($controller) . '&action=' . strtolower($action) . '&' . $getParams;
    }

    /**
     * Sends a 404 response and stops script execution
     * @return never
     */
    static public function notFound() : never
    {
        http_response_code(404);
        exit();
    }

    /**
     * This function exits for redirect to another page
     * @param string|null $url
     * @return never
     */
    static public function redirect(string $url = null) : never
    {
        header('Location: ' . $url ?? '/');

    }
}