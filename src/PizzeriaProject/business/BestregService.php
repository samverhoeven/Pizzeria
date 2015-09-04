<?php

namespace PizzeriaProject\Business;

use PizzeriaProject\Data\BestregDAO;

class BestregService{
    
    public function getBestreg($bestellingId){
        $bestelling = BestregDAO::getByBestellingId($bestellingId);
        return $bestelling;
    }
    
    public function createBestreg($bestellingId, $productId, $prijs){
        BestregDAO::create($bestellingId, $productId, $prijs);
    }
}


