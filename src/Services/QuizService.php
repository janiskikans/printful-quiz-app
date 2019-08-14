<?php


namespace Quiz\Services;


use Quiz\Models\AnswerModel;
use Quiz\Models\QuestionModel;
use Quiz\Models\QuizModel;
use Quiz\Repositories\AnswerRepository;
use Quiz\Repositories\QuestionRepository;
use Quiz\Repositories\QuizRepository;
use Quiz\Repositories\UserAnswerRepository;
use Quiz\Repositories\UserRepository;
use Quiz\Session;

class QuizService
{
    /** @var string */
    private const SESSION_KEY_CURRENT_QUIZ_ID = 'currentQuizId';

    /** @var string */
    private const SESSION_KEY_QUESTIONS_ANSWERED = 'questionsAnswered';

    /** @var QuizRepository $repository */
    private $repository;

    /** @var UserRepository $userRepository */
    private $userRepository;

    /** @var Session $session */
    private $session;

    /** @var QuestionRepository */
    private $questionRepository;

    /** @var AnswerRepository */
    private $answerRepository;

    /** @var UserAnswerRepository */
    private $userAnswerRepository;

    public function __construct(
        ?QuizRepository $repository = null,
        QuestionRepository $questionRepository = null,
        AnswerRepository $answerRepository = null,
        UserAnswerRepository $userAnswerRepository = null,
        UserRepository $userRepository = null,
        Session $session = null
    ) {
        $this->repository = $repository ?? new QuizRepository();
        $this->questionRepository = $questionRepository ?? new QuestionRepository();
        $this->userRepository = $userRepository ?? new UserRepository();
        $this->session = $session ?? Session::getInstance();
        $this->answerRepository = $answerRepository ?? new AnswerRepository();
        $this->userAnswerRepository = $userAnswerRepository ?? new UserAnswerRepository();
    }

    /**
     * @return array
     * RCP - Remote Procedure Data.
     */
    public function getQuizRcpData()
    {
        $quizzes = $this->repository->all();

        $quizData = [];

        foreach ($quizzes as $quiz) {
            $quizData[] = [
                'id' => $quiz->id,
                'title' => $quiz->title,
            ];
        }

        return $quizData;
    }

    /**
     * @param int $userId
     * @param int $quizId
     * @return QuizModel
     * @throws \Exception
     */
    public function start(int $userId, int $quizId)
    {
        $userExists = $this->userRepository->userExists(['id' => $userId]);

        if ( ! $userExists) {
            throw new \Exception('Something went wrong! User was not found.');
        }

        $quiz = $this->getQuizById($quizId);

        $this->session->set(self::SESSION_KEY_CURRENT_QUIZ_ID, $quizId);
        $this->session->set(self::SESSION_KEY_QUESTIONS_ANSWERED, 0);

        return $quiz;
    }

    /**
     * @param QuestionModel $question
     * @return array
     */
    public function getQuizQuestionRcpData(QuestionModel $question)
    {
        $answerData = [];

        foreach ($question->answers as $answer) {
            $answerData[] = $this->getAnswerRcpData($answer);
        }

        return [
            'id' => $question->id,
            'text' => $question->text,
            'answers' => $answerData
        ];
    }

    /**
     * @param AnswerModel $answer
     * @return array
     */
    private function getAnswerRcpData(AnswerModel $answer)
    {
        return [
            'id' => $answer->id,
            'text' => $answer->text,
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|QuestionModel|null
     * @throws \Exception
     */
    public function getNextQuestion()
    {
        $quizId = $this->session->get(self::SESSION_KEY_CURRENT_QUIZ_ID);

        $quiz = $this->getQuizById($quizId);

        $questionsAnswered = $this->session->get(self::SESSION_KEY_QUESTIONS_ANSWERED, -1);

        if ($questionsAnswered < 0) {
            throw new \Exception('Questions answered not set');
        }

        $question = $this->questionRepository->getQuestionByQuizIdAndOffset($quiz->id, $questionsAnswered);

        return $question;
    }

    /**
     * @param int $quizId
     * @return QuizModel
     * @throws \Exception
     */
    public function getQuizById(int $quizId): QuizModel
    {
        $quiz = $this->repository->one(['id' => $quizId]);

        if ( ! $quiz) {
            throw new \Exception("Could not find quiz with id #$quizId");
        }
        return $quiz;
    }

    public function saveAnswer($answerId)
    {
        $answer = $this->answerRepository->one(['id' => $answerId]);

        if ( ! $answer) {
            throw new \Exception("Could not find answer with id #$answerId");
        }

        $currentQuizId = $this->session->get(self::SESSION_KEY_CURRENT_QUIZ_ID);
        $userId = $this->session->getLoggedInUserId();

        $this->userAnswerRepository->create([
            'quiz_id' => $currentQuizId,
            'question_id' => $answer->question_id,
            'answer_id' => $answer->id,
            'user_id' => $userId,
        ]);

        $questionsAnswered = $this->session->get(self::SESSION_KEY_QUESTIONS_ANSWERED);
        $questionsAnswered++;
        $this->session->set(self::SESSION_KEY_QUESTIONS_ANSWERED, $questionsAnswered);
    }

}