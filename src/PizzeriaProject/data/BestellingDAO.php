<?php

namespace PizzeriaProject\Data;

use PDO;
use PizzeriaProject\Data\DBConfig;
use PizzeriaProject\Entities\Bestelling;

class BestellingDAO {
    
    public function getByKlantId($klantId) {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = "select * from bestellingen where klantid = '" . $klantId . "' order by datum desc limit 1";
        $resultSet = $dbh->query($sql);

        if ($resultSet) {
            $rij = $resultSet->fetch();
            if ($rij) {
                $bestelling = Bestelling::create($rij["id"], $rij["klantid"], $rij["prijs"], $rij["datum"]);
                $dbh = null;
                return $bestelling;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }
    
    public function create($klantId, $prijs, $datum){
        $sql = "insert into bestellingen (klantid, prijs, datum) "
                . "values ('" . $klantId . "','" . $prijs . "','".$datum."')";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $dbh->exec($sql);
        $bestelId = $dbh->lastInsertId();
        $dbh = null;
        return $bestelId;
    }
} 

