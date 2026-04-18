<?php

// Initialisation de la session
session_start();
include('../bdd/connexion.php');
if (isset($_POST['idfamille']) && isset($_POST['plat'])) {
    
    $plat=$_POST['plat'];
    $idfamille=$_POST['idfamille'];
    $requete = $bdd->prepare("UPDATE stk_famille SET plat =:plat WHERE idfamille=:idfamille AND hotel_id=:hotel_id");
    $requete->BindParam(':plat', $plat);
    $requete->BindParam(':idfamille', $idfamille);
    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->execute();
//    echo 'ok';
} 



