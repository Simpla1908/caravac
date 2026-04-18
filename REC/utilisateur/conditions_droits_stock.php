<?php
$droits |= VOIR_MODULE_STOCK;
if (isset($_POST['TABLEAU_BORD_STOCK']) && ($_POST['TABLEAU_BORD_STOCK'] == 'oui')) {
    $droits |= TABLEAU_BORD_STOCK;
}

if (isset($_POST['APPROVISIONNEMENT_LECTURE']) && ($_POST['APPROVISIONNEMENT_LECTURE'] == 'oui')) {
    $droits |= APPROVISIONNEMENT_LECTURE;
}

if (isset($_POST['APPROVISIONNEMENT_AJOUTER']) && ($_POST['APPROVISIONNEMENT_AJOUTER'] == 'oui')) {
    $droits |= APPROVISIONNEMENT_AJOUTER;
}

if (isset($_POST['APPROVISIONNEMENT_MODIFIER']) && ($_POST['APPROVISIONNEMENT_MODIFIER'] == 'oui')) {
    $droits |= APPROVISIONNEMENT_MODIFIER;
}
if (isset($_POST['APPROVISIONNEMENT_SUPPRIMER']) && ($_POST['APPROVISIONNEMENT_SUPPRIMER'] == 'oui')) {
    $droits |= APPROVISIONNEMENT_SUPPRIMER;
}
if (isset($_POST['SORTIE_LECTURE']) && ($_POST['SORTIE_LECTURE'] == 'oui')) {
    $droits |= SORTIE_LECTURE;
}

if (isset($_POST['SORTIE_AJOUTER']) && ($_POST['SORTIE_AJOUTER'] == 'oui')) {
    $droits |= SORTIE_AJOUTER;
}

if (isset($_POST['SORTIE_MODIFIER']) && ($_POST['SORTIE_MODIFIER'] == 'oui')) {
    $droits |= SORTIE_MODIFIER;
}
if (isset($_POST['SORTIE_SUPPRIMER']) && ($_POST['SORTIE_SUPPRIMER'] == 'oui')) {
    $droits |= SORTIE_SUPPRIMER;
}
if (isset($_POST['RAPPORT_PRODUIT_FAMILLE']) && ($_POST['RAPPORT_PRODUIT_FAMILLE'] == 'oui')) {
    $droits |= RAPPORT_PRODUIT_FAMILLE;
}
if (isset($_POST['RAPPORT_FICHE_ARTICLE']) && ($_POST['RAPPORT_FICHE_ARTICLE'] == 'oui')) {
    $droits |= RAPPORT_FICHE_ARTICLE;
}
if (isset($_POST['PARAMETRAGE_ARTICLE']) && ($_POST['PARAMETRAGE_ARTICLE'] == 'oui')) {
    $droits |= PARAMETRAGE_ARTICLE;
}
if (isset($_POST['PERMISSION_FULL_STOCK']) && ($_POST['PERMISSION_FULL_STOCK'] == 'oui')) {
    $droits |= PERMISSION_FULL_STOCK;
}


