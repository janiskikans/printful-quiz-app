<?php


namespace Quiz\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class AttemptModel
 * @package Quiz\Models
 * @property int $id
 * @property int $user_id
 * @property int $quiz_id
 *
 * @property UserModel $user
 * @property QuizModel $quiz
 * @property UserAnswerModel[] $userAnswers
 */
class AttemptModel extends BaseModel
{

    /** @var array */
    protected $guarded = [];

    /** @var string $table */
    protected $table = 'attempts';

    /**
     * @return HasOne
     */
    public function user()
    {
        return $this->hasOne(UserModel::class, 'id', 'user_id');
    }

    /**
     * @return HasOne
     */
    public function quiz()
    {
        return $this->hasOne(QuizModel::class, 'id', 'quiz_id');
    }

    /**
     * @return HasMany
     */
    public function userAnswers()
    {
        return $this->hasMany(UserAnswerModel::class, 'attempt_id', 'id');
    }
}