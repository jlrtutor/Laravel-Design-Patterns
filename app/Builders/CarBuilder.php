<?php

namespace App\Builders;

use App\Contracts\CarBuilderInterface;
use App\Models\Car;

class CarBuilder implements CarBuilderInterface
{
    private Car $car;

    public function __construct()
    {
        $this->car = new Car();
    }

    /**
     * @param string $brand
     * @return CarBuilder
     */
    public function setBrand(string $brand): CarBuilder
    {
        $this->car->setBrand($brand);
        return $this;
    }

    /**
     * @param string $model
     * @return CarBuilder
     */
    public function setModel(string $model): CarBuilder
    {
        $this->car->setModel($model);
        return $this;
    }

    /**
     * @param string $color
     * @return CarBuilder
     */
    public function setColor(string $color): CarBuilder
    {
        $this->car->setColor($color);
        return $this;
    }

    /**
     * @return Car
     */
    public function get(): Car
    {
        return $this->car;
    }
}
