<?php include_once (__DIR__.'/../../template/header.php');

$product = new Classes\Entity\Product();
$product->setProductId($_POST['id']);

$cart = new Classes\Entity\Cart();
$cart->removeProduct($product);