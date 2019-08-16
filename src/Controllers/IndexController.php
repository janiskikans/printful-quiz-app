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
        $attemptData = [];

        if (ActiveUser::isLoggedIn()) {
            $activeUser = ActiveUser::getLoggedInUser();
            $activeUserId = $activeUser->id;

            try {
                $quizData = $this->quizService->getQuizRcpData();
                $attemptData = $this->quizService->getAllAttemptsByUserIdRcpDataWithLimit($activeUserId, 3);
            } catch (Exception $exception) {
                die($exception->getMessage());
            }
        }

        return $this->view('home', ['quizData' => $quizData, 'attemptData' => $attemptData]);
    }

    public function about()
    {
        return $this->view('about');
    }

}