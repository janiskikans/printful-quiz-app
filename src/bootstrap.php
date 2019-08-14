<?php

use Illuminate\Database\Capsule\Manager as Capsule;

// Globals.
defined('DS') || define('DS', DIRECTORY_SEPARATOR);
defined('VIEW_BASE_FOLDER') || define('VIEW_BASE_FOLDER', __DIR__ . DS . 'views');
defined('TEMPLATE_BASE_FOLDER') || define('TEMPLATE_BASE_FOLDER', __DIR__ . DS . 'templates');

// Database.
$capsule = new Capsule;

// Helper functions.
require_once 'functions.php';

$capsule->addConnection([
    'driver' => 'mysql',
    'host' => 'localhost',
    'database' => 'quizzes',
    'username' => 'homestead',
    'password' => 'secret',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();