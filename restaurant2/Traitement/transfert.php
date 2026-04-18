<?php

if (!isset($_SESSION)) {
session_start();
}
include '../bdd/connexion.php';
include '../../FUNCTION/hebergement.php';
include '../../FUNCTION/stock.php';
include '../../FUNCTION/restaurant.php';
include './Panier.php';
$json = array();
$json['succes'] = False;
$json['bc'] = false;
$json['bar'] = false;
global $id_fact;
$cuisine = 0;
$bar = 0;
$tabtransfert1= $_SESSION['tabtransfert1'];
$tabtransfert2= $_SESSION['tabtransfert2'];
$id_cmd =0;
$id_fact =$_SESSION['tabtransfertid_fact'];
$nom_client=$_SESSION['tabtransfert2designat'];
ReimprimerPOS2($id_fact, $bdd);
$nbArticles = count($_SESSION['panier1']['id_article']);
for ($i = 0;
$i <= $nbArticles - 1;
$i++) {
$repas = $_SESSION['panier1']['repas'][$i];
if ($repas == 1) {
$cuisine = 1;
}
if ($repas == 0) {
$bar = 1;
}
}
//Mise a jour facture
$requete = $bdd->prepare("UPDATE t_facture SET id_client=:id_client WHERE id_fact=:id");
$requete->BindParam(':id_client', $tabtransfert2);
$requete->BindParam(':id', $id_fact);
$requete->execute();
$en_attente = 1;
$user_attente =$_SESSION['id_user'];
$depot_id =$_SESSION['depot_id'];
$nbrcouvert=$_SESSION['transfertnbrcouvert'];
$requete = $bdd->prepare("UPDATE t_client  SET en_attente=:en_attente,user_attente=:user_attente,nbrcouvert=:nbrcouvert,idsousdepotfact =:idsousdepotfact  WHERE id_client=:client_id");
$requete->BindParam(':en_attente', $en_attente);
$requete->BindParam(':user_attente', $user_attente);
$requete->BindParam(':nbrcouvert', $nbrcouvert);
$requete->BindParam(':client_id', $tabtransfert2);
$requete->BindParam(':idsousdepotfact', $depot_id);
$requete->execute();
/* Rendre la table libre apres changement */
$statut = 'libre';
$en_attente = 0;
$user_attente = NULL;
$nbrcouvert=0;
$requete = $bdd->prepare("UPDATE  t_client  SET statut =:statut,en_attente =:en_attente,user_attente =:user_attente,nbrcouvert=:nbrcouvert  WHERE id_client=:id_client");
$requete->BindParam(':statut', $statut);
$requete->BindParam(':en_attente', $en_attente);
$requete->BindParam(':user_attente', $user_attente);
$requete->BindParam(':nbrcouvert', $nbrcouvert);
$requete->BindParam(':id_client', $tabtransfert1);
$requete->execute();
/* Fin */
$json['id_cmd'] = $id_cmd;
$json['nom_client'] = $nom_client;
$json['idcommande'] = $id_fact;
if ($cuisine == 1) {
$json['bc'] = true;
}
if ($bar == 1) {
$json['bar'] = true;
}
$json['succes'] = true;
echo json_encode($json);
