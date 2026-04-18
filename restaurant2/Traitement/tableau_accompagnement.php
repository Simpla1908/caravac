<?php

// Initialisation de la session
include('../bdd/connexion.php');
if (!isset($_SESSION)) {
    session_start();
}

$nbArticles=-1;
if (isset($_POST['accomp_id']) && isset($_POST['accomp_name']) && isset($_POST['unite_accomp'])&& isset($_POST['qte_accomp'])) {

    array_push($_SESSION['accomp']['accomp_id'],$_POST['accomp_id']);
    array_push($_SESSION['accomp']['accomp_name'], $_POST['accomp_name']);
    array_push($_SESSION['accomp']['qte_accomp'], $_POST['qte_accomp']);
    array_push($_SESSION['accomp']['unite_accomp'],$_POST['unite_accomp']);
    
    $nbArticles = count($_SESSION['accomp']['accomp_id']);
    
}elseif (isset($_GET['accomp_id']) && isset($_GET['supprimer'])) {
    /* On vérifie que l'article à supprimer est bien présent dans le panier */
    $positionProduit = array_search($_GET['accomp_id'], $_SESSION['accomp']['accomp_id']);

    if ($positionProduit !== false) {
        /* création d'un tableau temporaire de stockage des articles */
       $panier_tmp = array("accomp_id"=>array(),"accomp_name"=>array(),"qte_accomp"=>array(),"unite_accomp"=>array()); 
        /* Comptage des articles du panier */
        $nb_articles = count($_SESSION['accomp']['accomp_id']);
        /* Transfert du panier dans le panier temporaire */
        for ($i = 0; $i < $nb_articles; $i++) {
            /* On transfère tout sauf l'article à supprimer */
            if ($_SESSION['accomp']['accomp_id'][$i] != $_GET['accomp_id']) {
                array_push($panier_tmp['accomp_id'], $_SESSION['accomp']['accomp_id'][$i]);
                array_push($panier_tmp['accomp_name'], $_SESSION['accomp']['accomp_name'][$i]);
                array_push($panier_tmp['qte_accomp'], $_SESSION['accomp']['qte_accomp'][$i]);
                array_push($panier_tmp['unite_accomp'], $_SESSION['accomp']['unite_accomp'][$i]);
            }
        }
        /* Le transfert est terminé, on ré-initialise le panier */
        $_SESSION['accomp'] = $panier_tmp;
        /* Option : on peut maintenant supprimer notre panier temporaire: */
        unset($panier_tmp);
    }
    $nbArticles = count($_SESSION['accomp']['accomp_id']);
}elseif (isset($_GET['accomp_id']) && isset($_GET['modifier']) ) {
    $accomp_id = $_GET['accomp_id'];
    $qte = $_GET['qte_produit'];
    //Si le panier éxiste
    //Si la quantité est positive on modifie sinon on supprime l'article
    if ($qte > 0) {
        //Recharche du produit dans le panier
        $positionProduit = array_search($accomp_id, $_SESSION['accomp']['accomp_id']);

        if ($positionProduit !== false) {
            $_SESSION['accomp']['qte_accomp'][$positionProduit] = $qte;
//            array_push($_SESSION['fiche']['qte'], $_POST['qte']);
        }
    }
    $nbArticles = count($_SESSION['accomp']['accomp_id']);
}
if ($nbArticles!=-1) {
?>

<?php 
$j=1;
    for ($i = 0; $i <= $nbArticles - 1; $i++) {
    ?>
        <tr>
            <td><?php echo $j ?></td>
            <td><?php echo $_SESSION['accomp']['accomp_name'][$i] ?></td>
            <td>
                <input size="10" type="text"  value="<?php echo $_SESSION['accomp']['qte_accomp'][$i] ?>" class="qte_prodACC" id="<?php echo $_SESSION['accomp']['accomp_id'][$i] ?>">
            </td>
            <td><?php echo $_SESSION['accomp']['unite_accomp'][$i] ?></td>
            <td align="center">
                <input name="ch_accomp" class='ch_accomp' type='checkbox' id="<?php echo $_SESSION['accomp']['accomp_id'][$i] ?>" value="<?php echo $_SESSION['accomp']['accomp_id'][$i] ?>" />
            </td>
        </tr>
<?php $j++; }; ?>
    

<?php } ?>

