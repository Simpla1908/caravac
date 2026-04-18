<?php
// Initialisation de la session
 if (!isset($_SESSION)) {
    session_start();
 }
include('../bdd/connexion.php');
include('../../FUNCTION/restaurant.php');
$json = array();
//$plat=1;
//$requete = $bdd->prepare("SELECT * FROM  stk_famille AS f"
//                          . " WHERE f.hotel_id=:hotel_id  AND f.plat=:plat ORDER BY designation");
////session à enlever
//$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
//$requete->BindParam(':plat', $plat);
//$requete->execute();
//$familles = $requete-> fetchAll(PDO::FETCH_OBJ);
$familles=FamillesPlat($bdd);
foreach ($familles  as $f){
    $json[$f->idfamille][] = utf8_encode(ucfirst($f->designation));
}

// envoi du résultat au success
echo json_encode($json);
