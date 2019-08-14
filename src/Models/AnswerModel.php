<?php


namespace Quiz\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class AnswerModel
 * @package Quiz\Models
 * @property int $id
 * @property string $text
 * @property bool $is_correct
 * @property int $question_id
 *
 * @property QuestionModel $question
 * @property UserAnswerModel[] $userAnswers
 */
class AnswerModel extends BaseModel
{

    public $table = 'answers';

    /**
     * @return HasOne
     */
    public function question(): HasOne
    {
        return $this->hasOne(QuestionModel::class, 'id', 'question_id');
    }

    /**
     * @return HasMany
     */
    public function userAnswers(): HasMany
    {
        return $this->hasMany(UserAnswerModel::class, 'answer_id', 'id');
    }
}