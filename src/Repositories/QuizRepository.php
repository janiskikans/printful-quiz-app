<?php


namespace Quiz\Repositories;

use Quiz\Models\QuizModel;

/**
 * Class QuizRepository
 * @package Quiz\Repositories
 * @method QuizModel one($conditions = [])
 * @method QuizModel[] all($conditions = [])
 * @method QuizModel create(array $data): Model
 */
class QuizRepository extends BaseRepository
{

    /**
     * @return string
     */
    protected function getModelClass()
    {
        return QuizModel::class;
    }
}