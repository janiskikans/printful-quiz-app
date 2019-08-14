<?php


namespace Quiz\Controllers;

use Exception;
use Quiz\Services\UserService;
use Quiz\Session;

class AuthController extends BaseController
{

    protected $registrationValidationRules = [
        'password' => 'required|confirmed|min:8',
        'email' => 'required|unique:users',
        'name' => 'required'
    ];

    public function register()
    {
        return $this->view('register');
    }

    public function registerPost()
    {
        $data = $this->input;

        if ($data['password'] !== $data['password_confirmation']) {
            Session::getInstance()->addError('Passwords do not match!');
            redirect('/register');
        }

        if (strlen($data['password']) < 8) {
            Session::getInstance()->addError('Password must be at least 8 characters long! Please try making it longer.');
            redirect('/register');
        }

        $userService = new UserService();

        try {
            $userService->registerUser($data);
        } catch (Exception $exception) {
            Session::getInstance()->addError($exception->getMessage());
            redirect('/register');
        }

        Session::getInstance()->addMessage('Registration successful!');
        redirect();
    }

    public function loginPost()
    {
        $data = $this->input;

        $userService = new UserService();

        try {
            $userService->attemptLogin($data);
//            Session::getInstance()->addMessage('Login successful!');
            redirect();
        } catch (Exception $exception) {
            Session::getInstance()->addError($exception->getMessage());
            redirect('/login');
        }
    }

    public function login()
    {
        return $this->view('login');
    }

    public function logout()
    {
        Session::getInstance()->delete(Session::LOGGED_IN_USER);
        redirect();
    }
}