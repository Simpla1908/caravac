<?php
$json = array();
$json['s'] = False;
$json['message'] = '';
$site_id=$_SESSION['id_hotel'];
$hr_1='00:00:00';
$hr_2='05:00:00';
$hr_operation=date('H:i:s');
if ($do == 'liste') {
    $dte1=$dte2=date('Y-m-d');
    $couverts=SelectCouverts($dte1,$dte2,$site_id,$bdd);
    //var_dump($couverts);
    include($pathview . 'couverts/listecouverts.php');
}elseif($do =='listeajx'){
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
    $dte1 = $annee . '-' . $mois . '-' . $jour;
    /* Conversion date2 */
    $transpostion_date2 = explode('/', $date2);
    $jour2 = $transpostion_date2[0];
    $mois2 = $transpostion_date2[1];
    $annee2 = $transpostion_date2[2];
    $dte2 = $annee2 . '-' . $mois2 . '-' . $jour2;
    $couverts=SelectCouverts($dte1,$dte2,$site_id,$bdd);
    include($pathview . 'couverts/couvertsdata.php');
}


