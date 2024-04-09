<?php

namespace App\Models;

use App\Contracts\VehicleInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreationalFactoryCar extends Model implements VehicleInterface
{
    /**
     * @return string
     */
    public function getBrand(): string
    {
        return 'Mercedes';
    }

    /**
     * @return int
     */
    public function getWheels(): int
    {
        return 4;
    }
}
