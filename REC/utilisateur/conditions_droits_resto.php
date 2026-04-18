<?php
$droits |= VOIR_MODULE_RESTO;
if (isset($_POST['REMISE_COMMANDE']) && ($_POST['REMISE_COMMANDE'] == 'oui')) {
    $droits |= REMISE_COMMANDE;
}

if (isset($_POST['VENTE']) && ($_POST['VENTE'] == 'oui')) {
    $droits |= VENTE;
}

if (isset($_POST['PERMISSION_FULL_RESTO']) && ($_POST['PERMISSION_FULL_RESTO'] == 'oui')) {
    $droits |= PERMISSION_FULL_RESTO;
}

if (isset($_POST['']) && ($_POST['RAPPORT_VENTE_RESTO'] == 'oui')) {
    $droits |= RAPPORT_VENTE_RESTO;
}
if (isset($_POST['SOS_PRODUIT']) && ($_POST['SOS_PRODUIT'] == 'oui')) {
    $droits |= SOS_PRODUIT;
}
if (isset($_POST['AJOUTER_TABLE']) && ($_POST['AJOUTER_TABLE'] == 'oui')) {
    $droits |= AJOUTER_TABLE;
}

if (isset($_POST['RESERVATION_TABLE']) && ($_POST['RESERVATION_TABLE'] == 'oui')) {
    $droits |= RESERVATION_TABLE;
}

if (isset($_POST['ANNULER_RESERVATION_TABLE']) && ($_POST['ANNULER_RESERVATION_TABLE'] == 'oui')) {
    $droits |= ANNULER_RESERVATION_TABLE;
}
