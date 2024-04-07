<?php

namespace App\Factories;


use App\Contracts\PaymentGatewayInterface;
use App\Contracts\PaymentGatewayFactoryInterface;

class PaymentGatewayFactory implements PaymentGatewayFactoryInterface
{
    protected PaymentGatewayFactoryInterface $paymentGateway;

    public function __construct(PaymentGatewayFactoryInterface $paymentGateway)
    {
        $this->paymentGateway = $paymentGateway;
    }

    public function createPaymentGateway(): PaymentGatewayInterface
    {
        return $this->paymentGateway->createPaymentGateway();
    }
}
