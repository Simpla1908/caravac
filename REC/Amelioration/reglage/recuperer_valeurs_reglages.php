<?php
//Fusion horaire
date_default_timezone_set('Africa/Kinshasa');
$requete = $bdd->prepare("SELECT  * FROM t_reglage WHERE id_hotel=:id_hotel");
$requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
$requete->execute();
$reglages = $requete->fetchAll(PDO::FETCH_OBJ);
foreach ($reglages as $op) {
    $remise = $op->remise;
    $majoration = $op->majoration;
    $tauxdollar = $op->tauxdollar;
    $taux_op = $op->taux_op ;
    $tva = $op->tva;
    $temps_sortie = $op->temps_regl;
    $checkin = $op->time_checkin;
    $m_insert = $op->m_insert;
    $m_affiche = $op->m_affiche;
    $stock = $op->stock;
}
$_SESSION['m_insert']=$m_insert;
$_SESSION['m_affiche']=$m_affiche;
$_SESSION['tauxdollar']=$tauxdollar;
$_SESSION['tva']=$tva ;
$_SESSION['remise']=$remise;
$_SESSION['temps_sortie']=$temps_sortie;
$_SESSION['taux_op']=$taux_op;
$_SESSION['stock']=$stock;
