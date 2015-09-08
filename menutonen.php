<?php

use Doctrine\Common\ClassLoader;
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
try {
    $productSvc = new ProductService();
    $menu = $productSvc->getAllProducts();
} catch (PDOException $dbe) {
    $databaseError = "Het menu kan niet geladen worden.";
}

if (isset($_SESSION["aangemeld"])) {//checkt of er een klant is aangemeld
    if ($_SESSION["aangemeld"]) {
        $klant = KlantService::getKlantById($_SESSION["klant"]);
    }
}

if (isset($_GET["product"])) {
    try {
        $productId = $_GET["product"];
        $_SESSION["winkelmandje"][] = $productSvc->getProductById($productId); /* zet de gekozen producten in een array winkelmandjes mbv een session variabele */
        if (isset($klant) && $klant->getPromotie() == 1) { // checkt of klant promotie krijgt
            $_SESSION["prijs"] += $productSvc->getProductById($productId)->getPromotie();
        } else {
            $_SESSION["prijs"] += $productSvc->getProductById($productId)->getPrijs();
        }

        header("Location: menutonen.php"); /* opnieuw uitvoeren van bovenstaande code bij verversen tegen te gaan */
        exit(0);
    } catch (PDOException $dbe) {
        header("Location: updateboek.php?error=dbe");
        print($dbe);
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

    header("Location: menutonen.php");
    exit(0);
}

if (isset($_GET["action"])) { //checkt of er uitgelogd wordt
    if ($_GET["action"] == uitloggen) {
        $_SESSION["aangemeld"] = false;
        unset($_SESSION["winkelmandje"]);
        $_SESSION["prijs"] = 0;

        header("Location: menutonen.php");
        exit(0);
    }
}


if (empty($_SESSION["winkelmandje"])) { // Zorgt voor niet tonen van winkelmandje als dat leeg is
    $leeg = true;
} else {
    $leeg = false;
}

/* Alle niet gedefiniëerde variabelen een waarde geven om notice te voorkomen */
if (!isset($klant)) {
    $klant = null;
}

if (!isset($_SESSION["winkelmandje"])) {
    $_SESSION["winkelmandje"] = null;
}

if (!isset($_SESSION["aangemeld"])) {
    $_SESSION["aangemeld"] = false;
}

if (!isset($_SESSION["prijs"])) {
    $_SESSION["prijs"] = 0;
}

error_reporting(E_ALL & ~E_NOTICE);

$view = $twig->render("menu.twig", array("menu" => $menu, "winkelmandje" => $_SESSION["winkelmandje"],
    "totaalprijs" => $_SESSION["prijs"], "leeg" => $leeg, "aangemeld" => $_SESSION["aangemeld"], "klant" => $klant, "databaseError" => $databaseError));
print($view);
