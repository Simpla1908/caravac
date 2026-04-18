<?php
ini_set('session.bug_compat_warn', 0);
ini_set('session.bug_compat_42', 0);
session_start();
include '../bdd/connexion.php';
include '../../FUNCTION/hebergement.php';
include '../../FUNCTION/stock.php';
include '../../FUNCTION/restaurant.php';
include '../../language/eng.php';
include '../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';

$json = array();
$json['succes'] = False;
$json['idcommande'] = 0;
$id_cmd = $_GET['id_cmd'];
$idfactcl = $_GET['idfactcl'];

if (!$id_cmd == 0) {
    $bool_addition = 0;
    $idcommande = $idfactcl;
    /* $requete = $bdd->prepare("UPDATE t_facture  SET bool_addition=:bool_addition WHERE id_fact=:id_fact");
    $requete->BindParam(':bool_addition', $bool_addition);
    $requete->BindParam(':id_fact', $idfactcl);
    $requete->execute(); */
    $json['idcommande'] = $idcommande;
    $json['succes'] = true;
}

echo json_encode($json);
