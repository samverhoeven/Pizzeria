<?php

namespace PizzeriaProject\Entities;

class Klant {

    private static $idMap = array();
    private $id;
    private $naam;
    private $voornaam;
    private $straat;
    private $huisnummer;
    private $postcode;
    private $woonplaats;
    private $telefoon;
    private $email;
    private $wachtwoord;
    private $bemerking;
    private $promotie;

    function __construct($id, $naam, $voornaam, $straat, $huisnummer, $postcode, $woonplaats, $telefoon, $email, $wachtwoord, $bemerking, $promotie) {
        $this->id = $id;
        $this->naam = $naam;
        $this->voornaam = $voornaam;
        $this->straat = $straat;
        $this->huisnummer = $huisnummer;
        $this->postcode = $postcode;
        $this->woonplaats = $woonplaats;
        $this->telefoon = $telefoon;
        $this->email = $email;
        $this->wachtwoord = $wachtwoord;
        $this->bemerking = $bemerking;
        $this->promotie = $promotie;
    }
    
        public static function create($id, $naam, $voornaam, $straat, $huisnummer, $postcode, $woonplaats, $telefoon, $email, $wachtwoord, $bemerking, $promotie){
        if (!isset(self::$idMap[$id])) {
            self::$idMap[$id] = new Product($id, $naam, $voornaam, $straat, $huisnummer, $postcode, $woonplaats, $telefoon, $email, $wachtwoord, $bemerking, $promotie);
        }
        return self::$idMap[$id];
    }

    function getId() {
        return $this->id;
    }

    function getNaam() {
        return $this->naam;
    }

    function getVoornaam() {
        return $this->voornaam;
    }

    function getStraat() {
        return $this->straat;
    }

    function getHuisnummer() {
        return $this->huisnummer;
    }

    function getPostcode() {
        return $this->postcode;
    }

    function getWoonplaats() {
        return $this->woonplaats;
    }

    function getTelefoon() {
        return $this->telefoon;
    }

    function getEmail() {
        return $this->email;
    }

    function getWachtwoord() {
        return $this->wachtwoord;
    }

    function getBemerking() {
        return $this->bemerking;
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

    function setVoornaam($voornaam) {
        $this->voornaam = $voornaam;
    }

    function setStraat($straat) {
        $this->straat = $straat;
    }

    function setHuisnummer($huisnummer) {
        $this->huisnummer = $huisnummer;
    }

    function setPostcode($postcode) {
        $this->postcode = $postcode;
    }

    function setWoonplaats($woonplaats) {
        $this->woonplaats = $woonplaats;
    }

    function setTelefoon($telefoon) {
        $this->telefoon = $telefoon;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setWachtwoord($wachtwoord) {
        $this->wachtwoord = $wachtwoord;
    }

    function setBemerking($bemerking) {
        $this->bemerking = $bemerking;
    }

    function setPromotie($promotie) {
        $this->promotie = $promotie;
    }

}
