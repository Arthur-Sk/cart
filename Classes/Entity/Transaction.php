<?php

namespace Classes\Entity;


class Transaction extends Entity
{

    public $payment;
    public $cart;

    public function __construct(Cart $cart, Payment $payment){
        $this->setPayment($payment);
        $this->setCart($cart);
        $this->setDateCreated(date('Y-m-d H:i:s', time()));
    }

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
     * @return Payment
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * @param Payment $payment
     */
    public function setPayment($payment)
    {
        $this->payment = $payment;
    }

    /**
     * @return Cart
     */
    public function getCart()
    {
        return $this->cart;
    }

    /**
     * @param Cart $cart
     */
    public function setCart($cart)
    {
        $this->cart = $cart;
    }


}