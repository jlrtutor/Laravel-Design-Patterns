<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    private string $brand;
    private string $model;
    private string $color;

    public function setBrand(string $brand): void
    {
        $this->brand = $brand;
    }

    public function setModel(string $model): void
    {
        $this->model = $model;
    }

    public function setColor(string $color): void
    {
        $this->color = $color;
    }

    public function getInfo(): string
    {
        return "Brand: " . $this->brand . ", model: " . $this->model . ", color: " . $this->color . PHP_EOL;
    }
}
