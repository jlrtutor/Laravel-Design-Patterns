<?php

namespace App\Factories;

use App\Contracts\VehicleInterface;
use App\Models\CreationalFactoryBike;
use App\Models\CreationalFactoryCar;
use http\Exception\InvalidArgumentException;

class VehicleFactory
{
    const TYPE_CAR = 'CAR';
    const TYPE_BIKE = 'BIKE';

    public function create(string $vehicleType): VehicleInterface
    {
        switch ($vehicleType) {
            case self::TYPE_CAR:
                return new CreationalFactoryCar();

            case self::TYPE_BIKE:
                return new CreationalFactoryBike();
        }

        throw new InvalidArgumentException("The vehicleType you requested doesn't exist");
    }
}
