<?php

namespace Classes\Entity;


class Payment extends Entity
{
    public $paymentType;

    public $nameOnCard;
    public $cardNumber;
    public $CVV;

    public $paid = false;

}