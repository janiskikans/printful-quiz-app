<?php


namespace Quiz\Services;

use DateTime;
use Quiz\Exceptions\QuizException;
use Quiz\Models\AnswerModel;
use Quiz\Models\QuestionModel;
use Quiz\Models\QuizModel;
use Quiz\Repositories\AnswerRepository;
use Quiz\Repositories\AttemptRepository;
use Quiz\Repositories\QuestionRepository;
use Quiz\Repositories\QuizRepository;
use Quiz\Repositories\UserAnswerRepository;
use Quiz\Repositories\UserRepository;
use Quiz\Session;

class QuizService
{
    /** @var string */
    private const SESSION_KEY_CURRENT_ATTEMPT_ID = 'currentAttemptId';

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

    /** @var AttemptRepository */
    private $attemptRepository;

    public function __construct(
        ?QuizRepository $repository = null,
        QuestionRepository $questionRepository = null,
        AnswerRepository $answerRepository = null,
        UserAnswerRepository $userAnswerRepository = null,
        AttemptRepository $attemptRepository = null,
        UserRepository $userRepository = null,
        Session $session = null
    ) {
        $this->repository = $repository ?? new QuizRepository();
        $this->questionRepository = $questionRepository ?? new QuestionRepository();
        $this->userRepository = $userRepository ?? new UserRepository();
        $this->session = $session ?? Session::getInstance();
        $this->answerRepository = $answerRepository ?? new AnswerRepository();
        $this->userAnswerRepository = $userAnswerRepository ?? new UserAnswerRepository();
        $this->attemptRepository = $attemptRepository ?? new AttemptRepository();
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
            $questionCount = $this->questionRepository->count(['quiz_id' => $quiz->id]);

            $quizData[] = [
                'id' => $quiz->id,
                'title' => $quiz->title,
                'questionCount' => $questionCount,
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
            throw new QuizException('Something went wrong! User was not found.');
        }

        $quiz = $this->getQuizById($quizId);

        $currentTimestamp = new DateTime('now', new \DateTimeZone('Europe/Riga'));

        $attempt = $this->attemptRepository->create([
            'quiz_taken_at' => $currentTimestamp->format('Y-m-d H:i:s'),
            'user_id' => $userId,
            'quiz_id' => $quizId,
        ]);

        $this->session->set(self::SESSION_KEY_CURRENT_ATTEMPT_ID, $attempt->id);
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
        $attemptId = $this->session->get(self::SESSION_KEY_CURRENT_ATTEMPT_ID);

        $attempt = $this->getAttemptById($attemptId);

        $questionsAnswered = $this->session->get(self::SESSION_KEY_QUESTIONS_ANSWERED, -1);

        if ($questionsAnswered < 0) {
            throw new QuizException('Questions answered not set');
        }

        $question = $this->questionRepository->getQuestionByQuizIdAndOffset($attempt->quiz_id, $questionsAnswered);

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
            throw new QuizException("Could not find quiz with id #$quizId");
        }
        return $quiz;
    }

    public function saveAnswer($answerId)
    {
        $answer = $this->answerRepository->one(['id' => $answerId]);

        if ( ! $answer) {
            throw new QuizException("Could not find answer with id #$answerId");
        }

        $currentAttemptId = $this->session->get(self::SESSION_KEY_CURRENT_ATTEMPT_ID);

        $attempt = $this->getAttemptById($currentAttemptId);

        $this->userAnswerRepository->create([
            'attempt_id' => $attempt->id,
            'question_id' => $answer->question_id,
            'answer_id' => $answer->id,
        ]);

        $questionsAnswered = $this->session->get(self::SESSION_KEY_QUESTIONS_ANSWERED);
        $questionsAnswered++;
        $this->session->set(self::SESSION_KEY_QUESTIONS_ANSWERED, $questionsAnswered);
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getResultData()
    {
        $currentAttemptId = $this->session->get(self::SESSION_KEY_CURRENT_ATTEMPT_ID);
        $attempt = $this->getAttemptById($currentAttemptId);

        $correctAnswerCount = 0;
        $answeredQuestionList = array();

        foreach ($attempt->userAnswers as $userAnswer) {
            $correctAnswerCount += $userAnswer->answer->is_correct;

            $answeredQuestionList[$userAnswer->answer->id] = [
                'questionText' => $userAnswer->question->text,
                'answeredCorrectly' => $userAnswer->answer->is_correct
            ];

        }


        $this->session->delete(self::SESSION_KEY_CURRENT_ATTEMPT_ID);
        $this->session->delete(self::SESSION_KEY_QUESTIONS_ANSWERED);

        return [
            'correctAnswerCount' => $correctAnswerCount,
            'answeredQuestionList' => $answeredQuestionList
        ];
    }

    /**
     * @param $attemptId
     * @return \Quiz\Models\AttemptModel|null
     * @throws \Exception
     */
    public function getAttemptById($attemptId)
    {
        $attempt = $this->attemptRepository->one(['id' => $attemptId]);

        if ( ! $attempt) {
            throw new QuizException('Quiz has not been started!');
        }
        return $attempt;
    }

    /**
     * @param $userId
     * @return array|\Illuminate\Database\Eloquent\Collection|AttemptRepository[]
     */
    public function getAllAttemptsByUserIdRcpDataWithLimit($userId, $limit)
    {
        $attempts = $this->attemptRepository->getAttemptListByUserIdWithLimit($userId, $limit);

        $attemptData = [];

        foreach ($attempts as $attempt) {
            $attemptData[] = [
                'id' => $attempt->id,
                'quizTakenAt' => date('M d, h:i', strtotime($attempt->quiz_taken_at)),
                'userId' => $attempt->user_id,
                'quizId' => $attempt->quiz_id
            ];
        }

        return $attemptData;
    }
}