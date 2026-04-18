<?php

// Initialisation de la session

include('../bdd/connexion.php');

$requete = $bdd->prepare("SELECT * FROM  stk_famille AS f"
                          . " WHERE f.hotel_id=:hotel_id AND f.idfamille<>:famille_id ORDER BY designation");
//session à enlever
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->BindParam(':famille_id',$s_fam->id_s_fam);
$requete->execute();
$familles = $requete-> fetchAll(PDO::FETCH_OBJ);
