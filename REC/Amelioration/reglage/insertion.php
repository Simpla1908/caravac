<?php

// Initialisation de la session
session_start();
$json = array();
include('../bdd/connexion .php');


if (isset($_POST['tauxdollar']) && !empty($_POST['tauxdollar']) && isset($_POST['tva']) && !empty($_POST['tva']) && isset($_POST['remise']) && !empty($_POST['remise']) && isset($_POST['majoration']) && !empty($_POST['majoration']) && isset($_POST['temps_regl']) && !empty($_POST['temps_regl']) && isset($_POST['date_regl']) && !empty($_POST['date_regl'])) {

    $tauxdollar = $_POST['tauxdollar'];
    $tva = $_POST['tva'];
    $remise = $_POST['remise'];
    $majoration = $_POST['majoration'];
    $temps_regl = $_POST['temps_regl'];
    $date_regl = $_POST['date_regl'];
     // Verification du solde avant de faire la sortie

    $transpostion_sortie = explode('/', $date_regl);
    $jrsor = $transpostion_sortie[0];
    $moisor = $transpostion_sortie[1];
    $annee1sor = $transpostion_sortie[2];
    $transpostion_sortie1 = explode(' ', $annee1sor);
    $anneesor = $transpostion_sortie1[0];
    $heuresor = $transpostion_sortie1[1];
    $date_heure_bon = $anneesor . '/' . $moisor . '/' . $jrsor . ' ' . $heuresor;
    $date_bon = $anneesor . '-' . $moisor . '-' . $jrsor;
    /* Fin Conversion date d'arrive */


    $requete = $bdd->prepare("INSERT INTO t_reglage (remise,majoration,date_regl,temps_regl,tauxdollar,tva,user_id,dte_h)
							 VALUES(:remise,:majoration,:date_regl,:temps_regl,:tauxdollar,:tva,:user_id,:dte_h)");
    $requete->BindParam(':remise', $remise);
    $requete->BindParam(':majoration', $majoration);
    $requete->BindParam(':date_regl', $date_bon);
    $requete->BindParam(':temps_regl', $temps_regl);
    $requete->BindParam(':tauxdollar', $tauxdollar);
    $requete->BindParam(':tva', $tva);
    $requete->BindParam(':user_id', $_SESSION['id_user']);
    $requete->BindParam(':dte_h',$date_heure_bon);
    $requete->execute();
    $json['message'] = 'OK';
}  else {
    $json['message'] = 'NO';
}

echo json_encode($json);
