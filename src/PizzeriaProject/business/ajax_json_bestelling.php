<?php
use Doctrine\Common\ClassLoader;
use PizzeriaProject\Business\BestellingService;
use PizzeriaProject\Business\BestregService;
use PizzeriaProject\Business\ProductService;

require_once("../../../libraries/Doctrine/Common/ClassLoader.php");
$classLoader = new ClassLoader("PizzeriaProject", "../../../src");
$classLoader->register();

session_start();

$BS = new BestellingService();
$BRS = new BestregService();
$PS = new ProductService(); 

if (isset($_SESSION["klant"])) {
    $bestelling = $BS->getBestelling($_SESSION["klant"]);
    $bestregs = $BRS->getBestreg($bestelling->getId());
    
}

$bestel = array("ID"=>$bestelling->getID(),"Totaal"=>$bestelling->getPrijs());

foreach ($bestregs as $i=>$bestreg){
    $product = $PS->getProductById($bestreg->getProductId());
    $bestelregel = new stdClass();
    $bestelregel->Id = $bestreg->getId();
    $bestelregel->Product = $product->getNaam();
    $bestelregel->Prijs = $bestreg->getPrijs();
    $bestel["Bestelregels"][] = $bestelregel;
}
echo json_encode($bestel);