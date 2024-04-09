<?php

namespace App\Prototypes;

use App\Contracts\PrototypeInterface;

class CarPrototype implements PrototypeInterface
{
    private string $brand;
    private string $model;

    /**
     * @param string $brand
     * @param string $model
     */
    public function __construct(string $brand, string $model)
    {
        $this->brand = $brand;
        $this->model = $model;
    }

    /**
     * @return PrototypeInterface
     */
    public function clone(): PrototypeInterface
    {
        return new self($this->brand, $this->model);
    }

    /**
     * @return string
     */
    public function getBrand(): string
    {
        return $this->brand;
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return $this->model;
    }
}
