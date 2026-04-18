<?php

// Initialisation de la session
session_start();
include('../bdd/connexion.php');
if (isset($_POST['idfamille']) && isset($_POST['affichage'])) {
    
    $affichage=$_POST['affichage'];
    $idfamille=$_POST['idfamille'];
    $requete = $bdd->prepare("UPDATE stk_famille SET fiche_tech =:fiche_tech WHERE idfamille=:idfamille AND hotel_id=:hotel_id");
    $requete->BindParam(':fiche_tech', $affichage);
    $requete->BindParam(':idfamille', $idfamille);
    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->execute();
//    echo 'ok';
} 



