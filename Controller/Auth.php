<?php

namespace Controller;

class Auth extends Controller
{
    function login()
    {
        if (!$this->validate()) {
            echo $this->json(["error" => 'User data validation failed']);
        } else {
            //here we check data in user, if we have user then we return token
            echo $this->json(["data" => ['token' => $this->tokenGenerate()]]);
        }
    }

    function register()
    {
        if (!$this->validate()) {
            echo $this->json(["error" => 'User data validation failed']);
        } else {
            //here we save data in database
            echo $this->json(["data" => 'success']);
        }
    }

    function tokenGenerate()
    {
        return md5(time());
    }

    function validate()
    {
        if (empty($_GET['password']) || empty($_GET['login'])) {
            return false;
        } else {
            return true;
        }
    }
}
