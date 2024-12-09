<?php

namespace Controller;

class Controller
{
    public function __call($name, $arguments) {
        if (method_exists($this, $name)) {
            $this->$name();
        } else {
            (new Error())->index('Action not found');
        }
    }

    function json($data)
    {
        return json_encode($data);
    }
}
