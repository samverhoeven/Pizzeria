<?php

namespace PizzeriaProject\Data;

use PDO;
use PizzeriaProject\Data\DBConfig;
use PizzeriaProject\Entities\Klant;
use PDOException;

class KlantDAO {

    public function getByEmail($email) { //klantgegevens ophalen adhv een emailadres
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        if (!isset($dbh)) {
            throw new PDOException();
        }
        $sql = "select * from klanten where email = '" . $email . "'";
        $resultSet = $dbh->query($sql);
        if ($resultSet) {
            $rij = $resultSet->fetch();
            if ($rij) {
                $klant = Klant::create($rij["id"], $rij["naam"], $rij["voornaam"], $rij["straat"], $rij["huisnummer"], $rij["postcode"], $rij["woonplaats"], $rij["telefoon"], $rij["email"], $rij["wachtwoord"], $rij["bemerking"], $rij["promotie"]);
                $dbh = null;
                return $klant;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    public function getById($id) { //klantgegevens ophalen adhv de ID van de klant
        $sql = "select * from klanten where id = '" . $id . "'";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        if (!isset($dbh)) {
            throw new PDOException();
        }
        $resultSet = $dbh->query($sql);
        if ($resultSet) {
            $rij = $resultSet->fetch();
            if ($rij) {
                $klant = Klant::create($rij["id"], $rij["naam"], $rij["voornaam"], $rij["straat"], $rij["huisnummer"], $rij["postcode"], $rij["woonplaats"], $rij["telefoon"], $rij["email"], $rij["wachtwoord"], $rij["bemerking"], $rij["promotie"]);
                $dbh = null;
                return $klant;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    public function create($naam, $voornaam, $straat, $huisnummer, $postcode, $woonplaats, $telefoon, $email, $wachtwoord) { //nieuwe klant aanmaken
        $sql = "insert into klanten (naam, voornaam, straat, huisnummer, postcode, woonplaats, telefoon, email, wachtwoord) "
                . "values ('" . $naam . "','" . $voornaam . "','" . $straat . "','" . $huisnummer . "','" . $postcode . "','" . $woonplaats . "','" . $telefoon . "','" . $email . "','" . $wachtwoord . "')";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        if (!isset($dbh)) {
            throw new PDOException();
        }
        $dbh->exec($sql);
        $dbh = null;
    }

}
