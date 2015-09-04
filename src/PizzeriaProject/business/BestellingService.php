<?php

namespace PizzeriaProject\Business;

use PizzeriaProject\Data\BestellingDAO;

class BestellingService {

    public function getBestelling($klantId) {
        $bestelling = BestellingDAO::getByKlantId($klantId);
        return $bestelling;
    }

    public function createBestelling($klantId, $prijs, $datum) {
        $bestelId = BestellingDAO::create($klantId, $prijs, $datum);
        return $bestelId;
    }

}
