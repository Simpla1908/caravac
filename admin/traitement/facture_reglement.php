<?php
include '../../bdd/connexion.php';
include('./fonctionalites.php');
$json = array();
$json['message'] ='';
if (!empty($_POST['mode_rglmt']) && !empty($_POST['montant_paye']) && !empty($_POST['mont_tot'])) {
    
    if (is_numeric($_POST['montant_paye'])) {
         $data['id_fact'] = $_POST['id_fact'];
         $data['montant_paye'] = $_POST['montant_paye'];
         $data['montant_fac'] = $_POST['montant_fac'];
         $data['mode_rglmt'] = $_POST['mode_rglmt'];
         reglementFactureSimple($data,$bdd);
         $acompte=getAvanceFacture($data, $bdd);
         $json['mont_regl']=round( $data['montant_fac'] - $acompte,2);
    }  else {
        $json['message'] = "Veuiller saisir une valeur numérique!";
    }
}else {
    $json['message'] = "Problème d'envoi du formulaire !";
}
echo json_encode($json);  