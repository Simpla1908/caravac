<?php
session_start();
include '../bdd/connexion.php';
$json = array();
//FC en Dollar
$requete = $bdd->prepare("SELECT  * FROM t_reglage WHERE id_hotel=:id_hotel");
$requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
$requete->execute();
$operations = $requete->fetchAll(PDO::FETCH_OBJ);
foreach ($operations as $op) {
    $taux = $op->tauxdollar;
    $tva = $op->tva;
}
$cout_com =$_SESSION['panier']['mont_ttc_remise'] / $taux;
$cout_com_r = round($_SESSION['panier']['mont_ttc_remise'] / $taux, 2);
$json['mont_commande'] = $cout_com;
$json['mont_commande_r'] = $cout_com_r;
echo json_encode($json);
