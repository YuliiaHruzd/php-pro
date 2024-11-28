<?php

class EcoCar implements CarInterface
{
    function getModel()
    {
        return "EcoCar";
    }

    function getPrice()
    {
        return 100;
    }
}
