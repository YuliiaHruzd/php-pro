<?php

namespace Route;

class Route
{
    function getRoutes()
    {
        return [
            'test/:d' => ['className' => 'Main', 'action' => 'index', 'method' => 'GET'],
            'test/:d/test/:d' => ['className' => 'Main', 'action' => 'index', 'method' => 'GET'],
            'folder/index' => ['className' => 'Folder', 'action' => 'index', 'method' => 'GET'],
            'folder/create/:d' => ['className' => 'Folder', 'action' => 'create', 'method' => 'GET'],
            'folder/update/from/:d/to/:d' => ['className' => 'Folder', 'action' => 'update', 'method' => 'GET'],
            'folder/show/:d' => ['className' => 'Folder', 'action' => 'show', 'method' => 'GET'],
            'folder/delete/:d' => ['className' => 'Folder', 'action' => 'delete', 'method' => 'GET'],
            '' => ['className' => 'Main', 'action' => 'index', 'method' => 'GET'],
            'default' => ['className' => 'Error', 'action' => 'index'],
        ];
    }
}
