<?php

namespace Controller;

class Main extends Controller
{
    function index($id = null, $secondId = null)
    {
        echo $this->json(["data" => 'this is class ' . get_class($this)]);
    }
}
