<?php

use Doctrine\Common\ClassLoader;
use PizzeriaProject\Business\BestellingService;
use PizzeriaProject\Business\BestregService;

require_once("libraries/Doctrine/Common/ClassLoader.php");
require_once("libraries/Twig/Autoloader.php");

Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem("src/PizzeriaProject/presentation");
$twig = new Twig_Environment($loader);

$classLoader = new ClassLoader("PizzeriaProject", "src");
$classLoader->register();

session_start();

if (isset($_GET["action"])) {
    if ($_GET["action"] == uitloggen) {
        $_SESSION["aangemeld"] = false;
        unset($_SESSION["winkelmandje"]);
        $_SESSION["prijs"] = 0;

        header("Location: afrekenen.php");
        exit(0);
    }
}

if (isset($_GET["besteld"])) {
    $bestelcheck = true;
    $bestellingId = BestellingService::createBestelling($_SESSION["klant"], $_SESSION["prijs"], date("Y-m-d - H:i:sa"));
    foreach ($_SESSION["winkelmandje"] as $product) {
        BestregService::createBestreg($bestellingId, $product->getId(), $product->getPrijs());
    }
    header("Location: afrekenen.php");
}

if (!isset($_SESSION["aangemeld"])) {
    $_SESSION["aangemeld"] = false;
}

if (!isset($bestelcheck)){
    $bestelcheck = false;
}

$view = $twig->render("afrekening.twig", array("winkelmandje" => $_SESSION["winkelmandje"],
    "totaalprijs" => $_SESSION["prijs"], "aangemeld" => $_SESSION["aangemeld"], "bestelcheck" => $bestelcheck));
print($view);
