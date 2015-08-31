<?php

use Doctrine\Common\ClassLoader;
use PizzeriaProject\Business\ProductService;

require_once("libraries/Doctrine/Common/ClassLoader.php");
require_once("libraries/Twig/Autoloader.php");

Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem("src/PizzeriaProject/presentation");
$twig = new Twig_Environment($loader);

$classLoader = new ClassLoader("PizzeriaProject", "src");
$classLoader->register();

session_start();

$productSvc = new ProductService();
$menu = $productSvc->getAllProducts();

if(isset($_GET["verwijder"])){
    $verwijder = $_GET["verwijder"];  
    $verwijderId = $_SESSION["winkelmandje"][$verwijder]->getId(); /* id van product dmv key uit de array winkelmandje */
    $_SESSION["prijs"] -= $productSvc->getProductById($verwijderId)->getPrijs();
    unset($_SESSION["winkelmandje"][$verwijder]); 
    
    header("Location: winkelmandjetonen.php");
    exit(0);
}

if (empty($_SESSION["winkelmandje"])) {
    $leeg = true;
} else {
    $leeg = false;
}

$view = $twig->render("winkelmandje.twig", array("winkelmandje" => $_SESSION["winkelmandje"],
    "totaalprijs" => $_SESSION["prijs"], "leeg" => $leeg));
print($view);


