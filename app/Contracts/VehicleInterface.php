<?php

namespace App\Contracts;

interface VehicleInterface
{
    public function getBrand(): string;
    public function getWheels(): int;
}
