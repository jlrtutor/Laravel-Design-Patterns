<?php

namespace App\Factories;

use App\Contracts\PaymentGatewayInterface;
use App\Contracts\PaymentGatewayFactoryInterface;
use App\Gateways\RedsysPaymentGateway;

class RedsysPaymentGatewayFactory implements PaymentGatewayFactoryInterface
{
    public function createPaymentGateway(): PaymentGatewayInterface
    {
        return new RedsysPaymentGateway();
    }
}
