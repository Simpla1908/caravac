<?php

// Initialisation de la session
//session_start();
include('../bdd/connexion.php');

$requete = $bdd->prepare("SELECT * FROM  t_depot AS f"
                          . " WHERE f.hotel_id=:hotel_id ORDER BY libelle");

$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->execute();
$depots = $requete-> fetchAll(PDO::FETCH_OBJ);
