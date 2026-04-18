<?php

// Initialisation de la session
if (!isset($_SESSION)) {
    session_start();
}
include('../bdd/connexion.php');
$requete = $bdd->prepare("SELECT p.idprod,p.designation,p.pa FROM  stk_produit AS p,stk_sous_famille AS s_fam ,stk_famille AS fam"
    . " WHERE p.pseudo_supp=0 AND fam.fiche_tech=1 AND p.famille_id=s_fam.id_s_fam AND p.hotel_id=:hotel_id AND s_fam.famille=fam.idfamille AND fam.plat=0 ORDER BY designation");
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->execute();
$ingredients = $requete->fetchAll(PDO::FETCH_OBJ);
