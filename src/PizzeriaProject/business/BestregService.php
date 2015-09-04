<?php

namespace PizzeriaProject\Business;

use PizzeriaProject\Data\BestregDAO;

class BestregService{
    
    public function getBestreg($bestellingId){
        $bestreg = BestregDAO::getByBestellingId($bestellingId);
        return $bestreg;
    }
    
    public function createBestreg($bestellingId, $productId, $prijs){
        BestregDAO::create($bestellingId, $productId, $prijs);
    }
}


