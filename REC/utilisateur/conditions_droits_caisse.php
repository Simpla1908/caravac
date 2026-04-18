<?php
$droits |= VOIR_MODULE_CAISSE;
if (isset($_POST['TABLEAU_BORD_CAISSE']) && ($_POST['TABLEAU_BORD_CAISSE'] == 'oui')) {
    $droits |= TABLEAU_BORD_CAISSE;
}

if (isset($_POST['AJOUTER_ENTREE_CAISSE']) && ($_POST['AJOUTER_ENTREE_CAISSE'] == 'oui')) {
    $droits |= AJOUTER_ENTREE_CAISSE;
}

if (isset($_POST['VOIR_ENTREE_CAISSE']) && ($_POST['VOIR_ENTREE_CAISSE'] == 'oui')) {
    $droits |= VOIR_ENTREE_CAISSE;
}

if (isset($_POST['MODIFIER_ENTREE_CAISSE']) && ($_POST['MODIFIER_ENTREE_CAISSE'] == 'oui')) {
    $droits |= MODIFIER_ENTREE_CAISSE;
}
if (isset($_POST['SUPPRIMER_ENTREE_CAISSE']) && ($_POST['SUPPRIMER_ENTREE_CAISSE'] == 'oui')) {
    $droits |= SUPPRIMER_ENTREE_CAISSE;
}
if (isset($_POST['IMPRIMER_ENTREE_CAISSE']) && ($_POST['IMPRIMER_ENTREE_CAISSE'] == 'oui')) {
    $droits |= IMPRIMER_ENTREE_CAISSE;
}

if (isset($_POST['AJOUTER_SORTIE_CAISSE']) && ($_POST['AJOUTER_SORTIE_CAISSE'] == 'oui')) {
    $droits |= AJOUTER_SORTIE_CAISSE;
}

if (isset($_POST['VOIR_SORTIE_CAISSE']) && ($_POST['VOIR_SORTIE_CAISSE'] == 'oui')) {
    $droits |= VOIR_SORTIE_CAISSE;
}
if (isset($_POST['MODIFIER_SORTIE_CAISSE']) && ($_POST['MODIFIER_SORTIE_CAISSE'] == 'oui')) {
    $droits |= MODIFIER_SORTIE_CAISSE;
}
if (isset($_POST['SUPPRIMER_SORTIE_CAISSE']) && ($_POST['SUPPRIMER_SORTIE_CAISSE'] == 'oui')) {
    $droits |= SUPPRIMER_SORTIE_CAISSE;
}
if (isset($_POST['IMPRIMER_SORTIE_CAISSE']) && ($_POST['IMPRIMER_SORTIE_CAISSE'] == 'oui')) {
    $droits |= IMPRIMER_SORTIE_CAISSE;
}
if (isset($_POST['IMPRIMER_JOURNAL_CAISSE']) && ($_POST['IMPRIMER_JOURNAL_CAISSE'] == 'oui')) {
    $droits |= IMPRIMER_JOURNAL_CAISSE;
}
if (isset($_POST['ANALYSE_CAISSE']) && ($_POST['ANALYSE_CAISSE'] == 'oui')) {
    $droits |= ANALYSE_CAISSE;
}

if (isset($_POST['IDENTIFICATION_MOTIF_CAISSE']) && ($_POST['IDENTIFICATION_MOTIF_CAISSE'] == 'oui')) {
    $droits |= IDENTIFICATION_MOTIF_CAISSE;
}

