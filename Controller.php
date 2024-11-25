<?php

class Mysql
{
    public function getData()
    {
        return 'some data from database';
    }
}

interface AdapterInterface
{
    public function getData();
}

class Adapter implements AdapterInterface
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

    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    function getData()
    {
        $this->adapter->getData();
    }
}
