<?php

namespace App\Contracts;

interface PrototypeInterface
{
    public function clone(): PrototypeInterface;
}
