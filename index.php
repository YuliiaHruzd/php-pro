<?php

spl_autoload_register(function ($class) {
    $class = str_replace('\\', '/', $class);
    $file = __DIR__ . '/' . $class . '.php';

    if (!file_exists($file)) {
        throw new Exception("Class '$class' not found");
    }

    require_once $file;
});

use Response\Data;
use Request\Data as Request;

$test = new Request(new Data());
