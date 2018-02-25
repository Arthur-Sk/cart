<?php include_once (__DIR__.'/../../template/header.php');

$product = new Classes\Entity\Product();
$product->setProductId($_GET['id']);

$cart = new \Classes\Entity\Cart();
$cart->editQuantity($product, $_GET['quantity']);