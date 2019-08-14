<?php


namespace Quiz\Repositories;


use Quiz\Models\AnswerModel;

class AnswerRepository extends BaseRepository
{

    /**
     * @return string
     */
    protected function getModelClass()
    {
        return AnswerModel::class;
    }
}