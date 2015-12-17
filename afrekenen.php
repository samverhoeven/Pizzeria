<?php

use Doctrine\Common\ClassLoader;
use PizzeriaProject\Business\BestellingService;
use PizzeriaProject\Business\BestregService;
use PizzeriaProject\Business\ProductService;
use PizzeriaProject\Business\KlantService;

require_once("libraries/Doctrine/Common/ClassLoader.php");
require_once("libraries/Twig/Autoloader.php");

Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem("src/PizzeriaProject/presentation");
$twig = new Twig_Environment($loader);

$classLoader = new ClassLoader("PizzeriaProject", "src");
$classLoader->register();

session_start();

$productSvc = new ProductService();

if (isset($_SESSION["aangemeld"])) {//checkt of er een klant is aangemeld
    if ($_SESSION["aangemeld"]) {
        $klant = KlantService::getKlantById($_SESSION["klant"]);
    }
}

if (isset($_GET["action"])) { //checkt of er uitgelogd wordt
    if ($_GET["action"] == uitloggen) {
        $_SESSION["aangemeld"] = false;
        unset($_SESSION["winkelmandje"]);
        $_SESSION["prijs"] = 0;

        header("Location: afrekenen.php");
        exit(0);
    }
}

if (isset($_GET["verwijder"])) { //checkt of er een item uit winkelmandje moet verwijderd worden
    $verwijder = $_GET["verwijder"];
    $verwijderId = $_SESSION["winkelmandje"][$verwijder]->getId(); /* id van product dmv key uit de array winkelmandje */
    if (isset($klant) && $klant->getPromotie() == 1) { // checkt of klant promotie krijgt
        $_SESSION["prijs"] -= $productSvc->getProductById($verwijderId)->getPromotie();
    } else {
        $_SESSION["prijs"] -= $productSvc->getProductById($verwijderId)->getPrijs();
    }
    unset($_SESSION["winkelmandje"][$verwijder]);

    header("Location: afrekenen.php");
    exit(0);
}

if (isset($_GET["besteld"])) { //bestellingsgegevens in juiste tabellen zetten
    $bestellingId = BestellingService::createBestelling($_SESSION["klant"], $_SESSION["prijs"], date("Y-m-d - H:i:sa"));
    foreach ($_SESSION["winkelmandje"] as $product) {
        if ($klant->getPromotie() == 1) { //checkt of promotieprijs of gewone prijs aan bestreg moet meegegeven worden
            BestregService::createBestreg($bestellingId, $product->getId(), $product->getPromotie());
        } else {
            BestregService::createBestreg($bestellingId, $product->getId(), $product->getPrijs());
        }
    }
    header("Location: afrekenen.php?bestelcheck=true");
}

if (isset($_GET["bestelcheck"])) { //checkt of bestelling is geplaatst om overzicht te tonen
    $bestelcheck = true;
    unset($_SESSION["winkelmandje"]);
    $_SESSION["prijs"] = 0;
    $producten = ProductService::getAllProducts();
    $bestelling = BestellingService::getBestelling($_SESSION["klant"]);
    $bestregels = BestregService::getBestreg($bestelling->getId());
}

//if (empty($_SESSION["winkelmandje"])) { // Zorgt voor niet tonen van winkelmandje als dat leeg is
//    header("Location: winkelmandjetonen.php");
//}

/* Alle niet gedefiniëerde variabelen een waarde geven om notice te voorkomen */

if (!isset($klant)) {
    $klant = null;
}

if (!isset($bestelling)) {
    $bestelling = null;
}

if (!isset($bestregels)) {
    $bestregels = null;
}

if (!isset($producten)) {
    $producten = null;
}

if (!isset($_SESSION["aangemeld"])) {
    $_SESSION["aangemeld"] = false;
}

if (!isset($bestelcheck)) {
    $bestelcheck = false;
}

if (!isset($_SESSION["winkelmandje"])) {
    $_SESSION["winkelmandje"] = null;
}

error_reporting(E_ALL & ~E_NOTICE);

$view = $twig->render("afrekening.twig", array("winkelmandje" => $_SESSION["winkelmandje"],
    "totaalprijs" => $_SESSION["prijs"], "aangemeld" => $_SESSION["aangemeld"],
    "bestelcheck" => $bestelcheck, "bestelling" => $bestelling, "bestregels" => $bestregels,
    "producten" => $producten, "klant" => $klant, "leeg" => $leeg));
print($view);
