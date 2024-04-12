<?php

namespace App\Contracts;

interface FormatterStaticFactoryInterface
{
    /**
     * @param string $input
     * @return string
     */
    public function format(string $input): string;
}
