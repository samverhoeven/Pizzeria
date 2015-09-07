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

if (isset($_SESSION["aangemeld"])) {
    if ($_SESSION["aangemeld"]) {
        $klant = KlantService::getKlantById($_SESSION["klant"]);
    }
}

if (isset($_GET["action"])) {
    if ($_GET["action"] == uitloggen) {
        $_SESSION["aangemeld"] = false;
        unset($_SESSION["winkelmandje"]);
        $_SESSION["prijs"] = 0;

        header("Location: afrekenen.php");
        exit(0);
    }
}

if (isset($_GET["verwijder"])) {
    $verwijder = $_GET["verwijder"];
    $verwijderId = $_SESSION["winkelmandje"][$verwijder]->getId(); /* id van product dmv key uit de array winkelmandje */
    if (isset($klant) && $klant->getPromotie() == 1) {
        $_SESSION["prijs"] -= $productSvc->getProductById($verwijderId)->getPromotie();
    } else {
        $_SESSION["prijs"] -= $productSvc->getProductById($verwijderId)->getPrijs();
    }
    unset($_SESSION["winkelmandje"][$verwijder]);

    header("Location: afrekenen.php");
    exit(0);
}

if (isset($_GET["besteld"])) {
    $bestellingId = BestellingService::createBestelling($_SESSION["klant"], $_SESSION["prijs"], date("Y-m-d - H:i:sa"));
    foreach ($_SESSION["winkelmandje"] as $product) {
        BestregService::createBestreg($bestellingId, $product->getId(), $product->getPrijs());
    }
    header("Location: afrekenen.php?bestelcheck=true");
}

if (isset($_GET["bestelcheck"])) {
    $bestelcheck = true;
    unset($_SESSION["winkelmandje"]);
    $_SESSION["prijs"] = 0;
    $producten = ProductService::getAllProducts();
    $bestelling = BestellingService::getBestelling($_SESSION["klant"]);
    $bestregels = BestregService::getBestreg($bestelling->getId());
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

$view = $twig->render("afrekening.twig", array("winkelmandje" => $_SESSION["winkelmandje"],
    "totaalprijs" => $_SESSION["prijs"], "aangemeld" => $_SESSION["aangemeld"],
    "bestelcheck" => $bestelcheck, "bestelling" => $bestelling, "bestregels" => $bestregels,
    "producten" => $producten, "klant" => $klant));
print($view);
