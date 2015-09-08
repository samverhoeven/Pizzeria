<?php

namespace PizzeriaProject\Business;

use PizzeriaProject\Data\KlantDAO;

class KlantService {

    public function getKlantByEmail($email) { //klantgegevens ophalen adhv een emailadres
        $klant = KlantDAO::getByEmail($email);
        return $klant;
    }

    public function getKlantId($email) { //ID van de klant ophalen adhv een emailadres
        $klant = KlantDAO::getByEmail($email);
        return $klant->getId();
    }

    public function getKlantById($id){ //klantgegevens ophalen adhv de ID van de klant
        $klant = KlantDAO::getById($id);
        return $klant;
    }
    
    public function createKlant($naam, $voornaam, $straat, $huisnummer, $postcode, $woonplaats, $telefoon, $email, $wachtwoord) { //nieuwe klant aanmaken
        KlantDAO::create($naam, $voornaam, $straat, $huisnummer, $postcode, $woonplaats, $telefoon, $email, $wachtwoord);
    }

    public function controleerKlant($email, $wachtwoord) { //controleert of inloggegevens van klant kloppen
        $klant = KlantDAO::getByEmail($email);
        if (isset($klant) && $klant->getWachtwoord() == $wachtwoord) {
            return true;
        } else {
            return false;
        }
    }

    public function controleerGeregistreerd($email) { //checkt of betreffend emailadres geregistreerd is
        $klant = KlantDAO::getByEmail($email);
        if (isset($klant)) {
            return true;
        } else {
            return false;
        }
    }

}
