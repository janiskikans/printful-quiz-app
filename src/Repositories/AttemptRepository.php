<?php


namespace Quiz\Repositories;


use Illuminate\Database\Eloquent\Model;
use Quiz\Models\AttemptModel;

/**
 * Class AttemptRepository
 * @package Quiz\Repositories
 * @method AttemptModel create(array $data) : Model
 * @method AttemptModel[] all($conditions = [])
 * @method AttemptModel|null one(array $conditions = []) : ?Model
 */
class AttemptRepository extends BaseRepository
{

    /**
     * @return string
     */
    protected function getModelClass()
    {
        return AttemptModel::class;
    }

    public function getAttemptListByUserIdWithLimit($userId, $limit)
    {
        return AttemptModel::query()
            ->where(['user_id' => $userId])
            ->take($limit)
            ->orderBy('quiz_taken_at', 'desc')
            ->get();
    }

    public function getCompletedQuizListByUserId(int $userId) {
        return AttemptModel::query()
            ->select('attempt_id', 'user_id', 'quiz_id', 'is_correct')
            ->leftJoin('user_answers', 'attempts.id', '=', 'user_answers.attempt_id')
            ->leftJoin('answers', 'user_answers.answer_id', '=', 'answers.id')
            ->where(['user_id' => $userId])
            ->get();
    }
}