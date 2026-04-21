<?php
$json = array();
$json['s'] = False;
$json['message'] = '';
$site_id = $_SESSION['id_hotel'];
$hr_1 = '00:00:00';
$hr_2 = '05:00:00';
$hr_operation = date('H:i:s');
if ($do == 'liste') {
    $dte1 = $dte2 = date('Y-m-d');
    $depenses = SelectDepense($site_id, $dte1, $dte2, $bdd);
    include($pathview . 'depense/listedepense.php');
} elseif ($do == 'listeajx') {
    $periode = $_POST['periode'];
    $id_sousresto = $_POST['sousresto_id'];
    /* Conversion periode */
    $transpostion_periode = explode(' ', $periode);
    $date1 = $transpostion_periode[0];
    $caractere = $transpostion_periode[1];
    $date2 = $transpostion_periode[2];
    /* Conversion date1 */
    $transpostion_date1 = explode('/', $date1);
    $jour = $transpostion_date1[0];
    $mois = $transpostion_date1[1];
    $annee = $transpostion_date1[2];
    $date_bd1 = $annee . '-' . $mois . '-' . $jour;
    /* Conversion date2 */
    $transpostion_date2 = explode('/', $date2);
    $jour2 = $transpostion_date2[0];
    $mois2 = $transpostion_date2[1];
    $annee2 = $transpostion_date2[2];
    $date_bd2 = $annee2 . '-' . $mois2 . '-' . $jour2;
    $depenses = SelectDepense($site_id, $date_bd1, $date_bd2, $bdd);
    include($pathview . 'depense/depensedata.php');
} elseif ($do == 'libelles') {
    $libelles = SelectLibelleDepense($site_id, $bdd);
    include($pathview . 'depense/libelles.php');
} elseif ($do == 'addlibelle') {
    $designation = $_POST['designation'];
    if (empty($designation)) {
        $json['message'] = 'Champ designation ne peut etre vide!';
    } else {
        $code = '';
        AddLibelleDepense($code, $designation, $site_id, $bdd);
        $json['message'] = 'Enregistrement reussi!';
        $json['s'] = True;
    }
    echo json_encode($json);
} elseif ($do == 'selectlibelle') {
    $libelles = SelectLibelleDepense($site_id, $bdd);
    include($pathview . 'depense/libelledata.php');
} elseif ($do == 'adddepense') {
    $dte = date('Y-m-d');
    $service = 'restaurant';
    $sousresto_id = $_SESSION['id_sousresto'];
    $dte_dep = dateToformatBdd(trim($_POST['dte_dep']));
    //Ajustement pour des ventes tardives
    if ($hr_operation >= $hr_1 && $hr_operation <= $hr_2) {
        $dte_dep = ReduiceDaysToDate($dte, 1);
    }
    $solde = GetCaffOfDayResto($bdd);
    $libelle = 'depense';
    $num_cmd = getnumerotation($_SESSION['id_hotel'], $libelle, $bdd);
    $numero = format_numero($num_cmd);
    $libelle_id = $_POST['libelle_id'];
    $motif = $_POST['motif'];
    $cdf = $_POST['depcdf'];
    $usd = $_POST['depusd'];
    $taux = $_SESSION['taux_resto'];
    $user_id = $_SESSION['id_user'];
    $montantsaisi = $usd * $taux + $cdf;
    if($solde['usd']<0)$solde['usd']=0;
    if($solde['cdf']<0)$solde['cdf']=0;
    $totcaisse = $solde['usd'] * $taux + $solde['cdf'];
    // echo 'solde usd '.$solde['usd'];
    // echo 'solde cdf '.$solde['cdf'];
    // echo 'taux '.$taux;
    // echo 'montantsaisi '.$montantsaisi;
    // echo 'cdf '.$cdf;
    // echo 'usd '.$usd;

    if ($cdf == '' || $cdf < 0) {
        $cdf = 0;
    }
    if ($usd == '' || $usd < 0) {
        $usd = 0;
    }
    if ($cdf == 0 && $usd == 0) {
        $json['message'] = 'Renseigner montant à decaisser!';
    } else if (arrondir($montantsaisi) > arrondir($totcaisse)) {
        $totcaisse = montant_equivalent_bdd(getsymbole_local(), $_SESSION['m_affiche'], $taux, $totcaisse);
        $json['message'] = 'La somme de deux montants saisis doit être égale à ' . afficheMontant($_SESSION['m_affiche'], $totcaisse);
    } elseif ($cdf > arrondir($solde['cdf'])) {
        $json['message'] = "Montant CDF à décaisser doit être inférieur à" . afficheMontant(getsymbole_local(), $solde['cdf']);
        $boolfc_usd = true;
    } elseif ($usd > arrondir($solde['usd'])) {
        $json['message'] = "Montant USD à décaisser doit être inférieur à" . afficheMontant(getsymbole_devise(), $solde['usd']);
        $boolfc_usd = true;
    } else {
        $depense_id = AddDepense($numero, $dte_dep, $motif, $usd, $cdf, $taux, $user_id, $libelle_id, $service, $sousresto_id, $site_id, $bdd);
        $num_cmd += 1;
        setnumerotation($_SESSION['id_hotel'], $libelle, $num_cmd, $bdd);
        $json['depense_id'] = $depense_id;
        $json['message'] = 'Operation reussi!';
        $json['s'] = True;
    }
    echo json_encode($json);
} elseif ($do == 'updatedepense') {
    // $dte = date('Y-m-d');
    //$service = 'restaurant';
    $sousresto_id = $_SESSION['id_sousresto'];
    // $dte_dep = dateToformatBdd(trim($_POST['dte_dep']));
    //Ajustement pour des ventes tardives
    // if ($hr_operation >= $hr_1 && $hr_operation <= $hr_2) {
    //     $dte_dep = ReduiceDaysToDate($dte, 1);
    // }
    $solde = GetCaffOfDayResto($bdd);
    // $libelle = 'depense';
    // $num_cmd = getnumerotation($_SESSION['id_hotel'], $libelle, $bdd);
    // $numero = format_numero($num_cmd);
    $depense_id = $_POST['depense_id'];
    $libelle_id = $_POST['libelle_id'];
    $motif = $_POST['motif'];
    $cdf = $_POST['depcdf'];
    $usd = $_POST['depusd'];
    $taux = $_SESSION['taux_resto'];
    $user_id = $_SESSION['id_user'];
    $montantsaisi = $usd * $taux + $cdf;
    $totcaisse = $solde['usd'] * $taux + $solde['cdf'];
    if ($cdf == '' || $cdf < 0) {
        $cdf = 0;
    }
    if ($usd == '' || $usd < 0) {
        $usd = 0;
    }
    if ($cdf == 0 && $usd == 0) {
        $json['message'] = 'Renseigner montant à decaisser!';
    } else if (arrondir($montantsaisi) > arrondir($totcaisse)) {
        $totcaisse = montant_equivalent_bdd(getsymbole_local(), $_SESSION['m_affiche'], $taux, $totcaisse);
        $json['message'] = 'La somme de deux montants saisis doit être égale à ' . afficheMontant($_SESSION['m_affiche'], $totcaisse);
    } elseif ($cdf > arrondir($solde['cdf'])) {
        $json['message'] = "Montant CDF à décaisser doit être inférieur à" . afficheMontant(getsymbole_local(), $solde['cdf']);
        $boolfc_usd = true;
    } elseif ($usd > arrondir($solde['usd'])) {
        $json['message'] = "Montant USD à décaisser doit être inférieur à" . afficheMontant(getsymbole_devise(), $solde['usd']);
        $boolfc_usd = true;
    } else {
        // $depense_id = AddDepense($numero, $dte_dep, $motif, $usd, $cdf, $taux, $user_id, $libelle_id, $service, $sousresto_id, $site_id, $bdd);
        $requete = $bdd->prepare("UPDATE depenses SET motif =:motif,usd=:usd,cdf =:cdf,taux =:taux,user_id =:user_id,libelle_id =:libelle_id  WHERE id=:id");
        $requete->BindParam(':motif', $motif);
        $requete->BindParam(':usd', $usd);
        $requete->BindParam(':cdf', $cdf);
        $requete->BindParam(':taux', $taux);
        $requete->BindParam(':user_id', $user_id);
        $requete->BindParam(':libelle_id', $libelle_id);
        $requete->BindParam(':id', $depense_id);
        $requete->execute();
        // $num_cmd += 1;
        // setnumerotation($_SESSION['id_hotel'], $libelle, $num_cmd, $bdd);
        $json['depense_id'] = $depense_id;
        $json['message'] = 'Operation reussi!';
        $json['s'] = True;
    }
    echo json_encode($json);
} elseif ($do == 'deldepense') {
    $depense_id = $_GET['depense_id'];
    $query = $bdd->prepare("DELETE FROM depenses WHERE id=:depense_id");
    $query->BindParam(':depense_id', $depense_id);
    $query->execute();
    $json['message'] = 'Operation reussi!';
    $json['s'] = True;
    echo json_encode($json);
}
