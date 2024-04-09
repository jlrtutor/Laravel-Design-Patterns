<?php

namespace App\Http\Controllers;

use App\Factories\VehicleFactory;

class CreationalFactory extends Controller
{
    public function index(): void
    {
        $carOutputMessage = 'The %s has brand %s and %d wheels.' . PHP_EOL;
        $car = (new VehicleFactory())->create(VehicleFactory::TYPE_CAR);
        echo sprintf(
            $carOutputMessage,
            VehicleFactory::TYPE_CAR,
            $car->getBrand(),
            $car->getWheels()
        );
        $bike = (new VehicleFactory())->create(VehicleFactory::TYPE_BIKE);
        echo sprintf(
            $carOutputMessage,
            VehicleFactory::TYPE_BIKE,
            $bike->getBrand(),
            $bike->getWheels()
        );
    }
}
