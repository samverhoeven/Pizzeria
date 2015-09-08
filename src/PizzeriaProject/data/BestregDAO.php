<?php

namespace PizzeriaProject\Data;

use PDO;
use PizzeriaProject\Data\DBConfig;
use PizzeriaProject\Entities\Bestelregel;

class BestregDAO {

    public function getByBestellingId($bestelId) { // bestellingsregel ophalen adhv de bestellingId
        $lijst = array();
        $sql = "select * from bestreg where bestelid = '" . $bestelId . "'";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        if (!isset($dbh)) {
            throw new PDOException();
        }
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

    public function create($bestellingId, $productId, $prijs) { //nieuwe bestelregel aanmaken
        $sql = "insert into bestreg (bestelid, productid, prijs) "
                . "values('" . $bestellingId . "','" . $productId . "','" . $prijs . "')";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        if (!isset($dbh)) {
            throw new PDOException();
        }
        $dbh->exec($sql);
        $dbh = null;
    }

}


