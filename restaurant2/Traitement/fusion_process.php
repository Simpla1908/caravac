<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (!isset($_SESSION)) {
    session_start();
}
include '../bdd/connexion.php';
include '../../FUNCTION/hebergement.php';
include '../../FUNCTION/restaurant.php';
include '../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
$json = array();
$libelle = 'facturefusion';
$num_cmd = getnumerotation($_SESSION['id_hotel'], $libelle, $bdd);
$num_cmd_format = format_numero($num_cmd);
$type = 'restaurant';
$taux_op = $_SESSION['taux_resto'];
$dte = date('Y-m-d');
$etat = 0;
$etat_cmd = 1;
$date_h_com = date('Y-m-d H:i:s');
$fusion = 1;
$mont_ttc = 0;
global $table_merge_id;
global $id_fact_merge;
global $merge_state;
global $busy_state;
$busy_state = "occupe";
$merge_state = 1;
//recuperation 
$tbl_fuson = '';
$type_tbl = '';
//$nbre_r = count($_SESSION['fusion']['id_client']);
$nbre_r = $_SESSION['fusion']['id_client'];
//Libérer les tables
for ($j = 0; $j < count($nbre_r); $j++) {
    $statut = "libre";
    $id_client = $_SESSION['fusion']['id_client'][$j];
    $tbl_fuson = $tbl_fuson . '' . $_SESSION['fusion']['nom_client'][$id_client];
    $type_tbl = $_SESSION['fusion']['type_cl'][$id_client];
    $pseudo_supp = 0;
    $en_attente = 0;
    $merge_state;
    $fusion = 1;
    $type_customer = 'restaurant';
    $busy = 1;
    // Nous fusionner une table à une autre, l'on recupère les tables de destination
    if ($j === count($nbre_r) - 1) {
        $requete = $bdd->prepare("UPDATE t_client SET pseudo_supp=:pseudo_supp, statut=:statut, en_attente=:en_attente, fusion=:fusion  WHERE id_client=:id_client");
        $requete->BindParam(':pseudo_supp', $pseudo_supp);
        $requete->BindParam(':en_attente', $merge_state);
        $requete->BindParam(':statut', $busy_state);
        $requete->BindParam(':fusion', $merge_state);
        $requete->BindParam(':id_client', $id_client);
        $requete->execute();
        $table_merge_id = $_SESSION['fusion']['id_client'][$j];
        $requete = $bdd->prepare("SELECT id_fact FROM t_facture where id_client=:id_client");
        $requete->BindParam(':id_client', $id_client);
        $requete->execute();
        $merge_check = $requete->fetchAll(PDO::FETCH_OBJ);
        foreach ($merge_check as $m_c) {
            $id_fact_merge = $m_c->id_fact;
        };
    } else {
        $requete = $bdd->prepare("UPDATE t_client SET pseudo_supp=:pseudo_supp, statut=:statut, en_attente=:en_attente  WHERE id_client=:id_client");
        $requete->BindParam(':pseudo_supp', $pseudo_supp);
        $requete->BindParam(':en_attente', $en_attente);
        $requete->BindParam(':statut', $statut);
        $requete->BindParam(':id_client', $id_client);
        $requete->execute();
    }
}
//echo $tbl_fuson;
/*Creation table fusion  */
if ($type_tbl == 'table') {
    $code = $tbl_fuson;
    $designation = $tbl_fuson;
    $nom_client = "";
} else {
    $nom_client = $tbl_fuson;
    $code = '';
    $designation = '';
}
$fusion = 1;
$type_customer = 'restaurant';
$en_attente = 1;
$requete = $bdd->prepare("INSERT INTO t_facture (type,num_fact,taux,monnaie,date_edition,id_user,id_hotel,id_sousresto,company_id,mont_ttc,etat,etat_cmd,dte_time,fusion,id_client,serveur_id,serveur_name)
                            VALUES(:type,:num_fact,:taux,:monnaie,:date_edition,:id_user,:id_hotel,:id_sousresto,:company_id,:mont_ttc,:etat,:etat_cmd,:dte_time,:fusion,:id_client,:serveur_id,:serveur_name)");
$requete->BindParam(':type', $type);
$requete->BindParam(':num_fact', $num_cmd_format);
$requete->BindParam(':taux', $taux_op);
$requete->BindParam(':monnaie', $m_affiche);
$requete->BindParam(':date_edition', $dte);
$requete->BindParam(':id_user', $_SESSION['id_user']);
$requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
$requete->BindParam(':id_sousresto', $_SESSION['id_sousresto']);
$requete->BindParam(':company_id', $_SESSION['company_id']);
$requete->BindParam(':mont_ttc', $mont_ttc);
$requete->BindParam(':etat', $etat);
$requete->BindParam(':etat_cmd', $etat_cmd);
$requete->BindParam(':dte_time', $date_h_com);
$requete->BindParam(':fusion', $fusion);
$requete->BindParam(':id_client', $table_merge_id);
$requete->BindParam(':serveur_id', $serveur_id);
$requete->BindParam(':serveur_name', $serveur_name);
$requete->execute();
$id_fact_fus = $bdd->lastInsertId();
/* Insertion dans  fusion_factures */
$nbre_rows = count($_SESSION['fusion']['id_client']);
for ($i = 0; $i <= $nbre_rows - 1; $i++) {
    $id_client = $_SESSION['fusion']['id_client'][$i];
    $id_fact = $_SESSION['fusion']['id_fact'][$id_client];
    $mont_ttc_session = $_SESSION['fusion']['mont_ttc'][$id_client];
    $mont_ttc = $mont_ttc + $mont_ttc_session;
    $requete = $bdd->prepare("INSERT INTO fusion_factures (id_fact,id_fact_fus)
                            VALUES(:id_fact,:id_fact_fus)");
    $requete->BindParam(':id_fact', $id_fact);
    $requete->BindParam(':id_fact_fus', $id_fact_merge);
    $requete->execute();
    $requete = $bdd->prepare("INSERT INTO fusion_tables (id_tbl_fus,id_tbl)
                            VALUES(:id_tbl,:id_tbl_fus)");
    $requete->BindParam(':id_tbl_fus', $table_merge_id);
    $requete->BindParam(':id_tbl', $id_client);
    $requete->execute();

    $requete = $bdd->prepare("UPDATE  lignes_commandes set commande_id=:id_fusion where commande_id=:commande_id");
    $requete->BindParam(':commande_id', $id_fact);
    $requete->BindParam(':id_fusion',  $id_fact_merge);
    $requete->execute();

    $requete = $bdd->prepare("UPDATE t_facture  SET mont_ttc=:mont_ttc  WHERE id_fact=:id_fact");
    $requete->BindParam(':mont_ttc', $mont_ttc);
    $requete->BindParam(':id_fact',  $id_fact_merge);
    $requete->execute();
    $v=0;
    $requete = $bdd->prepare("UPDATE t_facture  SET appear_state =:st_v  WHERE id_fact=:id_fact");
    $requete->BindParam(':st_v', $v);
    $requete->BindParam(':id_fact',  $id_fact);
    $requete->execute();
}
/* $num_cmd += 1;
$requete = $bdd->prepare("UPDATE t_facture  SET mont_ttc=:mont_ttc  WHERE id_fact=:id_fact");
$requete->BindParam(':mont_ttc', $mont_ttc);
$requete->BindParam(':id_fact', $id_fact_fus);
$requete->execute();
$num_cmd += 1; */
setnumerotation($_SESSION['id_hotel'], $libelle, $num_cmd, $bdd);
//POUR FUSION DE TABLES
$_SESSION['fusion'] = array();
$_SESSION['fusion']['id_client'] = array();
$_SESSION['fusion']['nom_client'] = array();
$_SESSION['fusion']['id_fact'] = array();
$_SESSION['fusion']['mont_ttc'] = array();
$_SESSION['fusion']['taux'] = array();
$_SESSION['fusion']['serveur_id'] = array();
$_SESSION['fusion']['serveur_name'] = array();
$json['id_fact_fus'] = $id_fact_merge;
echo json_encode($json);
