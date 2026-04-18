<?php

// Initialisation de la session
include('../bdd/connexion.php');
if (!isset($_SESSION)) {
    session_start();
}
$nbArticles = -1;
if (isset($_POST['ingred_id']) && isset($_POST['ingred_name']) && isset($_POST['utite']) && isset($_POST['qte']) && isset($_POST['prix'])) {
    //Ajouter un produit dans .  
    $ingred_id = $_POST['ingred_id'];
    $select['id'] = $ingred_id;
    $select['nom'] = $_POST['ingred_name'];
    $select['qte'] = $_POST['qte'];
    $select['utite'] = $_POST['utite'];
    $select['prix'] = $_POST['prix'];
    //Sinon on ajoute le produit
    array_push($_SESSION['fiche']['ingred_id'], $_POST['ingred_id']);
    array_push($_SESSION['fiche']['name'], $_POST['ingred_name']);
    array_push($_SESSION['fiche']['qte'], $_POST['qte']);
    array_push($_SESSION['fiche']['utite'], $_POST['utite']);
    array_push($_SESSION['fiche']['prix'], $_POST['prix']);

    $nbArticles = count($_SESSION['fiche']['ingred_id']);
} elseif (isset($_GET['ingred_id']) && isset($_GET['supprimer'])) {
    /* On vérifie que l'article à supprimer est bien présent dans le panier */
    $positionProduit = array_search($_GET['ingred_id'], $_SESSION['fiche']['ingred_id']);

    if ($positionProduit !== false) {
        /* création d'un tableau temporaire de stockage des articles */
        $panier_tmp = array("ingred_id" => array(), "name" => array(), "qte" => array(), "utite" => array(), "prix" => array());
        /* Comptage des articles du panier */
        $nb_articles = count($_SESSION['fiche']['ingred_id']);
        /* Transfert du panier dans le panier temporaire */
        for ($i = 0; $i < $nb_articles; $i++) {
            /* On transfère tout sauf l'article à supprimer */
            if ($_SESSION['fiche']['ingred_id'][$i] != $_GET['ingred_id']) {
                array_push($panier_tmp['ingred_id'], $_SESSION['fiche']['ingred_id'][$i]);
                array_push($panier_tmp['name'], $_SESSION['fiche']['name'][$i]);
                array_push($panier_tmp['qte'], $_SESSION['fiche']['qte'][$i]);
                array_push($panier_tmp['utite'], $_SESSION['fiche']['utite'][$i]);
                array_push($panier_tmp['prix'], $_SESSION['fiche']['prix'][$i]);

            }
        }
        /* Le transfert est terminé, on ré-initialise le panier */
        $_SESSION['fiche'] = $panier_tmp;
        /* Option : on peut maintenant supprimer notre panier temporaire: */
        unset($panier_tmp);
    }
    $nbArticles = count($_SESSION['fiche']['ingred_id']);
} elseif (isset($_GET['ingred_id']) && isset($_GET['modifier'])) {
    $ingred_id = $_GET['ingred_id'];
    $qte = $_GET['qte_produit'];
    //Si le panier éxiste
    //Si la quantité est positive on modifie sinon on supprime l'article
    if ($qte > 0) {
        //Recharche du produit dans le panier
        $positionProduit = array_search($ingred_id, $_SESSION['fiche']['ingred_id']);

        if ($positionProduit !== false) {
            $_SESSION['fiche']['qte'][$positionProduit] = $qte;
            //array_push($_SESSION['fiche']['qte'], $_POST['qte']);
        }
    }
    $nbArticles = count($_SESSION['fiche']['ingred_id']);
}
if ($nbArticles != -1) {
?>

    <?php
    $j = 1;
    $tot = 0;
    for ($i = 0; $i <= $nbArticles - 1; $i++) {
        $prix = $_SESSION['fiche']['prix'][$i];
        $qte = $_SESSION['fiche']['qte'][$i];
        $prixqte = $prix * $qte;
    ?>
        <tr>
            <td><?php echo $j ?></td>
            <td><?php echo $_SESSION['fiche']['name'][$i] ?></td>
            <td>
                <input size="10" type="text" value="<?php echo $qte ?>" class="qte_prod" id="<?php echo $_SESSION['fiche']['ingred_id'][$i] ?>">
            </td>
            <td><?php echo $_SESSION['fiche']['utite'][$i] ?></td>
            <td><?php echo $prixqte ?></td>
            <td align="center">
                <input name="ch_ingred" class='ch_ingred' type='checkbox' id="<?php echo $_SESSION['fiche']['ingred_id'][$i] ?>" value="<?php echo $_SESSION['fiche']['ingred_id'][$i] ?>" />
            </td>

        </tr>
    <?php
        $tot += $prixqte;
        $j++;
    }; ?>
    <tr>
        <th style="text-align:center;" colspan="4">TOTAL</th>
        <th><input name="paplat" type="hidden" value="<?php echo $tot?>" /><?php echo $tot ?></th>
        <th></th>
    </tr>

<?php } ?>