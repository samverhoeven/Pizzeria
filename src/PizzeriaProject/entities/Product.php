<?php

namespace PizzeriaProject\Entities; 

use JsonSerializable;

class Product implements JsonSerializable{
    private static $idMap = array();
    private $id;
    private $naam;
    private $prijs;
    private $samenstelling;
    private $beschikbaarheid;
    private $promotie;
    
    function __construct($id, $naam, $prijs, $samenstelling, $beschikbaarheid, $promotie) {
        $this->id = $id;
        $this->naam = $naam;
        $this->prijs = $prijs;
        $this->samenstelling = $samenstelling;
        $this->beschikbaarheid = $beschikbaarheid;
        $this->promotie = $promotie;
    }

    public static function create($id, $naam, $prijs, $samenstelling, $beschikbaarheid, $promotie){
        if (!isset(self::$idMap[$id])) {
            self::$idMap[$id] = new Product($id, $naam, $prijs, $samenstelling, $beschikbaarheid, $promotie);
        }
        return self::$idMap[$id];
    }
    
    function getId() {
        return $this->id;
    }

    function getNaam() {
        return $this->naam;
    }

    function getPrijs() {
        return $this->prijs;
    }

    function getSamenstelling() {
        return $this->samenstelling;
    }

    function getBeschikbaarheid() {
        return $this->beschikbaarheid;
    }

    function getPromotie() {
        return $this->promotie;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNaam($naam) {
        $this->naam = $naam;
    }

    function setPrijs($prijs) {
        $this->prijs = $prijs;
    }

    function setSamenstelling($samenstelling) {
        $this->samenstelling = $samenstelling;
    }

    function setBeschikbaarheid($beschikbaarheid) {
        $this->beschikbaarheid = $beschikbaarheid;
    }

    function setPromotie($promotie) {
        $this->promotie = $promotie;
    }

    public function jsonSerialize()
    {
        return [
            'Product' => [
                'Id' => $this->id,
                'Naam' => $this->naam,
                'Prijs' => $this->prijs,
                'Samenstelling' => $this->samenstelling,
                'Beschikbaarheid' => $this->beschikbaarheid,
                'Promotie' => $this->promotie
            ]
        ];
    }
}

