<?php

namespace Quiz\Models;


use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class UserModel
 * @package Quiz\Models
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 *
 * @property UserAnswerModel[] $userAnswers
 */
class UserModel extends BaseModel
{

    /**
     * @var string $table
     */
    public $table = 'users';

    /**
     * @var array $fillable
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * @return HasMany
     */
    public function userAnswers(): HasMany
    {
        return $this->hasMany(UserAnswerModel::class, 'user_id', 'id');
    }

    /**
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = password_hash($value, PASSWORD_DEFAULT);
    }
}