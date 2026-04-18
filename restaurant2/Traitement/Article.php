<?php

$json = array();
$json['succes'] = False;
$action = $_GET['do'];
if ($action == 'addquantite') {
    include_once './AjaxImport.php';
    include './Panier.php';
    $panier = new Panier();
    if ($_SESSION['stock'] == 1){
        GetQteProdEnAttente($bdd);
    }
    $idprod = $_GET['idprod'];
    $select['id'] =$panier->getcpt($idprod);
    $repas = $_GET['repas'];
    $positionProduit = array_search($select['id'], $_SESSION['panier']['cpt']);
    $qty=$_SESSION['panier']['qte'][$positionProduit]+1;
    $qte=$_SESSION['panier']['qte'][$positionProduit];
    if ($repas == 1 || $repas == 3) {
        $bool = FALSE;
        if ($_SESSION['stock'] == 1) {
            $produits_plat = listeProduitIngredient($idprod, $_SESSION['id_hotel'], $bdd);
            foreach ($produits_plat as $p) {
                $idpr = $p->produit_id;
                $quantite = $qty * $p->quantite;
                $qte_attente = QteAttenteProd($idpr);
                $quantite_reste = GetQteDispoByProd($bdd, $idpr, $_SESSION['depot_id']);
                $quantite_reste-=$qte_attente;
                if ($quantite > $quantite_reste) {
                    $bool = TRUE;
                    break;
                }
            }
        }
        if(!$bool){
            $select['qte'] =$qty;
            $panier->modifierQTeArticle($select);
            $json['succes'] = true;
        }else{
            if ($repas == 3){
                $json['message'] =LANG_ADD_QUANTITE_PANIER2;
            }else{
                $json['message'] =LANG_ADD_QUANTITE_PANIER3;
            }
            $select['qte'] =$qte;
            $panier->modifierQTeArticle($select);
        }
    }else{
        $idpr = $idprod;
        if ($_SESSION['stock']==1){
            $qte_attente = QteAttenteProd($idpr);
            $quantite_reste = GetQteDispoByProd($bdd,$idpr, $_SESSION['depot_id']);
            $quantite_reste-=$qte_attente;
        }
        //Fin  Récuperation du Qté
        if ($qty > $quantite_reste && $_SESSION['stock'] == 1){
            $json['message'] = LANG_ADD_QUANTITE_PANIER1.$qte ;
            $select['qte'] =$qte;
            $panier->modifierQTeArticle($select);
            $json['succes'] = true;
        }else{
            $select['qte'] = $qty;
            $panier->modifierQTeArticle($select);
        }
    }
  echo json_encode($json); 
}elseif($action == 'affichepanier'){
    include 'tableau_affichage_commandes.php?action=addquantite'; 
}

