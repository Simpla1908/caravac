<?php

// Initialisation de la session
session_start();
include('../bdd/connexion.php');
if (isset($_POST['id_depot']) && isset($_POST['id_prod']) && isset($_POST['affichage'])) {
    
    $affichage=$_POST['affichage'];
    $id_depot=$_POST['id_depot'];
    $id_prod=$_POST['id_prod'];
    
    $requete = $bdd->prepare("UPDATE stk__mouvement SET en_vente =:en_vente WHERE depot_id=:depot_id AND produit_id=:produit_id AND hotel_id=:hotel_id");
    $requete->BindParam(':en_vente', $affichage);
    $requete->BindParam(':depot_id', $id_depot);
    $requete->BindParam(':produit_id', $id_prod);
    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->execute();
//    echo 'ok';
} 



