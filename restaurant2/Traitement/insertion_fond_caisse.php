<?php

session_start();
include '../bdd/connexion.php';
include '../../FUNCTION/restaurant.php';
$json = array();
$json['message'] = '';
$montantusd = $_POST['montantusd'];
$montantcdf = $_POST['montantcdf'];
$motif = $_POST['fdcmotif'];
$user_id = $_SESSION['id_user'];
$id_hotel = $_SESSION['id_hotel'];
$sousresto_id = $_SESSION['id_sousresto'];
$dte = date('Y-m-d');
$hr = date('H:i:s');
$type = 'restaurant';
if (($montantusd == '' || $montantcdf == '') || ($montantusd == 0 && $montantcdf == 0)) {
    $json['message'] = 'vide';
} else {
    if ($montantusd == '') {
        $montantusd = 0;
    } elseif ($montantcdf == '') {
        $montantcdf = 0;
    }
 //$idfdc = VerifInsertFDCJrs($sousresto_id, $dte, $bdd);
  //if ($idfdc == 0) {
        $requete = $bdd->prepare("INSERT INTO fondscaisse (user_id,usd,cdf,sousresto_id,hotel_id,dte,hr,type,motif)
                                VALUES(:user_id,:usd,:cdf,:sousresto_id,:hotel_id,:dte,:hr,:type,:motif)");

        $requete->BindParam(':user_id', $user_id);
        $requete->BindParam(':usd', $montantusd);
        $requete->BindParam(':cdf', $montantcdf);
        $requete->BindParam(':sousresto_id', $sousresto_id);
        $requete->BindParam(':hotel_id', $id_hotel);
        $requete->BindParam(':dte', $dte);
        $requete->BindParam(':hr', $hr);
        $requete->BindParam(':type', $type);
        $requete->BindParam(':motif', $motif);
        $requete->execute();
        $json['message'] = 'succes';
  // } else {
  //    $json['message'] = 'deja';
  // }
}
echo json_encode($json);


