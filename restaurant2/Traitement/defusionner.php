<?php

ini_set('session.bug_compat_warn', 0);
ini_set('session.bug_compat_42', 0);
session_start();
include '../bdd/connexion.php';
include '../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
include '../../FUNCTION/hebergement.php';
include '../../FUNCTION/stock.php';
include '../../FUNCTION/restaurant.php';
include './Panier.php';

$_SESSION['lastload'] = time();
$json = array();
global $id_unmerge;
global $id_factmerge;
global $en_attente;
global $statut;
global $fusion;
global $id_table;
global $msg;
$en_attente = 1;
$statut = "occupe";
$msg= " La defusion réussi avec succès";
$fusion = 0;
$_SESSION['unmerge']['id_unmerge'] = array();
$_SESSION['merge']['merge_id'] = array();
$json['succes'] = False;
$id_factmerge = $_GET['id_merge'];
$id_table= $_GET['id_table'];
if ($id_factmerge) {
    $requete = $bdd->prepare("SELECT unmerge_bill_id FROM lignes_commandes WHERE commande_id=:commande_id");
    $requete->BindParam(':commande_id', $id_factmerge);
    $requete->execute();
    $unmerge = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($unmerge as $m) {
        $id_unmerge = $m->unmerge_bill_id;
        $merge_id = $id_factmerge;
        array_push($_SESSION['unmerge']['id_unmerge'], $id_unmerge);
        $unmerge_tables = $_SESSION['unmerge']['id_unmerge'];
        $groupedArray = array_reduce($unmerge_tables, function ($result, $item) {
               $check_value=  $GLOBALS['id_factmerge'];
            if ($item !== $check_value && !in_array($item, $result)) {
                array_push($result, $item);
            }
            return $result;
        }, array());
        $_SESSION['merge']['merge_id'] = $groupedArray;
        $merge = $_SESSION['merge']['merge_id'];
        for ($i = 0; $i < count($merge); $i++) {
            $merge_id = $_SESSION['merge']['merge_id'][$i];
            $requete = $bdd->prepare("UPDATE lignes_commandes SET commande_id=:commande_id WHERE unmerge_bill_id=:id_unmerge");
            $requete->BindParam(':commande_id', $merge_id);
            $requete->BindParam(':id_unmerge', $merge_id);
            $requete->execute();
            $requete = $bdd->prepare(" SELECT id_client FROM t_facture WHERE id_fact=:id_fact");
            $requete->BindParam(':id_fact', $merge_id);
            $requete->execute();
            $id_fact = $requete->fetchAll(PDO::FETCH_OBJ);
            foreach ($id_fact as $f) {
                // select id_fact
                $id_client = $f->id_client;
                $requete = $bdd->prepare(" SELECT id_client FROM t_facture WHERE id_fact=:id_fact");
                $requete->BindParam(':id_fact', $merge_id);
                $requete->execute();
                // Réoccuper la table
                $requete = $bdd->prepare(" UPDATE t_client set en_attente=:en_attente, statut=:statut, fusion=:fusion WHERE id_client=:id_client");
                $requete->BindParam(':en_attente', $en_attente);
                $requete->BindParam(':statut', $statut);
                $requete->BindParam(':fusion', $fusion);
                $requete->BindParam(':id_client', $id_client);
                $requete->execute();

                $requete = $bdd->prepare(" UPDATE t_client set en_attente=:en_attente, statut=:statut, fusion=:fusion WHERE id_client=:id_client");
                $requete->BindParam(':en_attente', $en_attente);
                $requete->BindParam(':statut', $statut);
                $requete->BindParam(':fusion', $fusion);
                $requete->BindParam(':id_client', $id_table);
                $requete->execute();
                $json['succes'] = true;
                $json['id_merge'] = $id_client;
                $json['succes'] = true;
                $json['unmerge_status'] = $msg;
            }
        }
        
    }
}
function getting_unmerge($id, $merge){
  $id= array(); 
  $p= $id;
  for ($i=0; $i < count($p); $i++) { 
    $result = $p[$i];
  }

}


echo json_encode($json);
