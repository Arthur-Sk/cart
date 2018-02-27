<?php

namespace Classes\Entity;

use Classes\Database\DBAL;
use Classes\Entity\Product;

class Cart extends Entity
{

    public $tableName = 'cart';
    public $cartId;

    public $productsTotalAmount;
    public $totalPrice;

    public function addProduct(Product $product, $quantity = null){
        $dbal = new DBAL();

        // If there's no cart, create new one
        if (empty($this->getCartId())){
            $data = array('date_created' => $this->getCurrentDatetime());
            $dbal->save($this, $data);
            $_SESSION['cartId'] = $dbal->getLastInsertId();
        }

        $this->setTableName('cart_products');
        $data = array('cart_id' => $this->getCartId(), 'product_id' => $product->getProductId());

        // If this product already in cart, get this row id to modify it
        if (!empty($oldCartProduct = $dbal->selectBy($this,$data)->fetch())){
            $data['id'] = $oldCartProduct['id'];
            $data['product_quantity'] = $oldCartProduct['product_quantity'];
        }

        // if quantity given, save it, else add one (for button add to cart)
        if(!empty($quantity)) {
            $data['product_quantity'] = $quantity;
        } else {
            $data['product_quantity'] += 1;
        }

        // Save to DB
        $dbal->save($this, $data);
        return true;
    }

    public function removeProduct(Product $product){

        $this->setTableName('cart_products');
        $dbal = new DBAL();
        $result = $dbal->deleteBy($this,array('product_id' => $product->getProductId()));
        return true;
    }

    public function editQuantity(Product $product, $quantity){
        $this->addProduct($product, $quantity);
        return true;
    }

    public function clearCart(){
        $dbal = new DBAL();
        $this->setTableName('cart_products');
        $dbal->deleteBy($this,array('cart_id' => $this->getCartId()));
        return true;
    }

    public function getProducts(){
        if(empty($this->getCartId())){
            return null;
        }
        $this->setTableName('cart_products');
        $dbal = new DBAL();
        return $dbal->selectBy($this,array('cart_id' => $this->getCartId()))->fetchAll();
    }

    public function getProductTotalQuantity(){
        if(!$this->getProducts()){
            return 0;
        }

        $cartProducts = $this->getProducts();
        foreach ($cartProducts as $cartProduct){
            $this->productsTotalAmount += $cartProduct['product_quantity'];
        }
        return $this->productsTotalAmount;
    }

    public function getTotalPrice(){
        if (!$this->getProducts()){
            return 0;
        }

        $cartProducts = $this->getProducts();
        foreach ($cartProducts as $cartProduct){
            $product = new Product();
            $product = $product->getProductById($cartProduct['product_id']);
            $this->totalPrice += $product['price']*$cartProduct['product_quantity'];
        }
        return $this->totalPrice;
    }

    public function getStackPrice($cartProduct){
        $product = new Product();
        $product = $product->getProductById($cartProduct['product_id']);
        return $product['price']*$cartProduct['product_quantity'];
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

    /**
     * @return mixed
     */
    public function getCartId()
    {
        // If there's already set card id, return this
        if (!empty($this->cartId)){
            return $this->cartId;
        }
        return $_SESSION['cartId'];
    }

    /**
     * @param mixed $cartId
     */
    public function setCartId($cartId)
    {
        $this->cartId = $cartId;
    }




}