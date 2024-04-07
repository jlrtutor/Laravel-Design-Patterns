<?php

namespace App\Gateways;

use App\Contracts\PaymentGatewayInterface;

class  RedsysPaymentGateway implements PaymentGatewayInterface
{
    public function charge(float $amount)
    {
        // TODO: Implement Redsys-specific charge() method.
        var_dump("Charging $amount to the user using Redsys");
    }
}
