<?php

// Initialisation de la session
include('../bdd/connexion.php');
if (!isset($_SESSION)) {
    session_start();
}
include('../../FUNCTION/stock.php');
$json=array();
//$_SESSION['fiche'] = array();
//$_SESSION['fiche']['ingred_id'] = array();
//$_SESSION['fiche']['name'] = array();
//$_SESSION['fiche']['qte'] = array();
//$_SESSION['fiche']['utite'] = array();

$nbArticles=-1;
if (isset($_POST['produit_id']) && isset($_POST['designation']) && isset($_POST['code'])&& isset($_POST['qte'])) {
    //Ajouter un produit dans .  
    $produit_id= $_POST['produit_id'];
    $select['id'] = $produit_id;
    $select['nom'] = $_POST['designation'];
    $select['qte'] = $_POST['qte'];
    $select['code'] = $_POST['code'];
    //  Selection de la quantité totale d'un produit
    $prod_qte_total=getQuantiteProduit($bdd,$produit_id);
    
    if ($_POST['qte'] > $prod_qte_total) {
        echo '<div class="alert alert-danger text-center" id="alert_qte"><i class="fa fa-warning fa-fw"></i> La quantité sortie saisie doit être inférieure ou égale à la quantité du stock :'.$prod_qte_total.'</div>';
        
    }  else {
        //on ajoute le produit
        array_push($_SESSION['fiche']['produit_id'], $_POST['produit_id']);
        array_push($_SESSION['fiche']['designation'], $_POST['designation']);
        array_push($_SESSION['fiche']['qte'], $_POST['qte']);
        array_push($_SESSION['fiche']['code'],$_POST['code']);

        $nbArticles = count($_SESSION['fiche']['produit_id']);
    }

}elseif (isset($_GET['produit_id']) && isset($_GET['supprimer'])) {
    /* On vérifie que l'article à supprimer est bien présent dans le panier */
    $positionProduit = array_search($_GET['produit_id'], $_SESSION['fiche']['produit_id']);

    if ($positionProduit !== false) {
        /* création d'un tableau temporaire de stockage des articles */
       $panier_tmp = array("produit_id"=>array(),"designation"=>array(),"qte"=>array(),"code"=>array()); 
        /* Comptage des articles du panier */
        $nb_articles = count($_SESSION['fiche']['produit_id']);
        /* Transfert du panier dans le panier temporaire */
        for ($i = 0; $i < $nb_articles; $i++) {
            /* On transfère tout sauf l'article à supprimer */
            if ($_SESSION['fiche']['produit_id'][$i] != $_GET['produit_id']) {
                array_push($panier_tmp['produit_id'], $_SESSION['fiche']['produit_id'][$i]);
                array_push($panier_tmp['designation'], $_SESSION['fiche']['designation'][$i]);
                array_push($panier_tmp['qte'], $_SESSION['fiche']['qte'][$i]);
                array_push($panier_tmp['code'], $_SESSION['fiche']['code'][$i]);
            }
        }
        /* Le transfert est terminé, on ré-initialise le panier */
        $_SESSION['fiche'] = $panier_tmp;
        /* Option : on peut maintenant supprimer notre panier temporaire: */
        unset($panier_tmp);
    }
    $nbArticles = count($_SESSION['fiche']['produit_id']);
}elseif (isset($_GET['produit_id']) && isset($_GET['modifier']) ) {
    $produit_id = $_GET['produit_id'];
    $qte = $_GET['qte'];
    //Si le panier éxiste
    //Si la quantité est positive on modifie sinon on supprime l'article
    if ($qte > 0) {
        //Recharche du produit dans le panier
        $positionProduit = array_search($produit_id, $_SESSION['fiche']['produit_id']);

        if ($positionProduit !== false) {
            $_SESSION['fiche']['qte'][$positionProduit] = $qte;
//            array_push($_SESSION['fiche']['qte'], $_POST['qte']);
        }
    }
    $nbArticles = count($_SESSION['fiche']['produit_id']);
}
if ($nbArticles!=-1) {
?>

<?php 
$j=1;
    for ($i = 0; $i <= $nbArticles - 1; $i++) {
    ?>
        <tr>
            <td><?php echo $j ?></td>
            <td><?php echo $_SESSION['fiche']['designation'][$i] ?></td>
            <td>
                <input size="10" type="number" min="1" value="<?php echo $_SESSION['fiche']['qte'][$i] ?>" class="qte" id="<?php echo $_SESSION['fiche']['produit_id'][$i] ?>">
            </td>
            <td><?php echo $_SESSION['fiche']['code'][$i] ?></td>
            <td align="center">
                <input name="ch_prod" class='ch_prod' type='checkbox' id="<?php echo $_SESSION['fiche']['produit_id'][$i] ?>" value="<?php echo $_SESSION['fiche']['produit_id'][$i] ?>" />
            </td>
        </tr>
<?php $j++; }; ?>
    

<?php } ?>

