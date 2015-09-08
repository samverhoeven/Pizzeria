<?php

namespace PizzeriaProject\Business;

use PizzeriaProject\Data\ProductDAO;

class ProductService{
    public function getAllProducts(){ //alle producten ophalen
        $menu = ProductDAO::getAll();
        return $menu;
    }
    
    public function getProductById($id) { //product ophalen adhv de ID van het product
        $product = ProductDAO::getById($id);
        return $product;
    }
}

