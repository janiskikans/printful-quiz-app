<?php


namespace Quiz\Repositories;

use Quiz\Models\UserModel;


/**
 * @method UserModel|null one($conditions = [])
 * @method UserModel[] all($conditions = [])
 * @method UserModel create(array $data) : Model
 */
class UserRepository extends BaseRepository
{

    /** @var UserModel[] */
    protected $users = [];

    protected function getModelClass()
    {
        return UserModel::class;
    }

    /**
     * @param UserModel $userToSave
     * @return UserModel
     */
    public function saveUser(UserModel $userToSave): UserModel
    {
        $user = new UserModel();

        $user->name = $userToSave->name;
        $user->email = $userToSave->email;
        $user->password = $userToSave->password;

        $user->save();

        return $user;
    }

    /**
     * @param array $conditions
     * @return bool
     */
    public function userExists(array $conditions = []): bool
    {
        return UserModel::query()->where($conditions)->exists();
    }
}