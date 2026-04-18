<?php
session_start();
include '../../bdd/connexion.php';
include '../Amelioration/reglage/recuperer_valeurs_reglages.php';
include '../../FUNCTION/hebergement.php';
$taux = $tauxdollar;
$json = array();
if ($_POST['user_id'] == 0) {
    $json['message'] = 'usernoselect';
} else if (empty($_POST['montant_aff']) && empty($_POST['montant_cdf']) && empty($_POST['montant_usd'])) {
    $json['message'] = 'montantvide';
} else {
    $montant_cdf = $_POST['montant_cdf'];
    $montant_usd = $_POST['montant_usd'];
    $montant = $_POST['montant_tot_calc'];
    $paie_id = $_POST['paie_id'];
    $mont_converti=$montant_cdf+montant_equivalent_bdd(getsymbole_devise(),getsymbole_local(),$tauxdollar,$montant_usd);
    //verification montant saisi
//    if($mont_converti<=$montant) {
    $user_vers =$_POST['user_id'];
    $type_vers='hergement';
    $motif='hergement';
    $motif_id_resto =$_POST['libelle'];
	$_SESSION['nomlibelle']=$_POST['nomlibelle'];
    $id_hotel=$_SESSION['id_hotel'];
    $user_id =$_SESSION['id_user'];
    $date_h_com = date('Y-m-d H:i:s');
    $date_com = date('Y-m-d');
    $mont_commandeFC2 =$montant_cdf;
    $mont_commandeUSD=$montant_usd;
    include './insertion_caisse.php';
    insertmontantVersement($user_vers,$date_com,$montant_cdf*(-1),$montant_usd*(-1),$m_affiche,$type_vers,$tauxdollar,$motif,$id_hotel,$bdd);
    $json['message'] = 'OK';
    $_SESSION['montant_usd']=$montant_usd;
    $_SESSION['montant_cdf']=$montant_cdf;     
    
    
    //Billetage
    //USD
    $_SESSION['100usd']=$_POST['100usd'];
    $_SESSION['50usd']=$_POST['50usd'];
    $_SESSION['20usd']=$_POST['20usd'];
    $_SESSION['10usd']=$_POST['10usd'];
    $_SESSION['5usd']=$_POST['5usd'];
    $_SESSION['1usd']=$_POST['1usd'];
    
    //CDF
    $_SESSION['20000cdf']=$_POST['20000cdf'];
    $_SESSION['10000cdf']=$_POST['10000cdf'];
    $_SESSION['5000cdf']=$_POST['5000cdf'];
    $_SESSION['1000cdf']=$_POST['1000cdf'];
    $_SESSION['500cdf']=$_POST['500cdf'];
    $_SESSION['200cdf']=$_POST['200cdf'];
    
//    } else {
//        $json['message'] = 'montantnocorrect';
//    }
}

echo json_encode($json);


