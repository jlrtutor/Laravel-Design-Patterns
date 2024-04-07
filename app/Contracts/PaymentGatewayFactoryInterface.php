<?php

namespace App\Contracts;


interface PaymentGatewayFactoryInterface
{
    public function createPaymentGateway(): PaymentGatewayInterface;
}
