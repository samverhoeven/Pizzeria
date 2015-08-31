<?php

use Doctrine\Common\ClassLoader;

require_once("libraries/Doctrine/Common/ClassLoader.php");
require_once("libraries/Twig/Autoloader.php");

Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem("src/PizzeriaProject/presentation");
$twig = new Twig_Environment($loader);

$classLoader = new ClassLoader("PizzeriaProject", "src");
$classLoader->register();

session_start();

if(!isset($_SESSION["aangemeld"])){
    $_SESSION["aangemeld"] = false;
}

$view = $twig->render("afrekening.twig", array("winkelmandje" => $_SESSION["winkelmandje"],
    "totaalprijs" => $_SESSION["prijs"], "aangemeld" => $_SESSION["aangemeld"]));
print($view);