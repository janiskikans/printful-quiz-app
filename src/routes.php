<?php

use Quiz\Controllers\AuthController;
use Quiz\Controllers\IndexController;
use Quiz\Controllers\QuizController;
use Quiz\Route;

return array(
    '/' => new Route(IndexController::class),
    '/about' => new Route(IndexController::class, 'about'),
    '/register' => new Route(AuthController::class, 'register'),
    '/registerPost' => new Route(AuthController::class, 'registerPost'),
    '/login' => new Route(AuthController::class, 'login'),
    '/loginPost' => new Route(AuthController::class, 'loginPost'),
    '/logout' => new Route(AuthController::class, 'logout'),
    '/quiz/start' => new Route(QuizController::class, 'start'),
    '/quiz/next-question' => new Route(QuizController::class, 'nextQuestion'),
);