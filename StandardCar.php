<?php

class StandardCar implements CarInterface
{
    function getModel()
    {
        return "StandardCar";
    }

    function getPrice()
    {
        return 1000;
    }
}
