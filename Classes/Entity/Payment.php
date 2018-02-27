<?php

namespace Classes\Entity;


class Payment extends Entity
{
    public $paymentType;

    public $nameOnCard;
    public $cardNumber;
    public $CVV;

    public $paid = false;

    /**
     * @return mixed
     */
    public function getDateCreated()
    {
        return $this->date_created;
    }

    /**
     * @param mixed $date_created
     */
    public function setDateCreated($date_created)
    {
        $this->date_created = $date_created;
    }

    /**
     * @return mixed
     */
    public function getPaymentType()
    {
        return $this->paymentType;
    }

    /**
     * @param mixed $paymentType
     */
    public function setPaymentType($paymentType)
    {
        $this->paymentType = $paymentType;
    }

    /**
     * @return mixed
     */
    public function getNameOnCard()
    {
        return $this->nameOnCard;
    }

    /**
     * @param mixed $nameOnCard
     */
    public function setNameOnCard($nameOnCard)
    {
        $this->nameOnCard = $nameOnCard;
    }

    /**
     * @return mixed
     */
    public function getCardNumber()
    {
        return $this->cardNumber;
    }

    /**
     * @param mixed $cardNumber
     */
    public function setCardNumber($cardNumber)
    {
        $this->cardNumber = $cardNumber;
    }

    /**
     * @return mixed
     */
    public function getCVV()
    {
        return $this->CVV;
    }

    /**
     * @param mixed $CVV
     */
    public function setCVV($CVV)
    {
        $this->CVV = $CVV;
    }

    /**
     * @return bool
     */
    public function isPaid()
    {
        return $this->paid;
    }

    /**
     * @param bool $paid
     */
    public function setPaid($paid)
    {
        $this->paid = $paid;
    }



}