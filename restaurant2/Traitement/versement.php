<?php
session_start();
include '../../bdd/connexion.php';
include '../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
include '../../FUNCTION/hebergement.php';
$json = array();
if (empty($_POST['montant_cdf']) && empty($_POST['montant_usd'])) {
    $json['message'] = 'montantvide';
} else if ($_POST['montant_cdf'] < 0) {
    $json['message'] = 'montantnocorrectcdf';
    $json['mont'] = $_POST['averser_cdf'];
} else if ($_POST['montant_usd'] < 0) {
    $json['message'] = 'montantnocorrectusd';
    $json['mont'] = $_POST['averser_usd'];
} 
/* else if ($_POST['montant_cdf'] < $_POST['averser_cdf'] ) {
    $json['message'] = 'montantnocorrectusd';
    $json['mont'] = $_POST['averser_usd'];
} else if ($_POST['montant_cdf'] < $_POST['averser_cdf']|| $_POST['montant_cdf'] > $_POST['averser_cdf']) {
    $json['message'] = 'montantnocorrectcdf1';
    $json['mont'] = $_POST['averser_cdf'];
}
else if ($_POST['montant_usd'] < $_POST['averser_usd'] || $_POST['montant_usd'] > $_POST['averser_usd']) {
    $json['message'] = 'montantnocorrectusd1';
    $json['mont'] = $_POST['averser_usd'];
} */
else {

    $montant_cdf = $_POST['montant_cdf'];
    $montant_usd = $_POST['montant_usd'];
    $motif_id_resto = '';
    $paie_id = '';
    $type_vers = 'restaurant';
    $motif = 'restaurant';
    $id_hotel = $_SESSION['id_hotel'];
    $user_vers = $_SESSION['id_user'];
    $id_sousresto = $_SESSION['id_sousresto'];
    $dte = $_POST['dtevers'];
    $lib = 'BV';
    $num_cmd = getnumerotation2($id_sousresto, $lib, $bdd);
    $num_cmd_format = format_numero($num_cmd);
    $numbon = $num_cmd_format;

    /* $fdcl_usd=$_POST['fdcl_usd'];
    $fdcl_cdf=$_POST['fdcl_cdf']; */
    $fdcl_usd=0;
    $fdcl_cdf=0;
    insertmontantVersement($user_vers, $dte, $montant_cdf, $montant_usd, $m_affiche, $type_vers, $tauxdollar, $motif, $paie_id, $id_hotel, $id_sousresto, $numbon,$fdcl_usd,$fdcl_cdf, $bdd);
    setnumerotation2($id_sousresto, $lib, $num_cmd + 1, $bdd);

    

    //REPORT FONDS DE CAISSE

    /* if ($_POST['montant_cdf'] < $_POST['averser_cdf'] || $_POST['montant_usd'] <  $_POST['averser_usd']) {
        $hr = date('H:i:s');
        $type = 'restaurant';
        $montantusd = $_POST['averser_usd'] - $_POST['montant_usd'];
        $montantcdf = $_POST['averser_cdf'] - $_POST['montant_cdf'];
        $requete = $bdd->prepare("INSERT INTO reportcaisse (user_id,usd,cdf,sousresto_id,hotel_id,dte,hr,type)
                                VALUES(:user_id,:usd,:cdf,:sousresto_id,:hotel_id,:dte,:hr,:type)");

        $requete->BindParam(':user_id',  $user_vers);
        $requete->BindParam(':usd', $montantusd);
        $requete->BindParam(':cdf', $montantcdf);
        $requete->BindParam(':sousresto_id', $id_sousresto);
        $requete->BindParam(':hotel_id', $id_hotel);
        $requete->BindParam(':dte', $dte);
        $requete->BindParam(':hr', $hr);
        $requete->BindParam(':type', $type);
        $requete->execute();
    } */
    //UPDATE FONDS DE CAISSE

    $verse = 1;

    $requete = $bdd->prepare("UPDATE fondscaisse SET verse=:verse WHERE user_id=:user_id AND dte=:dte");
    $requete->BindParam(':verse', $verse);
    $requete->BindParam(':user_id', $user_vers);
    $requete->BindParam(':dte', $dte);

    $requete->execute();

    $json['message'] = 'OK';
    $_SESSION['numero_vers'] = $numbon;
    $_SESSION['montant_usd'] = $montant_usd;
    $_SESSION['montant_cdf'] = $montant_cdf;
    //Billetage
    //USD
    $_SESSION['100usd'] = $_POST['100usd'];
    $_SESSION['50usd'] = $_POST['50usd'];
    $_SESSION['20usd'] = $_POST['20usd'];
    $_SESSION['10usd'] = $_POST['10usd'];
    $_SESSION['5usd'] = $_POST['5usd'];
    $_SESSION['1usd'] = $_POST['1usd'];

    //CDF
    $_SESSION['20000cdf'] = $_POST['20000cdf'];
    $_SESSION['10000cdf'] = $_POST['10000cdf'];
    $_SESSION['5000cdf'] = $_POST['5000cdf'];
    $_SESSION['1000cdf'] = $_POST['1000cdf'];
    $_SESSION['500cdf'] = $_POST['500cdf'];
    $_SESSION['200cdf'] = $_POST['200cdf'];
    $_SESSION['100cdf'] = $_POST['100cdf'];
    $_SESSION['50cdf'] = $_POST['50cdf'];

    //Initialisation importante
   /*  $_SESSION['tot_mont_devise'] = $_SESSION['verser_usd'] + $_SESSION['montant_usd'];
    $_SESSION['tot_mont_locale'] = $_SESSION['verser_cdf'] + $_SESSION['montant_cdf']; */

    $_SESSION['tot_mont_devise'] =$_SESSION['montant_usd'];
    $_SESSION['tot_mont_locale'] =$_SESSION['montant_cdf'];
    $_SESSION['solde_devise'] = $_SESSION['solde_usd'] - $_SESSION['montant_usd'];
    $_SESSION['solde_locale'] = $_SESSION['solde_cdf'] - $_SESSION['montant_cdf'];
    //Initialisation importante
}

echo json_encode($json);