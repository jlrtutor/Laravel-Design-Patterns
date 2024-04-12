<?php

namespace App\Contracts;

interface FormatterStaticFactory
{
    public function formatter(string $string): string;
}
