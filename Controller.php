<?php

class Mysql
{
    public function getData()
    {
        return 'some data from database';
    }
}

class Adapter
{
    private $mysql;
    public function __construct(Mysql $mysql)

    {
        $this->mysql = $mysql;
    }

    function getData()
    {
        $this->mysql->getData();
    }
}

class Controller
{
    private $adapter;

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
    }

    function getData()
    {
        $this->adapter->getData();
    }
}
