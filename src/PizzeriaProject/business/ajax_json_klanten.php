<?php

use Doctrine\Common\ClassLoader;
use PizzeriaProject\Business\KlantService;

require_once("../../../libraries/Doctrine/Common/ClassLoader.php");
$classLoader = new ClassLoader("PizzeriaProject", "../../../src");
$classLoader->register();

$KS = new KlantService();

if (isset($_GET["email"])) {//emailadres van 1 klant ophalen als email gegeven is
    $emailstring = $_GET["email"];
    $klant = $KS->getKlantByEmail($emailstring);
    if ($klant != null) {
        $email = $klant->getEmail();
        echo "false";
    } else {
        echo "true";
    }
} else {
    //alle emailadressen van alle klanten ophalen als email niet gegeven is
    /*$klanten = $KS->getAlleKlanten();
    foreach ($klanten as $klant) {
        $emails[] = $klant->getEmail();
    }*/
    //echo json_encode($emails);
    echo "true";
}





