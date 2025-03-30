<?php

spl_autoload_register(function ($class) {
    $class = str_replace('\\', '/', $class);
    $file = __DIR__ . '/' . $class . '.php';

    if (!file_exists($file)) {
        throw new Exception("Class '$class' not found");
    }

    require_once $file;
});

use Route\Route;
use Route\Router;

$route = new Route();
$router = new Router();
$router->init($route->getRoutes());
