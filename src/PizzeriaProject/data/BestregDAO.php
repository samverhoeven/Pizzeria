<?php

namespace PizzeriaProject\Data;

use PDO;
use PizzeriaProject\Data\DBConfig;
use PizzeriaProject\Entities\Bestelregel;

class BestregDAO {

    public function getByBestellingId($bestellingId) {
        $lijst = array();
        $sql = "select * from bestreg where bestellingid = '" . $bestellingId . "'";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);
        if ($resultSet) {
            foreach ($resultSet as $rij) {
                $lijst[] = Bestelregel::create($rij["id"], $rij["bestelid"], $rij["productid"], $rij["prijs"]);
            }
            $dbh = null;
            return $lijst;
        } else {
            return null;
        }
    }

    public function create($bestellingId, $productId, $prijs) {
        $sql = "insert into bestreg (bestellingid, broodjeid, regelprijs, tijdstip) "
                . "values('" . $bestellingId . "','" . $productId . "','" . $prijs . "')";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $dbh->exec($sql);
        $dbh = null;
    }

}


