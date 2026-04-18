<?php
// Initialisation de la session
session_start();
include '../../bdd/connexion.php';
include '../../FUNCTION/hebergement.php';
include '../Amelioration/reglage/recuperer_valeurs_reglages.php';
include '../Amelioration/reglage/monnaie.php';
include ('../../souscription/select_data_motif.php');

    $montant_usd=$_POST['montant_usd'];
    $montant_cdf=$_POST['montant_cdf'];
    $idhotel=$_SESSION['id_hotel'];
    $iduser=$_SESSION['id_user'];
    $idrespo=$_POST['id_respo'];
    payerdette($site_monnaie_id,$idrespo,$montant_usd,$montant_cdf,$tauxdollar,$iduser,$idhotel,$bdd,$motif_id_resto,$motif_id_heb);
   


