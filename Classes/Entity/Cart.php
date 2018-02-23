<?php

namespace Classes\Entity;

use Classes\Entity\Product;

class Cart extends Entity
{

    public function addProduct(Product $product){
        if (empty($_SESSION['cart'])){
            $_SESSION['cart'] = array();
        }
        array_push($_SESSION['cart'],$product->getProductId());
        return true;
    }

    public function removeProduct(Product $product){
        var_dump($_SESSION['cart']);
        foreach ($_SESSION['cart'] as $key => $productId){
            if ($product->getProductId() == $productId){
                unset($_SESSION['cart'][$key]);
            }
        }
        var_dump($_SESSION['cart']);
    }

    public function getProducts(){
        if(empty($_SESSION['cart'])){
            return null;
        }

        return array_count_values($_SESSION['cart']);
    }

    public function getProductAmount(){
        if(empty($_SESSION['cart'])){
            return 0;
        }
        return count($_SESSION['cart']);
    }

    public function getTotalPrice(){
        if (!$this->getProducts()){
            return 0;
        }
        $cartTotalPrice = 0;
        foreach ($this->getProducts() as $productId => $amount){
            $product = new Product();
            $product = $product->getProductById($productId);
            $cartTotalPrice += $product['price']*$amount;
        }
        return $cartTotalPrice;
    }

    
}