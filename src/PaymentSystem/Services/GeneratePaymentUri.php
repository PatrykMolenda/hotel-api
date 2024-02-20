<?php

use App\PaymentSystem\ValueObject\PaymentValueObject;


class GeneratePaymentUri
{
    /**
     * @var string $uri Payment URL
     */
    private string $uri;
    public function __construct(PaymentValueObject $paymentObject)
    {
        $this->uri = "https://google.com/";
    }
}