<?php


namespace Quiz\Controllers;


class NotFoundController extends BaseController
{

    public function index()
    {
//        echo 'Route not found';
        return $this->view('404page');
    }
}