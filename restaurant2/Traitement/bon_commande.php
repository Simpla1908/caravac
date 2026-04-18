<?php
session_start();
include '../bdd/connexion.php';
$json = array();
//FC en Dollar
$requete = $bdd->prepare("SELECT tva,taux FROM  parametrage");
$requete->execute();
$operations = $requete->fetchAll(PDO::FETCH_OBJ);
foreach ($operations as $op) {
    $taux = $op->taux;
    $tva = $op->tva;
}
$cout_com = round($_SESSION['panier']['mont_ttc_remise'] / $taux, 2);
$json['mont_commande'] = $cout_com;
echo json_encode($json);
