<?php
session_start();
include('../bdd/connexion.php');
require '../../FUNCTION/hebergement.php';
$json = array();
$json['message'] = '';
$musd = getsymbole_devise();
$mcdf = getsymbole_local();
$montusd = $_POST['montusd'];
$montcdf = $_POST['montcdf']; 
$motif = $_POST['motif']; 
$id = $_POST['id']; 
 $datedebut =date('Y-m-d');
 $datefin=date('Y-m-d');
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
if (($montusd == '' || $montcdf == '') || ($montusd == 0 && $montcdf == 0)) {
    $json['message'] = 'vide';
} else {

 if ($montusd == '') {
        $montusd = 0;
    } elseif ($montcdf == '') {
        $montcdf = 0;
    }

$requete = $bdd->prepare("UPDATE fondscaisse SET usd=:usd,cdf=:cdf,motif=:motif WHERE id=:id ");
$requete->BindParam(':usd',$montusd);
$requete->BindParam(':cdf',$montcdf);
$requete->BindParam(':motif',$motif);
$requete->BindParam(':id',$id);
$requete->execute();
//selection montant total fond caisse
  $tfond_cdf=0;
  $tfond_usd=0;
if ($_SESSION['type_user'] == 1){
        $requete = $bdd->prepare("SELECT SUM(cdf) AS fond_cdf,SUM(usd) AS fond_usd
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
           $tfond_cdf=$r->fond_cdf;
           $tfond_usd=$r->fond_usd;
        }


    }else{
        $requete = $bdd->prepare("SELECT SUM(cdf) AS fond_cdf,SUM(usd) AS fond_usd
        FROM fondscaisse 
        WHERE dte BETWEEN :p_debut AND :p_fin AND user_id=:id_user
        AND hotel_id=:id_hotel AND sousresto_id=:id_sousresto  GROUP BY dte");
        $requete->BindParam(':p_debut', $datedebut);
        $requete->BindParam(':p_fin', $datefin);
        $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
        $requete->BindParam(':id_sousresto', $_SESSION['id_sousresto']);
        $requete->BindParam(':id_user',$_SESSION['id_user']);
        $requete->execute();
        $result = $requete->fetchAll(PDO::FETCH_OBJ);
        foreach ($result as $r) {
           $tfond_cdf=$r->fond_cdf;
           $tfond_usd=$r->fond_usd;
        }
        }
//fin selection
$json['fondusd']=arrondir($montusd);  
$json['fondcdf']=arrondir($montcdf);  
$json['fondusdaff']=afficheMontant($musd,$montusd);  
$json['fondcdfaff']=afficheMontant($mcdf,$montcdf);
$json['tfond_usd']=afficheMontant($musd,$tfond_usd);  
$json['tfond_cdf']=afficheMontant($mcdf,$tfond_cdf);
$json['motif']=$motif;
$json['message'] = 'succes';

}
echo json_encode($json);