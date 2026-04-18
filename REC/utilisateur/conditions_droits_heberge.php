<?php
    $droits |= VOIR_MODULE_HEBERGE;
if (isset($_POST['EFFECTUER_RESERVATION']) && ($_POST['EFFECTUER_RESERVATION'] == 'oui')) {
    $droits |= EFFECTUER_RESERVATION;
}

if (isset($_POST['VOIR_TOUTES_RESERVATIONS']) && ($_POST['VOIR_TOUTES_RESERVATIONS'] == 'oui')) {
    $droits |= VOIR_TOUTES_RESERVATIONS;
}

if (isset($_POST['IMPRIMER_LISTE_RESERVATION']) && ($_POST['IMPRIMER_LISTE_RESERVATION'] == 'oui')) {
    $droits |= IMPRIMER_LISTE_RESERVATION;
}

if (isset($_POST['MODIFIER_RESERVATION']) && ($_POST['MODIFIER_RESERVATION'] == 'oui')) {
    $droits |= MODIFIER_RESERVATION;
}
if (isset($_POST['SUPPRIMER_RESERVATION']) && ($_POST['SUPPRIMER_RESERVATION'] == 'oui')) {
    $droits |= SUPPRIMER_RESERVATION;
}
if (isset($_POST['VOIR_TOUTES_OCCUPATION']) && ($_POST['VOIR_TOUTES_OCCUPATION'] == 'oui')) {
    $droits |= VOIR_TOUTES_OCCUPATION;
}

if (isset($_POST['EFFECTUER_OCCUPATION']) && ($_POST['EFFECTUER_OCCUPATION'] == 'oui')) {
    $droits |= EFFECTUER_OCCUPATION;
}

if (isset($_POST['AFFECTATION_CHAMBRE']) && ($_POST['AFFECTATION_CHAMBRE'] == 'oui')) {
    $droits |= AFFECTATION_CHAMBRE;
}
if (isset($_POST['CHANGER_CHAMBRE']) && ($_POST['CHANGER_CHAMBRE'] == 'oui')) {
    $droits |= CHANGER_CHAMBRE;
}
if (isset($_POST['VOIR_TOUTES_LIBERATION']) && ($_POST['VOIR_TOUTES_LIBERATION'] == 'oui')) {
    $droits |= VOIR_TOUTES_LIBERATION;
}
if (isset($_POST['SITUATION_CLIENT_LOGES']) && ($_POST['SITUATION_CLIENT_LOGES'] == 'oui')) {
    $droits |= SITUATION_CLIENT_LOGES;
}
if (isset($_POST['IMPRIMER_CLASSEUR']) && ($_POST['IMPRIMER_CLASSEUR'] == 'oui')) {
    $droits |= IMPRIMER_CLASSEUR;
}
if (isset($_POST['AJOUTER_CLIENT']) && ($_POST['AJOUTER_CLIENT'] == 'oui')) {
    $droits |= AJOUTER_CLIENT;
}
if (isset($_POST['MODIFIER_INFO_CLIENT']) && ($_POST['MODIFIER_INFO_CLIENT'] == 'oui')) {
    $droits |= MODIFIER_INFO_CLIENT;
}
if (isset($_POST['SUPPRIMER_CLIENT']) && ($_POST['SUPPRIMER_CLIENT'] == 'oui')) {
    $droits |= SUPPRIMER_CLIENT;
}
if (isset($_POST['IMPRIMER_LISTE_CLIENT']) && ($_POST['IMPRIMER_LISTE_CLIENT'] == 'oui')) {
    $droits |= IMPRIMER_LISTE_CLIENT;
}
if (isset($_POST['EDITER_RECLAMATION']) && ($_POST['EDITER_RECLAMATION'] == 'oui')) {
    $droits |= EDITER_RECLAMATION;
}

if (isset($_POST['LISTE_RECLAMATIONS']) && ($_POST['LISTE_RECLAMATIONS'] == 'oui')) {
    $droits |= LISTE_RECLAMATIONS;
}