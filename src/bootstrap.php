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
require_once 'config.php';

$capsule->addConnection([
    'driver' => DB_DRIVER,
    'host' => DB_HOST,
    'database' => DB_DATABASE,
    'username' => DB_USERNAME,
    'password' => DB_PASSWORD,
    'charset' => DB_CHARSET,
    'collation' => DB_COLLATION,
    'prefix' => DB_PREFIX,
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();