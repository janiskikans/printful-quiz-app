<?php


namespace Quiz;


use Quiz\Models\UserModel;

class ActiveUser
{

    /**
     * @return bool
     */
    public static function isLoggedIn(): bool
    {
        return !is_null(Session::getInstance()->getLoggedInUserId());
    }

    public static function getLoggedInUser(): ?UserModel
    {
        $userId = Session::getInstance()->getLoggedInUserId();

        /** @var UserModel $user */
        $user = UserModel::query()->where(['id' => $userId])->first();

        return $user;
    }
}