<?php

namespace App\Http\Controllers;

use App\Prototypes\CarPrototype;
use Illuminate\Http\Request;

class CreationalPrototype extends Controller
{
    public function index()
    {
        $initialCarObject = new CarPrototype('Mercedes', 'C220');
        $clonedCarObject = $initialCarObject->clone();

        dd($initialCarObject, $clonedCarObject);
    }
}
