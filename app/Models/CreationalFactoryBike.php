<?php

namespace App\Models;

use App\Contracts\VehicleInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreationalFactoryBike extends Model implements VehicleInterface
{
    /**
     * @return string
     */
    public function getBrand(): string
    {
        return 'Kawasaki';
    }

    /**
     * @return int
     */
    public function getWheels(): int
    {
        return 2;
    }
}
