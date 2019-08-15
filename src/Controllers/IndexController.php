<?php

namespace Quiz\Controllers;

use Exception;
use Quiz\ActiveUser;
use Quiz\Services\QuizService;

class IndexController extends BaseController
{

    /** @var QuizService $quizService */
    private $quizService;

    public function __construct()
    {
        $this->quizService = new QuizService();

        parent::__construct();
    }

    public function index()
    {
        $quizData = [];

        if (ActiveUser::isLoggedIn()) {
            try {
                $quizData = $this->quizService->getQuizRcpData();
            } catch (Exception $exception) {
                die($exception->getMessage());
            }
        }

        return $this->view('home', ['quizData' => $quizData]);
    }

    public function about()
    {
        return $this->view('about');
    }

}