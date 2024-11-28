<?php

class CarFactory
{
    function create($type) {
        return match ($type) {
            'eco' => new EcoCar(),
            'lux' => new LuxCar(),
            'standard' => new StandardCar(),
        };
    }
}
