<?php

namespace App\Http\Controllers;

use App\Factories\FormatterStaticFactory;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\NoReturn;

class CreationalStaticFactory extends Controller
{
    #[NoReturn] public function index(): void
    {
        $formatterNumber = FormatterStaticFactory::factory('number');
        $formatterString = FormatterStaticFactory::factory('string');

        $number = $formatterNumber->format('2024');
        $string = $formatterString->format(2024);

        dd ($number, gettype($number), $string, gettype($string));
    }
}
