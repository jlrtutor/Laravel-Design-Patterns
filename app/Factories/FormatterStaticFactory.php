<?php

namespace App\Factories;

use App\Contracts\FormatterStaticFactoryInterface;
use http\Exception\InvalidArgumentException;

class FormatterStaticFactory
{
    public static function factory(string $formatterType): FormatterStaticFactoryInterface
    {
        // PHP <8
        /*
        switch ($formatterType) {
            case 'string':
                return new FormatString();
            case 'number':
                return new FormatNumber();
            default:
                return new InvalidArgumentException('Invalid format type');
        }
        */

        return match ($formatterType) {
            'string' => new FormatString(),
            'number' => new FormatNumber(),
            default => throw new InvalidArgumentException('Invalid format type'),
        };
    }
}
