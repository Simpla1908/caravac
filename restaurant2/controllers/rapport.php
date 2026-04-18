<?php
if ($do == 'vente' || $do == 'venteajx') {
    $fichier='vente.php';
    $_SESSION['prod'] = array();
    $_SESSION['prod']['id'] = array();
    $_SESSION['prod']['des'] = array();
    $_SESSION['cash'] = array();
    $_SESSION['cash']['qte'] = array();
    $_SESSION['cash']['pt'] = array();
    $_SESSION['credit'] = array();
    $_SESSION['credit']['qte'] = array();
    $_SESSION['credit']['pt'] = array();
    $_SESSION['don'] = array();
    $_SESSION['don']['qte'] = array();
    $_SESSION['don']['pt'] = array();
    $_SESSION['prod']['repas'] = array();
    if($do == 'vente'){
     $date_bd1 = date('Y-m-d');
     $date_bd2 = date('Y-m-d');   
    }else{
      $fichier='datavente.php';
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
    $date_bd1 = $annee . '-' . $mois . '-' . $jour;
    /* Conversion date2 */
    $transpostion_date2 = explode('/', $date2);
    $jour2 = $transpostion_date2[0];
    $mois2 = $transpostion_date2[1];
    $annee2 = $transpostion_date2[2];
    $date_bd2 = $annee2 . '-' . $mois2 . '-' . $jour2; 
    }
    $articles3=DetailsVenteAll($date_bd1,$date_bd2,$bdd);
    foreach ($articles3 as $art2) {
    $tauxdollar1 = $art2->taux_prix;
    if (!in_array($art2->idprod, $_SESSION['prod']['id'])) {
        array_push($_SESSION['prod']['id'], $art2->idprod);
        array_push($_SESSION['prod']['des'], $art2->designation);
        array_push($_SESSION['prod']['repas'], $art2->repas);
    }
    if ($art2->lib == 'Cash'){
        $_SESSION['cash']['qte'][$art2->idprod]= $art2->qte;
        $prix_u = montant_equivalent_bdd(getsymbole_local(), $m_affiche, $tauxdollar1, $art2->pu);
        $_SESSION['cash']['pt'][$art2->idprod]= $art2->pt;
    }elseif ($art2->lib == 'Credit'){
        $_SESSION['credit']['qte'][$art2->idprod]= $art2->qte;
        $prix_u = montant_equivalent_bdd(getsymbole_local(), $m_affiche, $tauxdollar1, $art2->pu);
        $_SESSION['credit']['pt'][$art2->idprod]= $art2->pt;
    }elseif ($art2->lib == 'Don'){
        $_SESSION['don']['qte'][$art2->idprod]= $art2->qte;
        $prix_u = montant_equivalent_bdd(getsymbole_local(), $m_affiche, $tauxdollar1, $art2->pu);
        $_SESSION['don']['pt'][$art2->idprod]= $art2->pt;
    }
}
$nbre_rows = count($_SESSION['prod']['id']);
    include($pathview . 'rapport/'.$fichier);
}elseif($do == 'facture'){
    $dte1 = date('Y-m-d');
    $dte2 = date('Y-m-d');
    include($pathview . 'rapport/liste.php');
}