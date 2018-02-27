<?php

namespace Classes\Entity;

use Classes\Database\DBAL;

class Cart extends Entity
{

    public $tableName = 'cart';
    public $cartId;

    public $productsTotalAmount = 0;
    public $totalPrice = 0;

    public function addProduct(Product $product){
        $dbal = new DBAL();

        // If there's no cart, create new
        if (empty($_SESSION['cartId'])){
            $data = array('date_created' => $this->getCurrentDatetime());
            $dbal->save($this, $data);
            $_SESSION['cartId'] = $dbal->getLastInsertId();
        }

        $this->setTableName('cart_products');
        $data = array('cart_id' => $_SESSION['cartId'], 'product_id' => $product->getProductId());
        $dbal -> save($this, $data);
        return true;
    }

    public function removeProduct(Product $product){

        $this->setTableName('cart_products');
        $dbal = new DBAL();
        $result = $dbal->deleteBy($this,array('product_id' => $product->getProductId()));
        return true;
    }

    public function editQuantity(Product $product, $quantity){
        $this->removeProduct($product);
        for ($i = 1; $i <= $quantity; $i++){
            $this->addProduct($product);
        }
        return true;
    }

    public function clearCart(){
        $dbal = new DBAL();
        $this->setTableName('cart_products');
        $dbal->deleteBy($this,array('cart_id' => $_SESSION['cartId']));
        return true;
    }

    public function getProducts(){
        if(empty($_SESSION['cartId'])){
            return null;
        }
        $products = array();
        $this->setTableName('cart_products');
        $dbal = new DBAL();
        $result = $dbal->selectBy($this,array('cart_id' => $_SESSION['cartId']));
        while ($product = $result->fetch()){
            array_push($products, $product['product_id']);
        }
        return array_count_values($products);
    }

    public function getProductTotalAmount(){
        if(!$this->getProducts()){
            return 0;
        }

        $products = $this->getProducts();
        foreach ($products as $product => $amount){
            $this->productsTotalAmount += $amount;
        }
        return $this->productsTotalAmount;
    }

    public function getTotalPrice(){
        if (!$this->getProducts()){
            return 0;
        }

        foreach ($this->getProducts() as $productId => $amount){
            $product = new Product();
            $product = $product->getProductById($productId);
            $this->totalPrice += $product['price']*$amount;
        }
        return $this->totalPrice;
    }

    public function getCurrentDatetime(){
        return $date = date('Y-m-d H:i:s', time());
    }

    /**
     * @param string $tableName
     */
    public function setTableName($tableName)
    {
        $this->tableName = $tableName;
    }


    
}