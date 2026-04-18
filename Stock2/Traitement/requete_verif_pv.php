<?php

// Initialisation de la session
if (!isset($_SESSION)) {
    session_start();
}
$json = array();
include('../bdd/connexion.php');
$famille_id= $_POST['idfamille'];
$requete = $bdd->prepare("SELECT affichage,plat FROM  stk_famille AS f"
                          . " WHERE f.hotel_id=:hotel_id AND f.idfamille=:famille_id");

    $requete->BindParam(':hotel_id',$_SESSION['id_hotel']);
	$requete->BindParam(':famille_id',$famille_id);
	$requete->execute();
	$famille_aff = $requete-> fetchAll(PDO::FETCH_OBJ);
	foreach ($famille_aff  as $aff):
	$affichage=$aff->affichage;
        $plat=$aff->plat;
	endforeach;
$json['affichage'] = $affichage;
$json['plat'] = $plat;
//echo $affichage;
//echo $plat;
echo json_encode($json);