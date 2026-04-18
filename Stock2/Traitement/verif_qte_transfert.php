<?php

// Initialisation de la session
//include('../bdd/connexion.php');
session_start();
$json = array();
$qte_dispo= $_POST['qte_dispo'];
$qte_trans= $_POST['qte_produit'];

if($qte_trans !=""){
    $test_qte_trans= 0;
    if($qte_trans > $qte_dispo){
        $test_qte_dispo= 2;
    }else{
        $test_qte_dispo= 3;
    }
}else{
    $test_qte_trans= 1;
}
$json['test_qte_trans'] = $test_qte_trans;
$json['qte_trans'] = $qte_trans;
$json['test_qte_dispo'] = $test_qte_dispo;
$json['qte_dispo'] = $qte_dispo;
echo json_encode($json);
//echo '<option value=' . $u->unite.' selected>' . ucfirst($u->unite).'</option>';
