<?php

include '../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
if (!empty($_GET['id']) && !empty($_GET['idmodcomp'])) {
    $hotel_id = $_GET['id'];
    $company_id = $_GET['idmodcomp'];
} else {
    $company_id = 0;
    $hotel_id = 0;
}
 
$requete = $bdd->prepare($req_factureByhotel);
$requete->BindParam(':id_c', $hotel_id);
$requete->execute();
$resultats = $requete->fetchAll(PDO::FETCH_OBJ);


