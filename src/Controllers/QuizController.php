<?php


namespace Quiz\Controllers;


use Exception;
use Illuminate\Support\Arr;
use Quiz\ActiveUser;
use Quiz\Services\QuizService;
use Quiz\Session;

class QuizController extends BaseController
{

    /** @var QuizService $quizService */
    private $quizService;

    public function __construct()
    {
        $this->quizService = new QuizService;

        parent::__construct();
    }

    public function quizList()
    {
        $quizData = [];

        if (ActiveUser::isLoggedIn()) {
            try {
                $quizData = $this->quizService->getQuizRcpData();
            } catch (Exception $exception) {
                die($exception->getMessage());
            }
        }

        return $this->view('quiz-list', ['quizData' => $quizData]);
    }

    public function start()
    {
        $userId = Session::getInstance()->getLoggedInUserId();

        $quizId = Arr::get($_POST, 'quizId');

        try {
            $this->quizService->start($userId, $quizId);
            $question = $this->quizService->getNextQuestion();

            $questionData = $this->quizService->getQuizQuestionRcpData($question);
        } catch (\Exception $exception) {
            return json_encode([
                'error' => $exception->getMessage(),
            ]);
        }

        return json_encode([
            'questionData' => $questionData,
        ]);
    }

    public function nextQuestion()
    {
        $answerId = Arr::get($_POST, 'answerId');

        try {
            $this->quizService->saveAnswer($answerId);
            $question = $this->quizService->getNextQuestion();

            if ( ! $question) {
                $resultData = $this->quizService->getResultData();

                return json_encode([
                    'resultData' => $resultData,
                ]);
            }

            $questionData = $this->quizService->getQuizQuestionRcpData($question);

        } catch (\Exception $exception) {
            return json_encode([
                'error' => $exception->getMessage(),
            ]);
        }

        return json_encode([
            'questionData' => $questionData,
        ]);

    }

    public function quizCreate()
    {
        return $this->view('quiz-create');
    }

    public function quizCreationStart()
    {
        $quizTitle = Arr::get($_POST, 'quizTitle');

        try {
            $newQuizId = $this->quizService->saveNewQuiz($quizTitle);
        } catch (\Exception $exception) {
            return json_encode([
                'error' => $exception->getMessage(),
            ]);
        }

        return json_encode([
            'newQuizId' => $newQuizId,
            'newQuizTitle' => $quizTitle,
        ]);
    }
}