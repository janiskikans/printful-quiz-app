<?php

use Illuminate\Support\Arr;
use Quiz\Controllers\NotFoundController;
use Quiz\Route;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/bootstrap.php';

/** @var Route[] $routes */
$routes = require_once __DIR__ . '/../src/routes.php';

$parsedUrl = parse_url($_SERVER['REQUEST_URI']);
$path = $parsedUrl['path'];

/** @var Route $route */
$route = Arr::get($routes, $path, new Route(NotFoundController::class));
$route->handle();
