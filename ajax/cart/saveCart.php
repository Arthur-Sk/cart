<?php include_once (__DIR__.'/../../template/header.php');

$product = new Classes\Entity\Product();
$product->setProductId($_POST['id']);

$cart = new Classes\Entity\Cart();

if (!empty($_POST['quantity'])){
    $cart->saveCart($product,$_POST['quantity']);
} else {
$cart->saveCart($product);
}