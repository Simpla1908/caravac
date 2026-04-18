<?php
$idsite=$_SESSION['id_hotel'];
if ($do == 'liste') {
    $date_bd1=date('Y-m-d');
    $date_bd2=date('Y-m-d');
    $data = ExtraitDEcompteAll($idsite, $bdd);
    $_SESSION['dte1'] =$date_bd1;
    $_SESSION['dte2'] = $date_bd2;
    include($pathview . 'extrait/liste.php');
} 
 elseif ($do == 'verifextrait') {
    $json = array();
    $json['s'] = false;
    $json['message'] = '';
    if ($_POST['idclient'] == '') {
        $json['message'] = "Veuillez sélectionner un client";
    } else {
        $json['s'] = true;
    }
    echo json_encode($json);
} elseif ($do == 'listeajx') {
    $idclient = $_POST['idclient'];
    $periode = $_POST['periode'];
    $nomclient = $_GET['nomclient'];
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
    if ($idclient > 0) {
        $data = ExtraitDEcompte($idclient, $date_bd1, $date_bd2, $bdd);
        $_SESSION['dte1'] = $date_bd1;
        $_SESSION['dte2'] = $date_bd2;
        include($pathview . 'extrait/datasextrait.php');
    } else {
        $data = ExtraitDEcompteAll($date_bd1, $date_bd2, $bdd);
        $_SESSION['dte1'] = $date_bd1;
        $_SESSION['dte2'] = $date_bd2;
        include($pathview . 'extrait/datasextraitall.php');
    }
}elseif ($do == 'details2') {
    $idclient=$_GET['idclient'];
    $nomClient=$_GET['cl'];
    $data = ExtraitDEcompte2($idclient,$bdd);
    include($pathview . 'extrait/datasextrait2.php');
}
