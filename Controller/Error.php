<?php

namespace Controller;

class Error extends Controller
{
    function index($message = 'this page not found')
    {
        echo $this->json(["error" => $message]);
    }
}
