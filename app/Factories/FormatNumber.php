<?php

namespace App\Factories;

use App\Contracts\FormatterStaticFactoryInterface;

class FormatNumber implements FormatterStaticFactoryInterface
{
    const DECIMAL_SEPARATOR = ',';
    const THOUSANDS_SEPARATOR = '.';
    const DECIMALS = 2;
    /**
     * @inheritDoc
     */
    public function format(string $input): string
    {
        return number_format((int) $input, self::DECIMALS, self::DECIMAL_SEPARATOR, self::THOUSANDS_SEPARATOR);
    }
}
