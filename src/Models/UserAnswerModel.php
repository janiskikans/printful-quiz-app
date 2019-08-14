<?php


namespace Quiz\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class UserAnswerModel
 * @package Quiz\Models
 * @property int $id
 * @property int $user_id
 * @property int $quiz_id
 * @property int $question_id
 * @property int $answer_id
 *
 * @property UserModel $user
 * @property QuizModel $quiz
 * @property QuestionModel $question
 * @property AnswerModel $answer
 */
class UserAnswerModel extends BaseModel
{

    /**
     * @var string $table
     */
    public $table = 'user_answers';

    /** @var array  */
    public $guarded = [];

    /**
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(UserModel::class, 'id', 'user_id');
    }

    /**
     * @return HasOne
     */
    public function quiz(): HasOne
    {
        return $this->hasOne(QuizModel::class, 'id', 'quiz_id');
    }

    /**
     * @return HasOne
     */
    public function question(): HasOne
    {
        return $this->hasOne(QuestionModel::class, 'id', 'question_id');
    }

    /**
     * @return HasOne
     */
    public function answer(): HasOne
    {
        return $this->hasOne(AnswerModel::class, 'id', 'answer_id');
    }
}