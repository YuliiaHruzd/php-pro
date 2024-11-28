<?php

class LuxCar implements CarInterface
{
    function getModel()
    {
        return "LuxCar";
    }

    function getPrice()
    {
        return 10000;
    }
}
