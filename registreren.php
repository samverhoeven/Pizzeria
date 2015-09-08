<?php

use Doctrine\Common\ClassLoader;
use PizzeriaProject\Business\KlantService;

require_once("libraries/Doctrine/Common/ClassLoader.php");
require_once("libraries/Twig/Autoloader.php");

Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem("src/PizzeriaProject/presentation");
$twig = new Twig_Environment($loader);

$classLoader = new ClassLoader("PizzeriaProject", "src");
$classLoader->register();

session_start();

if (isset($_SESSION["aangemeld"])) {//checkt of er een klant is aangemeld
    if ($_SESSION["aangemeld"]) {
        header("Location: index.php");
        exit(0);
    }
}

if (isset($_GET["bestellen"])) { //checkt of gebruiker van bestelpagina komt
    if ($_GET["bestellen"]) {
        $_SESSION["bestellen"] = true;
    } else {
        $_SESSION["bestellen"] = false;
    }
    header("Location: registreren.php");
    exit(0);
}

$bestaat = false;
$veldleeg = false;

if (isset($_GET["action"])) {
    if ($_GET["action"] == "registreren") {
        try {
            $klantSvc = new KlantService();
            $geregistreerd = $klantSvc->controleerGeregistreerd($_POST["email"]);
            if ($geregistreerd) {
                $bestaat = true; //error handling
            } else {
                if (($_POST["voornaam"] != null) && ($_POST["achternaam"] != null) && ($_POST["straat"] != null) && ($_POST["huisnummer"] != null) && ($_POST["postcode"] != null) && ($_POST["woonplaats"] != null) && ($_POST["telefoon"] != null) && ($_POST["email"] != null) && ($_POST["wachtwoord"] != null)) {
                    $klantSvc->createKlant($_POST["achternaam"], $_POST["voornaam"], $_POST["straat"], $_POST["huisnummer"], $_POST["postcode"], $_POST["woonplaats"], $_POST["telefoon"], $_POST["email"], sha1($_POST["wachtwoord"]));
                    header("Location: inloggen.php");
                    exit(0);
                } else {
                    if (($_POST["voornaam"] == null) || ($_POST["achternaam"] == null) || ($_POST["straat"] == null) || ($_POST["huisnummer"] == null) || ($_POST["postcode"] == null) || ($_POST["woonplaats"] == null) || ($_POST["telefoon"] == null) || ($_POST["email"] == null) || ($_POST["wachtwoord"] == null) || ($_POST["wachtwoordCheck"] == null)) {
                        $veldleeg = true; //error handling
                    }
                }
            }
        } catch (PDOException $dbe) {
            $databaseError = "Registreren is op dit moment niet mogelijk.";
        }
    }
}

/* Niet gedefiniëerde variabele een waarde geven om notice te voorkomen */

if (!isset($_SESSION["aangemeld"])) {
    $_SESSION["aangemeld"] = false;
}

error_reporting(E_ALL & ~E_NOTICE);

$view = $twig->render("registratieform.twig", array("aangemeld" => $_SESSION["aangemeld"], "bestaat" => $bestaat, "veldleeg" => $veldleeg, "databaseError" => $databaseError));
print($view);
