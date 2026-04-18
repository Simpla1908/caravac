<?php

if (!isset($_SESSION)) {
    session_start();
}
// Inclusion du fichier contenant la connexion à la base
require '../bdd/connexion.php';
$json = array();
 $json['verif']='non';
include './Amelioration/reglage/recuperer_valeurs_reglages.php';

date_default_timezone_set('Europe/Paris');
$dte=  date('H:i:s');
$temps_actuel = $dte;
if ($temps_actuel == $temps_sortie) {
     $json['verif']='oui';
}
 
echo json_encode($json);