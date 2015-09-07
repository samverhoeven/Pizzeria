<?php

namespace PizzeriaProject\Business;

use PizzeriaProject\Data\KlantDAO;

class KlantService {

    public function getKlantByEmail($email) {
        $klant = KlantDAO::getByEmail($email);
        return $klant;
    }

    public function getKlantId($email) {
        $klant = KlantDAO::getByEmail($email);
        return $klant->getId();
    }

    public function getKlantById($id){
        $klant = KlantDAO::getById($id);
        return $klant;
    }
    
    public function createKlant($naam, $voornaam, $straat, $huisnummer, $postcode, $woonplaats, $telefoon, $email, $wachtwoord) {
        KlantDAO::create($naam, $voornaam, $straat, $huisnummer, $postcode, $woonplaats, $telefoon, $email, $wachtwoord);
    }

    public function controleerKlant($email, $wachtwoord) {
        $klant = KlantDAO::getByEmail($email);
        if (isset($klant) && $klant->getWachtwoord() == $wachtwoord) {
            return true;
        } else {
            return false;
        }
    }

    public function controleerGeregistreerd($email) {
        $klant = KlantDAO::getByEmail($email);
        if (isset($klant)) {
            return true;
        } else {
            return false;
        }
    }

}
