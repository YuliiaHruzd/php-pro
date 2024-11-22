<?php

$url = substr($_SERVER['REQUEST_URI'], 1);

$routes = getRoutes();

if (!array_key_exists($url , $routes)) {
    $route = $routes['default'];
} else {
    $route = $routes[$url];
}

$obj = new $route['className']();

$obj->{$route['method']}();


function getRoutes()
{
    return [
        '' => ['className' => 'Main', 'method' => 'index'],
        'about' => ['className' => 'About', 'method' => 'index'],
        'gallery' => ['className' => 'Gallery', 'method' => 'index'],
        'default' => ['className' => 'Class404', 'method' => 'index'],
    ];
}

class Init
{
    public function __call($name, $arguments) {
        if(method_exists($this, $name)){
            $this->$name();
        } else {
            call_user_func(['Class404', 'index']);
        }
    }
}

class Main extends Init
{
    function index()
    {
        echo 'this is class ' . get_class($this);
    }
}

class About extends Init
{
    function index()
    {
        echo 'this is class ' . get_class($this);
    }
}

class Gallery extends Init
{
    function index()
    {
        echo 'this is class ' . get_class($this);
    }
}

class Class404 extends Init
{
    function index()
    {
        echo 'this is class ' . get_class($this);
    }
}
