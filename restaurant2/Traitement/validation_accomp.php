<?php 
if (!isset($_SESSION)) {
    session_start();
}
include '../bdd/connexion.php';
include'../../FUNCTION/hebergement.php';
include'../../FUNCTION/stock.php';
include'../../FUNCTION/restaurant.php';
$json = array();
$json['accomp_ope'] ='ok';
$idrepas=$_GET['idrepas'];
$idprod=$_GET['id_produit'];
$qte_accomp=$_SESSION['accomp']['qte_accomp'][$idprod];
$quantite = $qte_accomp;
$qte_attente=QteAttenteProd($idprod);
$quantite_reste =GetQteDispoByProd($bdd,$idprod,$_SESSION['depot_id']);
$quantite_reste-=$qte_attente;
if ($quantite >=$quantite_reste){
$json['accomp_ope'] ='ko';
$json['accomp_msg'] ='La quantité commandée pour cet accompagnement est insuffisant';
}else{
$positionProduit = array_search($idrepas, $_SESSION['panier']['id_article']);
$_SESSION['panier']['nom'][$positionProduit]=$_SESSION['panier']['nom'][$positionProduit].' avec '.$_SESSION['accomp']['accomp_name'][$idprod];
 if (!in_array($idrepas, $_SESSION['repas_accomp']['inserer'])) {
array_push($_SESSION['repas_accomp']['inserer'],$idrepas);
$_SESSION['repas_accomp']['id'][$idrepas]=$idprod;
$_SESSION['repas_accomp']['nom'][$idrepas]=$_SESSION['accomp']['accomp_name'][$idprod];
}
$json['accomp_name'] = $_SESSION['panier']['nom'][$positionProduit];
$json['qte_accomp'] =$_SESSION['accomp']['qte_accomp'][$idprod];
$json['unite_accomp'] =$_SESSION['accomp']['unite_accomp'][$idprod];
$json['prix_accomp'] =$_SESSION['accomp']['prix_accomp'][$idprod];	
}



echo json_encode($json);


