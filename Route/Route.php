<?php

namespace Route;

class Route
{
    function getRoutes()
    {
        return [
            'test/:d' => ['className' => 'Main', 'action' => 'index', 'method' => 'GET'],
            'test/:d/test/:d' => ['className' => 'Main', 'action' => 'index', 'method' => 'GET'],
            '' => ['className' => 'Main', 'action' => 'index', 'method' => 'GET'],
            'default' => ['className' => 'Error', 'action' => 'index'],
        ];
    }
}
