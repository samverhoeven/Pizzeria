<?php

namespace PizzeriaProject\Business;

use PizzeriaProject\Data\BestellingDAO;

class BestellingService {

    public function getBestelling($klantId) { //bestelling ophalen adhv de ingelogde klant
        $bestelling = BestellingDAO::getByKlantId($klantId);
        return $bestelling;
    }

    public function createBestelling($klantId, $prijs, $datum) { //bestelling aanmaken
        $bestelId = BestellingDAO::create($klantId, $prijs, $datum);
        return $bestelId;
    }

}
