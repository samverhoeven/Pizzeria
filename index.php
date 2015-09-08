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

if(isset($_GET["action"])){ //checkt of er uitgelogd wordt
    if($_GET["action"] == uitloggen){
        $_SESSION["aangemeld"] = false;
        unset($_SESSION["winkelmandje"]);
        $_SESSION["prijs"] = 0;
        
        header("Location: index.php");
        exit(0);
    }
}

/* Niet gedefiniëerde variabele een waarde geven om notice te voorkomen */

if(!isset($_SESSION["aangemeld"])){
    $_SESSION["aangemeld"] = false;
}

error_reporting(E_ALL & ~E_NOTICE);

$view = $twig->render("index.twig", array("aangemeld" => $_SESSION["aangemeld"]));
print($view);
