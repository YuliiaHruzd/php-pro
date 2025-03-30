<?php

namespace Route;

use Controller\Error;
use Controller\Controller;

class Router
{
    public function init($routes)
    {
        $requestUri =  substr($_SERVER["PATH_INFO"], 1);
        $part = explode("/", $requestUri);
        $array = preg_replace('/(\d+)/i', ':d', $requestUri);
        $parameters = array_filter($part, function($v, $k) {
            return is_numeric($v);
        }, ARRAY_FILTER_USE_BOTH);

        if (!array_key_exists($array , $routes)) {
            $route = $routes['default'];
            $parameters = null;
        } else {
            $route = $routes[$array];
            $requestMethod = $_SERVER['REQUEST_METHOD'];


            if ($requestMethod !== $route['method']) {
                $route = $routes['default'];
                $parameters = ['Request method does not match'];
            }
        }

        $className = 'Controller\\' . $route['className'];

        if (!class_exists(Controller::class)) {
            (new Error())->index(['Base Controller class not found']);
        } elseif (!class_exists($className)) {
            (new Error())->index(['Controller class not found' ]);
        } else {
            $obj = new $className();

            $obj->{$route['action']}(...$parameters);
        }
    }
}
