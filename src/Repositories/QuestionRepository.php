<?php


namespace Quiz\Repositories;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Quiz\Models\QuestionModel;

class QuestionRepository extends BaseRepository
{

    /**
     * @return string
     */
    protected function getModelClass()
    {
        return QuestionModel::class;
    }

    /**
     * @param int $quizId
     * @param int $offset
     * @return Builder|Model|object|QuestionModel|null
     */
    public function getQuestionByQuizIdAndOffset(int $quizId, int $offset)
    {
        return QuestionModel::query()
            ->where(['quiz_id' => $quizId])
            ->offset($offset)
            ->first();
    }
}