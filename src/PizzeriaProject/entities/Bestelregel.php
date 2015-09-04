<?php

namespace PizzeriaProject\Entities;

class Bestelregel {

    private static $idMap = array();
    private $id;
    private $bestelId;
    private $productId;
    private $prijs;

    function __construct($id, $bestelId, $productId, $prijs) {
        $this->id = $id;
        $this->bestelId = $bestelId;
        $this->productId = $productId;
        $this->prijs = $prijs;
    }

    public static function create($id, $bestelId, $productId, $prijs) {
        if (!isset(self::$idMap[$id])) {
            self::$idMap[$id] = new Bestelregel($id, $bestelId, $productId, $prijs);
        }
        return self::$idMap[$id];
    }

    function getId() {
        return $this->id;
    }

    function getBestelId() {
        return $this->bestelId;
    }

    function getProductId() {
        return $this->productId;
    }

    function getPrijs() {
        return $this->prijs;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setBestelId($bestelId) {
        $this->bestelId = $bestelId;
    }

    function setProductId($productId) {
        $this->broodjeId = $productId;
    }

    function setPrijs($prijs) {
        $this->regelprijs = $prijs;
    }
}


