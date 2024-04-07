<?php

namespace App\Factories;

use App\Contracts\PaymentGatewayInterface;
use App\Contracts\PaymentGatewayFactoryInterface;
use App\Gateways\PaypalPaymentGateway;

class PaypalPaymentGatewayFactory implements PaymentGatewayFactoryInterface
{
    public function createPaymentGateway(): PaymentGatewayInterface
    {
        return new PaypalPaymentGateway();
    }
}
