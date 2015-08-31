<?php

namespace PizzeriaProject\Data;

use PDO;
use PizzeriaProject\Data\DBConfig;
use PizzeriaProject\Entities\Klant;

class KlantDAO {

    public function getByEmail($email) {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = "select * from klanten where email = '" . $email . "'";
        $klant = $dbh->query($sql);
        $dbh = null;
        return $klant;
    }

    public function create($naam, $voornaam, $straat, $huisnummer, $postcode, $woonplaats, $telefoon, $email, $wachtwoord) {
        $sql = "insert into klanten (naam, voornaam, straat, huisnummer, postcode, woonplaats, telefoon, email, wachtwoord) "
                . "values ('" . $naam . "','" . $voornaam . "','" . $straat . "','" . $huisnummer . "','" . $postcode . "','" . $woonplaats . "','" . $telefoon . "','" . $email . "','" . $wachtwoord . "')";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $dbh->exec($sql);
        $dbh = null;
    }

}
