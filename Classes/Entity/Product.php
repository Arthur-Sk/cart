<?php


namespace Classes\Entity;

use \Classes\Database\DBAL;

class Product extends Entity
{
    public $tableName = 'products';
    public $productId;

    public function getAllProducts(){
        $dbal = new DBAL();
        $products = $dbal->selectAll(new Product())->fetchAll();
        return $products;
    }

    public function getProductById($id){
        $dbal = new DBAL();
        $products = $dbal->selectById(new Product(),$id)->fetch();
        return $products;
    }

    /**
     * @return mixed
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @param mixed $productId
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;
    }
    
    
    
}