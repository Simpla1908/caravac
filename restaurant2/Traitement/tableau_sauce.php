<?php

// Initialisation de la session
include('../bdd/connexion.php');
if (!isset($_SESSION)) {
    session_start();
}

$nbArticles=-1;
if (isset($_POST['accomp_id']) && isset($_POST['accomp_name']) && isset($_POST['unite_accomp'])) {

    array_push($_SESSION['cuisson']['id'],$_POST['accomp_id']);
    array_push($_SESSION['cuisson']['nom'], $_POST['accomp_name']);
    array_push($_SESSION['cuisson']['etat'],$_POST['unite_accomp']);
    
    $nbArticles = count($_SESSION['cuisson']['id']);
    
}elseif (isset($_GET['accomp_id']) && isset($_GET['supprimer'])) {
    /* On vérifie que l'article à supprimer est bien présent dans le panier */
    $positionProduit = array_search($_GET['accomp_id'], $_SESSION['cuisson']['id']);

    if ($positionProduit !== false) {
        /* création d'un tableau temporaire de stockage des articles */
       $panier_tmp = array("id"=>array(),"nom"=>array(),"etat"=>array()); 
        /* Comptage des articles du panier */
        $nb_articles = count($_SESSION['cuisson']['id']);
        /* Transfert du panier dans le panier temporaire */
        for ($i = 0; $i < $nb_articles; $i++) {
            /* On transfère tout sauf l'article à supprimer */
            if ($_SESSION['cuisson']['id'][$i] != $_GET['accomp_id']) {
                array_push($panier_tmp['id'], $_SESSION['cuisson']['id'][$i]);
                array_push($panier_tmp['nom'], $_SESSION['cuisson']['nom'][$i]);
                array_push($panier_tmp['etat'], $_SESSION['cuisson']['etat'][$i]);
            }
        }
        /* Le transfert est terminé, on ré-initialise le panier */
        $_SESSION['cuisson'] = $panier_tmp;
        /* Option : on peut maintenant supprimer notre panier temporaire: */
        unset($panier_tmp);
    }
    $nbArticles = count($_SESSION['cuisson']['id']);
}
if ($nbArticles!=-1) {
?>

<?php 
$j=1;
    for ($i = 0; $i <= $nbArticles - 1; $i++) {
        if($_SESSION['cuisson']['etat'][$i]==1){
    ?>
        <tr>
            <td><?php echo $j ?></td>
            <td><?php echo $_SESSION['cuisson']['nom'][$i] ?></td>
            <td align="center">
                <input name="ch_sauce" class='ch_sauce' type='checkbox' id="<?php echo $_SESSION['cuisson']['id'][$i] ?>" value="<?php echo $_SESSION['cuisson']['id'][$i] ?>" />
            </td>
        </tr>
<?php $j++;} }; ?>
    

<?php } ?>

