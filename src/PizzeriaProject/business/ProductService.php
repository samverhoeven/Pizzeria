<?php

namespace PizzeriaProject\Business;

use PizzeriaProject\Data\ProductDAO;

class ProductService{
    public function getAllProducts(){
        $menu = ProductDAO::getAll();
        return $menu;
    }
    
    public function getProductById($id) {
        $product = ProductDAO::getById($id);
        return $product;
    }
}

