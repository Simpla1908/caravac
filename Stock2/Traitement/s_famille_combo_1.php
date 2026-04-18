<?php

// Initialisation de la session

include('../bdd/connexion.php');

$requete = $bdd->prepare("SELECT * FROM  stk_sous_famille AS s_f WHERE s_f.hotel_id=:hotel_id AND s_f.id_s_fam<>:s_famille_id ORDER BY s_f.des");
//session à enlever
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->BindParam(':s_famille_id',$prod->id_s_fam );
$requete->execute();
$s_familles = $requete-> fetchAll(PDO::FETCH_OBJ);

