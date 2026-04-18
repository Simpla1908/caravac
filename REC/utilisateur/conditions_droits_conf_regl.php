<?php
$droits |= VOIR_MODULE_CONF_REGL;
if (isset($_POST['CREATION_HOTEL']) && ($_POST['CREATION_HOTEL'] == 'oui')) {
    $droits |= CREATION_HOTEL;
}

if (isset($_POST['CREATION_CHAMBRE']) && ($_POST['CREATION_CHAMBRE'] == 'oui')) {
    $droits |= CREATION_CHAMBRE;
}

if (isset($_POST['MODIFIER_INFO_HOTEL']) && ($_POST['MODIFIER_INFO_HOTEL'] == 'oui')) {
    $droits |= MODIFIER_INFO_HOTEL;
}

if (isset($_POST['MODIFIER_CHAMBRE']) && ($_POST['MODIFIER_CHAMBRE'] == 'oui')) {
    $droits |= MODIFIER_CHAMBRE;
}
if (isset($_POST['AJOUTER_UTILISATEUR']) && ($_POST['AJOUTER_UTILISATEUR'] == 'oui')) {
    $droits |= AJOUTER_UTILISATEUR;
}
if (isset($_POST['MODIFIER_UTILISATEUR']) && ($_POST['MODIFIER_UTILISATEUR'] == 'oui')) {
    $droits |= MODIFIER_UTILISATEUR;
}

if (isset($_POST['SUPPRIMER_UTILISATEUR']) && ($_POST['SUPPRIMER_UTILISATEUR'] == 'oui')) {
    $droits |= SUPPRIMER_UTILISATEUR;
}

if (isset($_POST['VOIR_UTILISATEURS']) && ($_POST['VOIR_UTILISATEURS'] == 'oui')) {
    $droits |= VOIR_UTILISATEURS;
}
if (isset($_POST['VOIR_PARTENAIRES']) && ($_POST['VOIR_PARTENAIRES'] == 'oui')) {
    $droits |= VOIR_PARTENAIRES;
}
if (isset($_POST['AJOUTER_PARTENAIRE']) && ($_POST['AJOUTER_PARTENAIRE'] == 'oui')) {
    $droits |= AJOUTER_PARTENAIRE;
}
if (isset($_POST['MODIFIER_PARTENAIRE']) && ($_POST['MODIFIER_PARTENAIRE'] == 'oui')) {
    $droits |= MODIFIER_PARTENAIRE;
}
if (isset($_POST['SUPPRIMER_PARTENAIRE']) && ($_POST['SUPPRIMER_PARTENAIRE'] == 'oui')) {
    $droits |= SUPPRIMER_PARTENAIRE;
}
if (isset($_POST['IMPRIMER_PARTENAIRES']) && ($_POST['IMPRIMER_PARTENAIRES'] == 'oui')) {
    $droits |= IMPRIMER_PARTENAIRES;
}
if (isset($_POST['DEFINIR_TAUX']) && ($_POST['DEFINIR_TAUX'] == 'oui')) {
    $droits |= DEFINIR_TAUX;
}

if (isset($_POST['DEFINIR_MONNAIE']) && ($_POST['DEFINIR_MONNAIE'] == 'oui')) {
    $droits |= DEFINIR_MONNAIE;
}

