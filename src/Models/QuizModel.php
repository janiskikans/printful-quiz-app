<?php


namespace Quiz\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class QuizModel
 * @package Quiz\Models
 * @property int $id
 * @property string $title
 *
 * @property QuestionModel[] $questions
 * @property UserAnswerModel[] $userAnswers
 */
class QuizModel extends BaseModel
{

    /**
     * @var string $table
     */
    public $table = 'quizzes';

    /**
     * @return HasMany
     */
    public function questions(): HasMany
    {
        return $this->hasMany(QuestionModel::class, 'quiz_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function userAnswers(): HasMany
    {
        return $this->hasMany(UserAnswerModel::class, 'quiz_id', 'id');
    }
}

//    /**
//     * @var int $id
//     */
//    public $id;
//
//    /**
//     * @var string $title
//     */
//    public $title;
//
//    public static function fromArray(array $data = [])
//    {
//        $quiz = new QuizModel();
//
//        foreach ($data as $property => $value) {
//            if (property_exists($quiz, $property)) {
//                $quiz->$property = $value;
//            }
//        }
//
//        return $quiz;
//    }