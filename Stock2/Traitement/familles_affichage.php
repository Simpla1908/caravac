<?php

// Initialisation de la session
//session_start();
include('../bdd/connexion.php');

$requete = $bdd->prepare("SELECT * FROM  stk_famille AS f WHERE f.hotel_id=:hotel_id AND f.plat=0 AND f.pseudo_supp=0 ORDER BY designation");

$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->execute();
$familles = $requete-> fetchAll(PDO::FETCH_OBJ);
