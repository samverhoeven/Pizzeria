<?php

namespace PizzeriaProject\Business;

use PizzeriaProject\Data\BestregDAO;

class BestregService{
    
    public function getBestreg($bestellingId){// bestellingsregel ophalen adhv de bestellingId
        $bestreg = BestregDAO::getByBestellingId($bestellingId);
        return $bestreg;
    }
    
    public function createBestreg($bestellingId, $productId, $prijs){ //bestellingsregel aanmaken
        BestregDAO::create($bestellingId, $productId, $prijs);
    }
}


