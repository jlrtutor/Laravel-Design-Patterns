<?php

namespace App\Http\Controllers;

use App\Builders\CarBuilder;
use Illuminate\Http\Request;

class CreationalBuilder extends Controller
{
    public function index()
    {
        $carBuilder = new CarBuilder();
        $europeanCar = $carBuilder->setBrand('Peugeout')->setModel('508')->setColor('White')->get();
        echo $europeanCar->getInfo();

        $americanCar = $carBuilder->setBrand('Chevrolet')->setModel('Camaro')->setColor('Grey')->get();
        echo $americanCar->getInfo();
    }
}
