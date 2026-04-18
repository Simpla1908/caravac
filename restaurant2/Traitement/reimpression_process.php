<?php
ini_set('session.bug_compat_warn', 0);
ini_set('session.bug_compat_42', 0);
session_start();
include '../bdd/connexion.php';
include '../../FUNCTION/hebergement.php';
include '../../FUNCTION/stock.php';
include '../../FUNCTION/restaurant.php';
include '../../language/eng.php';
include '../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
include './Panier.php';
$taux_op = $_SESSION['taux_op'];
$tauxdollar = $_SESSION['tauxdollar'];
$json = array();
$json['succes'] = False;
$json['bc'] = false;
$json['bar'] = false;
$id_cmd = $_GET['id_cmd'];
$idfactcl = $_GET['idfactcl'];
$id_client = $_GET['id_client'];
$idrescl = $_GET['idrescl'];
$nom_client = $_GET['nom_client'];
$dte = date('Y-m-d');
$date_h_com = date('Y-m-d H:i:s');
$_SESSION['date_edition2'] = $date_h_com;
$taux_op = $_SESSION['taux_resto'];
$monnaie = getsymbole_local();
$libelle = 'restaurant';
$cuisine = 0;
$bar = 0;
$idcommande = 0;
$lignecmd_id = 0;
$cuisson_nom = '';
$sauce_nom = '';
$accomp = '';
$sel_nom = '';
$panier = new Panier();
$nbrcouvert = $_GET['nbrcouvert'];
$user_attente = $_GET['user_attente'];
$agent = $_SESSION['prenom_user'] . ' ' . $_SESSION['nom_user'];
//Encore Mise en attente
$nbArticles = count($_SESSION['panier']['id_article']);
for ($i = 0; $i <= $nbArticles - 1; $i++) {
    $repas = $_SESSION['panier']['repas'][$i];
    $quantite = $_SESSION['panier']['qte'][$i];
    $produit_id = $_SESSION['panier']['id_article'][$i];
    $lgcmd = $_SESSION['panier']['pa'][$i];
    $description = $_SESSION['panier']['description'][$i];
    $prix = $_SESSION['panier']['prix'][$i];
    $impr = 1;
    $qte2 = 0;
    if (in_array($lgcmd, $_SESSION['ProduitsSelectiones']['id_produit'])) {
    if ($repas == 1) {
        $cuisine = 1;
    }
    if ($repas == 0 || $repas == 3) {
        $bar = 1;
    }

     }
}


if ($cuisine == 1) {
    $json['bc'] = true;
}

if ($bar == 1) {
    $json['bar'] = true;
}

$json['succes'] = true;
echo json_encode($json);
