<?php

namespace PizzeriaProject\Data;

use PDO;
use PizzeriaProject\Data\DBConfig;
use PizzeriaProject\Entities\Klant;

class KlantDAO {

    public function getByEmail($email) {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = "select * from klanten where email = '". $email . "'";
        print($sql . "<br>");
        $resultSet = $dbh->query($sql);
        if ($resultSet) {
            $rij = $resultSet->fetch();
            if ($rij) {
                $klant = Klant::create($rij["id"],$rij["naam"],$rij["voornaam"],$rij["straat"],
                        $rij["huisnummer"],$rij["postcode"],$rij["woonplaats"],$rij["telefoon"],
                        $rij["email"], $rij["wachtwoord"],$rij["bemerking"],$rij["promotie"]);
                $dbh = null;
                return $klant;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }
    
       public function getById($id) {
        $sql = "select * from klanten where id = '" . $id . "'";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);
        if ($resultSet) {
            $rij = $resultSet->fetch();
            if ($rij) {
                $klant = Klant::create($rij["id"],$rij["naam"],$rij["voornaam"],$rij["straat"],
                        $rij["huisnummer"],$rij["postcode"],$rij["woonplaats"],$rij["telefoon"],
                        $rij["email"], $rij["wachtwoord"],$rij["bemerking"],$rij["promotie"]);
                $dbh = null;
                return $klant;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }
    
    public function create($naam, $voornaam, $straat, $huisnummer, $postcode, $woonplaats, $telefoon, $email, $wachtwoord) {
        $sql = "insert into klanten (naam, voornaam, straat, huisnummer, postcode, woonplaats, telefoon, email, wachtwoord) "
                . "values ('" . $naam . "','" . $voornaam . "','" . $straat . "','" . $huisnummer . "','" . $postcode . "','" . $woonplaats . "','" . $telefoon . "','" . $email . "','" . $wachtwoord . "')";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $dbh->exec($sql);
        $dbh = null;
    }

}
