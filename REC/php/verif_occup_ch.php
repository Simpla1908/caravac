<?php
session_start();
include_once '../../bdd/connexion.php';
include_once '../../FUNCTION/hebergement.php';
$json = array();
$idchambre = $_GET['idchambre'];
$bool_chamb_occup=0;
if(StatutChambre($idchambre,$bdd)=='occupe'){
    $bool_chamb_occup=1;
}
$json['bool_chamb_occup'] = $bool_chamb_occup;
echo json_encode($json);
?>
