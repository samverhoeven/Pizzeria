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

$klantSvc = new KlantService();

if(isset($_SESSION["aangemeld"])){
    if($_SESSION["aangemeld"]){
        header("Location: index.php");
        exit(0);
    }
}

if (isset($_GET["bestellen"])) {
    if ($_GET["bestellen"]) {
        $_SESSION["bestellen"] = true;
    } else {
        $_SESSION["bestellen"] = false;
    }
    header("Location: inloggen.php");
    exit(0);
}

if (isset($_GET["action"])) {
    if ($_GET["action"] == "login") {
        $email = $_POST["email"];
        $wachtwoord = sha1($_POST["wachtwoord"]);
        $resultaat = $klantSvc->controleerKlant($email, $wachtwoord);
        if ($resultaat) {
            $_SESSION["aangemeld"] = true;
            $_SESSION["klant"] = $klantSvc->getKlantId($email);
            setcookie("emailCookie", $email);
            if (isset($_SESSION["bestellen"])) {
                if ($_SESSION["bestellen"]) {
                    $_SESSION["bestellen"] = false;
                    header("Location: afrekenen.php");
                    exit(0);
                }
            }
            header("Location: index.php");
            exit(0);
        } else {
            $geregistreerd = $klantSvc->controleerGeregistreerd($email, $wachtwoord);
            if ($geregistreerd) {
                header("Location: inloggen.php?error=foutegegevens");
            } else {
                header("Location: inloggen.php?error=bestaatniet");
            }
            exit(0);
        }
    }
}

if(!isset($_SESSION["aangemeld"])){
    $_SESSION["aangemeld"] = false;
}

if(!isset($_COOKIE["emailCookie"])){
    $_COOKIE["emailCookie"] = " ";
}

$view = $twig->render("inlogform.twig", array("aangemeld" => $_SESSION["aangemeld"], "email" => $_COOKIE["emailCookie"]));
print($view);
