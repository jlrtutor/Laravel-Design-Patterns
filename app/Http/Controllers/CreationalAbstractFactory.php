<?php

namespace App\Http\Controllers;


use App\Factories\PaymentGatewayFactory;
use App\Factories\PaypalPaymentGatewayFactory;
use App\Factories\RedsysPaymentGatewayFactory;

class CreationalAbstractFactory extends Controller
{
    public function index()
    {
        $paypalPaymentGateway = (new PaymentGatewayFactory(new PaypalPaymentGatewayFactory()))->createPaymentGateway()->charge(100);
        $redsysPaymentGateway = (new PaymentGatewayFactory(new RedsysPaymentGatewayFactory()))->createPaymentGateway()->charge(550);
    }
}
