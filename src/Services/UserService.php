<?php


namespace Quiz\Services;

use Exception;
use Quiz\Models\UserModel;
use Quiz\Repositories\UserRepository;
use Quiz\Session;

class UserService
{

    public $repository;

    public function __construct(?UserRepository $repository = null)
    {
        $this->repository = $repository ?? new UserRepository();
    }

    public function registerUser(array $data)
    {
        if (count(array_filter($data)) != count($data)) {
            throw new Exception('You must fill out all fields!');
        }

        if ($this->repository->userExists(['email' => $data['email']])) {
            throw new Exception('User already exists!');
        }

        return $this->repository->create($data);
    }

    public function attemptLogin(array $data)
    {
        $user = $this->repository->one(['email' => $data['email']]);

        /*if (!$this->repository->userExists(['email' => $data['email']])) {
            throw new Exception('Login email or password is not correct! Please try again.');
        }*/

        $userExists = (bool)$user;
        $isPasswordCorrect = password_verify($data['password'], $user->password ?? '');

        if (!$userExists || !$isPasswordCorrect) {
            throw new Exception('Login email or password is not correct! Please try again.');
        }

        $this->login($user);
    }

    protected function login(UserModel $user)
    {
        Session::getInstance()->setLoggedInUser($user);
    }
}