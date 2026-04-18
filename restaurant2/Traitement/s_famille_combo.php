<?php

// Initialisation de la session
include('../bdd/connexion.php');
$requete = $bdd->prepare("SELECT * FROM  stk_sous_famille AS f"
                          . " WHERE f.hotel_id=:hotel_id ORDER BY des");
//session à enlever
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->execute();
$s_familles = $requete-> fetchAll(PDO::FETCH_OBJ);

