<?php


namespace app\core;


class View
{
    protected $template = 'default';

    /**
     * @param string|null $template
     */
    public function __construct(string $template = null)
    {
        if(!is_null($template)){
            $this->template = $template;
        }
    }

    /**
     *
     * @param string $viewName
     * @param array $params
     * @return void
     */
    public function render(string $viewName, array $params = []) : void
    {
        extract($params);
        include_once $this->getTemplatePath();
    }

    /**
     * @return string
     */
    protected function getViewsDir() : string
    {
       // return 'app' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR;
        return dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR;
    }

    /**
     * @return string
     */
    protected function getTemplatePath() : string
    {
        return $this->getViewsDir() . 'templates' . DIRECTORY_SEPARATOR . $this->template . '.php';
    }

    /**
     * @param string $view
     * @return string
     */
    protected function getViewPath(string $view) : string
    {
        return $this->getViewsDir() . 'pages' . DIRECTORY_SEPARATOR . $view . '_page.php';
    }
}