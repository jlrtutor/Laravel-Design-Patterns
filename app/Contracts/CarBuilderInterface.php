<?php

namespace App\Contracts;

use App\Builders\CarBuilder;
use App\Models\Car;

interface CarBuilderInterface
{
    public function setBrand(string $brand): CarBuilder;
    public function setModel(string $model): CarBuilder;
    public function setColor(string $color): CarBuilder;
    public function get(): Car;
}
