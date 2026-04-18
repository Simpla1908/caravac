<?php
include '../../bdd/connexion.php';
include_once'../../FUNCTION/hebergement.php';
include_once'../traitement/fonctionalites.php';
$d=GenerationFacture($bdd);
var_dump($d);
?>

