<?php

namespace PizzeriaProject\Business;

use PizzeriaProject\Data\KlantDAO;

class KlantService{
    public function getKlantByEmail($email){
        $klant = KlantDAO::getByEmail($email);
        return $klant;
    }
    
    public function createNewKlant($naam, $voornaam, $straat, $huisnummer, $postcode, $woonplaats, $telefoon, $email, $wachtwoord){
        KlantDAO::create($naam, $voornaam, $straat, $huisnummer, $postcode, $woonplaats, $telefoon, $email, $wachtwoord);
    }
}

