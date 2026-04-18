<?php
include('../bdd/connexion.php');
$company =  $_SESSION['company_id'];
$id_site = $_GET['id_hotel'] ;

//recuperation données reglage
$requete = $bdd->prepare("SELECT * FROM t_reglage WHERE company_id=:id_c AND id_hotel=:id_site");
$requete->BindParam(':id_c', $company);
$requete->BindParam(':id_site', $id_site);
$requete->execute();
$reglage_tuples = $requete->fetchAll(PDO::FETCH_OBJ);
foreach ($reglage_tuples as $reglage_t){
    $checkin=$reglage_t->time_checkin;
    $checkout = $reglage_t->temps_regl;
    $mi = $reglage_t->m_insert;
    $ma = $reglage_t->m_affiche;
    $taux = $reglage_t->tauxdollar;
    $tva = $reglage_t->tva;
    $rmz = $reglage_t->remise;
}

