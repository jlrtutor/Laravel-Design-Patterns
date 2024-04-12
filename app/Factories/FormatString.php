<?php

namespace App\Factories;

use App\Contracts\FormatterStaticFactoryInterface;

class FormatString implements FormatterStaticFactoryInterface
{

    /**
     * @inheritDoc
     */
    public function format(string $input): string
    {
        return $input;
    }
}
