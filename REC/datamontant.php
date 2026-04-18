<?php

// Initialisation de la session
if (!isset($_SESSION)) {
    session_start();
}
include('Amelioration/bdd/connexion .php');
include('Amelioration/reglage/recuperer_valeurs_reglages.php');
include_once '../FUNCTION/hebergement.php';
$json = array();
$user_vers=$_POST['user_id'];
$type_vers='hergement';
$data=MontantVersementheb($user_vers,$type_vers,$tauxdollar,$taux_op,$m_affiche,$bdd);
$montant_tot_vers=$data['montant_tot'];
$montant_tot_calc=$data['montant_tot_calc'];
if($montant_tot_vers<1){
    $montant_tot_vers=0;
    $montant_tot_calc=0;
}
$json['paie_id'] = $data['paie_id'];
$json['montant_vers'] = $montant_tot_vers;
$json['montant_vers_aff'] = arrondir($montant_tot_vers);
$json['montant_tot_calc'] = $montant_tot_calc;
echo json_encode($json);
?>
