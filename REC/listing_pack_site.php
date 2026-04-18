<?php
if (!isset($_SESSION)) {
    session_start();
}
require '../bdd/connexion.php';
include '../admin/traitement/fonctionalites.php';
$json = array();
PackSite($_SESSION['id_hotel'],$bdd);
//variable qui compte les packs suivant :ebu hotel,ebu restaurant,ebu pos et ebu fact dans le site
$boolexistepack='ko';
$id_pack_sav=0;
$N = count($_SESSION['pack_site']['id_pack']);
for ($i = 0; $i < $N; $i++) {
        $id_pack= $_SESSION['pack_site']['id_pack'][$i];
      if($id_pack==5||$id_pack==6||$id_pack==29||$id_pack==30){
      	$boolexistepack='ok';
      	$id_pack_sav=$id_pack;
      }
 }
$json['boolexistepack'] = $boolexistepack;
$json['id_pack'] =$id_pack_sav;
echo json_encode($json);
