<?php

namespace App\Gateways;

use App\Contracts\PaymentGatewayInterface;

class PaypalPaymentGateway implements PaymentGatewayInterface
{
    public function charge(float $amount)
    {
        // TODO: Implement Paypal-specific charge() method.
        var_dump("Charging $amount to the user using Paypal");
    }
}
