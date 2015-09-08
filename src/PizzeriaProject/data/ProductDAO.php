<?php

namespace PizzeriaProject\Data;

use PDO;
use PizzeriaProject\Data\DBConfig;
use PizzeriaProject\Entities\Product;

class ProductDAO{
    public function getAll(){//alle producten ophalen
        $lijst = array();
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        if (!isset($dbh)) {
            throw new PDOException();
        }
        $sql = "select * from producten order by prijs";
        $resultSet = $dbh->query($sql);
        foreach($resultSet as $rij){
            $lijst[] = Product::create($rij["id"], $rij["naam"], $rij["prijs"], $rij["samenstelling"], $rij["beschikbaarheid"], $rij["promotie"]);
        }
        $dbh = null;
        return $lijst;
    }
    
    public function getById($id) {//product ophalen adhv de ID van het product
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        if (!isset($dbh)) {
            throw new PDOException();
        }
        $sql = "select * from producten where id = '" . $id ."'";
        $resultSet = $dbh->query($sql);
        $rij = $resultSet->fetch();
        $product = Product::create($rij["id"], $rij["naam"], $rij["prijs"], $rij["samenstelling"], $rij["beschikbaarheid"], $rij["promotie"]);
        $dbh = null;
        return $product;
    }
}

