<?php

namespace PizzeriaProject\Data;

use PDO;
use PizzeriaProject\Data\DBConfig;
use PizzeriaProject\Entities\Product;

class ProductDAO{
    public function getAll(){
        $lijst = array();
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = "select * from producten";
        $resultSet = $dbh->query($sql);
        foreach($resultSet as $rij){
            $lijst[] = Product::create($rij["id"], $rij["naam"], $rij["prijs"], $rij["samenstelling"], 
                    $rij["voedingswaarden"], $rij["beschikbaarheid"], $rij["beschikbaarheid"]);
        }
        $dbh = null;
        return $lijst;
    }
    
    public function getById($id) {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = "select * from producten where id = '" . $id ."'";
        $resultSet = $dbh->query($sql);
        $rij = $resultSet->fetch();
        $product = Product::create($rij["id"], $rij["naam"], $rij["prijs"], $rij["samenstelling"], 
                    $rij["voedingswaarden"], $rij["beschikbaarheid"], $rij["beschikbaarheid"]);
        $dbh = null;
        return $product;
    }
}

