<?php
$site_id= $_SESSION['id_hotel'];
$dte1=$dte2=date('Y-m-d');
if ($do=='liste' || $do =='listeajx'){
    $result=array();
    $dte = date('Y-m-d');
    $dte1 =$dte2=$dte;
    $hr_1='00:00:00';
    $hr_2='05:00:00';
    $hr_operation=date('H:i:s');
    //Ajustement pour des ventes tardives
    if($hr_operation>=$hr_1 && $hr_operation <=$hr_2){
        $dte= ReduiceDaysToDate($dte,1) ;  
        $dte2=$dte1=$dte;
    }
    $datedebut=$dte1;
    $datefin=$dte1;
    $fond_cdf =0;
    $fond_usd =0;
    $url=$pathview.'versement/liste.php';
    if($do=='listeajx'){
        if (!empty($_POST['periode'])) {
            $periode = $_POST['periode'];
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
            $datedebut = $annee . '-' . $mois . '-' . $jour;
            /* Conversion date2 */
            $transpostion_date2 = explode('/', $date2);
            $jour2 = $transpostion_date2[0];
            $mois2 = $transpostion_date2[1];
            $annee2 = $transpostion_date2[2];
            $datefin = $annee2 . '-' . $mois2 . '-' . $jour2;
        }
        $url=$pathview.'versement/alldatafact.php';
    }
    if (in_array('VTVS', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) {
        $_SESSION['fdc']=array();
        $_SESSION['fdc']['user']=array();
        $_SESSION['fdc']['fond_cdf']=array();
        $_SESSION['fdc']['fond_usd']=array();
        $requete = $bdd->prepare("SELECT SUM(cdf) AS fond_cdf,SUM(usd) AS fond_usd,user_id
        FROM fondscaisse 
        WHERE dte BETWEEN :p_debut AND :p_fin 
        AND hotel_id=:id_hotel AND sousresto_id=:id_sousresto GROUP BY user_id,dte");
        $requete->BindParam(':p_debut', $datedebut);
        $requete->BindParam(':p_fin', $datefin);
        $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
        $requete->BindParam(':id_sousresto', $_SESSION['id_sousresto']);
        $requete->execute();
        $result = $requete->fetchAll(PDO::FETCH_OBJ);
        foreach ($result as $r) {
            $user_id = $r->user_id;
            $fond_cdf = $r->fond_cdf;
            $fond_usd = $r->fond_usd;
            if (!in_array($user_id, $_SESSION['fdc']['user'])) {
            array_push($_SESSION['fdc']['user'], $user_id);
            $_SESSION['fdc']['fond_cdf'][$user_id]=$fond_cdf;
            $_SESSION['fdc']['fond_usd'][$user_id]=$fond_usd;
            }
        }
		$requete2=$bdd->prepare("SELECT e.solde_virtuel,e.balance,SUM(e.montant_vers) AS cdf,SUM(e.montantusd) AS usd,e.user_vers,e.date_vers,e.id_sousresto,d.nom_user,d.prenom_user
        FROM t_versement AS e,t_utilisateur AS d
        WHERE e.user_vers=d.id_user
			  AND e.type_vers='restaurant'
	         AND e.id_sousresto=:id_sousresto 
             AND e.date_vers BETWEEN :p_debut AND :p_fin 
        GROUP BY e.user_vers,e.date_vers");
        $requete2->BindParam(':p_debut',$datedebut);
        $requete2->BindParam(':p_fin',$datefin);
        $requete2->BindParam(':id_sousresto', $_SESSION['id_sousresto']);
        $requete2->execute();
        $result = $requete2->fetchAll(PDO::FETCH_OBJ);
    } 
    elseif (in_array('VSPVS', $_SESSION['actions']['code_actions'])) {
        $requete = $bdd->prepare("SELECT SUM(cdf) AS fond_cdf,SUM(usd) AS fond_usd
        FROM fondscaisse 
        WHERE dte BETWEEN :p_debut AND :p_fin AND user_id=:id_user
        AND hotel_id=:id_hotel AND sousresto_id=:id_sousresto  GROUP BY dte");
        $requete->BindParam(':p_debut', $datedebut);
        $requete->BindParam(':p_fin', $datefin);
        $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
        $requete->BindParam(':id_sousresto', $_SESSION['id_sousresto']);
        $requete->BindParam(':id_user', $_SESSION['id_user']);
        $requete->execute();
        $result = $requete->fetchAll(PDO::FETCH_OBJ);
        foreach ($result as $r) {
            $fond_cdf = $r->fond_cdf;
            $fond_usd = $r->fond_usd;
        }
         $requete2=$bdd->prepare("SELECT e.solde_virtuel,e.balance,SUM(e.montant_vers) AS cdf,SUM(e.montantusd) AS usd,e.user_vers,e.date_vers,e.id_sousresto,d.nom_user,d.prenom_user
        FROM t_versement AS e,t_utilisateur AS d
        WHERE e.user_vers=d.id_user
			AND e.type_vers='restaurant'
	         AND e.user_vers=:id_user 
			 AND e.id_sousresto=:id_sousresto 
             AND e.date_vers BETWEEN :p_debut AND :p_fin 
        GROUP BY e.user_vers,e.date_vers");
        $requete2->BindParam(':id_user', $_SESSION['id_user']);
        $requete2->BindParam(':p_debut',$datedebut);
        $requete2->BindParam(':p_fin',$datefin);
        $requete2->BindParam(':id_sousresto', $_SESSION['id_sousresto']);
        $requete2->execute();
        $result = $requete2->fetchAll(PDO::FETCH_OBJ);
    }
    include($url);
} elseif ($do == 'details') {
    $musd = 'USD';
    $mcdf = 'CDF';
    $_SESSION['nom_user'] = $noms_user = $_GET['noms_user'];
    $_SESSION['dte_vers'] = $dte = $_GET['dte'];
    $user = $_GET['user'];
    $_SESSION['fond_cdf'] = $fond_cdf = $_GET['fond_cdf'];
    $_SESSION['fond_usd'] = $fond_usd = $_GET['fond_usd'];
    $_SESSION['percu_cdf'] = $percu_cdf = $_GET['percu_cdf'];
    $_SESSION['percu_usd'] = $percu_usd = $_GET['percu_usd'];
    $_SESSION['rendu_cdf'] = $rendu_cdf = $_GET['rendu_cdf'];
    $_SESSION['rendu_usd'] = $rendu_usd = $_GET['rendu_usd'];
    $_SESSION['averser_usd'] = $averser_usd = $_GET['averser_usd'];
    $_SESSION['averser_cdf'] = $averser_cdf = $_GET['averser_cdf'];
    $_SESSION['verser_cdf'] = $verser_cdf = $_GET['verser_cdf'];
    $_SESSION['verser_usd'] = $verser_usd = $_GET['verser_usd'];
    $_SESSION['solde_cdf'] = $solde_cdf = $averser_cdf - $verser_cdf;
    $_SESSION['solde_usd'] = $solde_usd = $averser_usd - $verser_usd;
    $requete = $bdd->prepare("SELECT a.montant_vers AS mont_cdf,a.montantusd AS mont_usd,a.num
        FROM t_versement AS a
        WHERE  a.date_vers=:dte AND a.user_vers=:user");
    $requete->BindParam(':dte', $dte);
    $requete->BindParam(':user', $user);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    include($pathview . 'versement/details.php');
}elseif ($do=='print_det'){
//    include('./impression/examples/details_versement.php');
}elseif ( $do=='listeajx'){
    $periode = $_POST['periode'];
    $id_sousresto=$_POST['sousresto_id'];  
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
    
}elseif ($do == 'details2') {
    $dte1=$dte2=date('Y-m-d');
    $taux=$_SESSION['tauxdollar'];
    $id_sousresto=$_SESSION['id_sousresto'];
    $caissier_id=0;
    $data=rapportVersementUser($caissier_id,$id_sousresto,$m_affiche,$dte1,$dte2,$taux,$bdd);
    $nbre=count($data['ventes']['mode']);
    $musd='';
    $_SESSION['data_versement']=$data;
    include($pathview . 'versement/details2.php');
}elseif ($do == 'details2ajx') {
    $periode = $_POST['periode'];
    $id_sousresto = $_POST['sousresto_id'];
    $caissier_id=$_POST['caissier_id'];
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
    $taux=$_SESSION['tauxdollar'];
    $data=rapportVersementUser($caissier_id,$id_sousresto,$m_affiche,$date_bd1,$date_bd2,$taux,$bdd);
    $nbre=count($data['ventes']['mode']);
    $musd='';
    $_SESSION['data_versement']=$data;
    include($pathview . 'versement/details2data.php');
}elseif ($do == 'etatcaisse') {
    $dte1=$dte2=date('Y-m-d');
    $taux=$_SESSION['tauxdollar'];
    $id_sousresto=$_SESSION['id_sousresto'];
    $data=etatDeCaisse($id_sousresto,$dte1,$dte2,$taux,$bdd);
    $nbre=count($data['libelle']);
    $musd='USD';
    $_SESSION['data_etatcaisse']=$data;
    include($pathview . 'versement/etatcaisse.php');
}elseif ($do == 'etatcaisseajx') {
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
    $taux=$_SESSION['tauxdollar'];
    $id_sousresto=$_SESSION['id_sousresto'];
    $data=etatDeCaisse($id_sousresto,$date_bd1,$date_bd2,$taux,$bdd);
    $nbre=count($data['libelle']);
    $musd='USD';
    $_SESSION['data_etatcaisse']=$data;
    include($pathview . 'versement/etatcaissedata.php');
}

    