<?php

// Initialisation de la session
session_start();
include('../bdd/connexion.php');

$requete = $bdd->prepare("SELECT * FROM t_motif_type WHERE hotel_id=:hotel_id ORDER BY type");
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->execute();
$types = $requete->fetchAll(PDO::FETCH_OBJ);

foreach ($types as $type):
    echo '<option value='.$type->idmotiftype.'>'.$type->type.'</option>';
endforeach;

$requete->closeCursor();
