<?php include_once (__DIR__.'/template/header.php');?>
<div class="container">
    <?php
    if (!empty($_SESSION['cartId'])){
        $cart = new \Classes\Entity\Cart();
        $cart->setCartId($_SESSION['cartId']);
        unset($_SESSION['cartId']);

        $payment = new \Classes\Entity\Payment();
        $payment->setPaymentType($_POST['paymentType']);

        if ($_POST['paymentType'] == 'Card') {
            $payment->setNameOnCard($_POST['nameOnCard']);
            $payment->setCardNumber($_POST['cardNumber']);
            $payment->setCVV($_POST['CVV']);
        }

        $payment->setPaid(true);

        $transaction = new \Classes\Entity\Transaction($cart,$payment);
        var_dump($transaction);
    } else { ?>
    <p>Your cart is empty</p>
    <button class="btn btn-secondary" onclick="event.preventDefault(); window.location.replace(getRoot())">Back</button>
    <?php } ?>
</div>
