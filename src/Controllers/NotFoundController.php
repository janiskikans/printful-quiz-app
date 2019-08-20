<?php


namespace Quiz\Controllers;


class NotFoundController extends BaseController
{

    /**
     * @return string
     */
    public function index()
    {
        return $this->view('404page');
    }
}