<?php


namespace Quiz\Controllers;

use Quiz\View;

abstract class BaseController
{

    /** @var string $template */
    protected $template = 'default';

    /** @var array  */
    protected $input;

    public function __construct()
    {
        $this->input = $_POST ?? [];
    }

    /**
     * @param string $viewName
     * @param array $params
     * @return string $content
     */
    protected function view(string $viewName, array $params = []): string
    {
        $view = $this->getView($viewName);

        return $view->render($params);
    }

    /**
     * @param string $viewName
     * @return View
     */
    protected function getView(string $viewName): View
    {
        return new View($viewName, $this->template);
    }
}