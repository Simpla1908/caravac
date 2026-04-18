<?php

// Initialisation de la session
session_start();
include('../bdd/connexion.php');
$type='fournisseur';

$requete = $bdd->prepare("SELECT * FROM t_client AS c"
                          . " WHERE c.type=:type AND c.id_hotel=:hotel_id ORDER BY nom_client");
$requete->BindParam(':type', $type);
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->execute();
$fournisseurs = $requete-> fetchAll(PDO::FETCH_OBJ);
