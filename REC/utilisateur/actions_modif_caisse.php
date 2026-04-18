<?php

//include('../Amelioration/bdd/connexion .php');
include './droits_caisse.php';

$requete = $bdd->prepare("SELECT g.permissions FROM groupe AS g WHERE g.id=1");
$requete->execute();
$groupes = $requete->fetchAll(PDO::FETCH_OBJ);
foreach ($groupes as $g):
   $droits=$g->permissions;
endforeach;

if (((int) $droits & TABLEAU_BORD_CAISSE)) {
    $TABLEAU_BORD_CAISSE_val='oui';
} else {
    $TABLEAU_BORD_CAISSE_val='non';
}
if (((int) $droits & AJOUTER_ENTREE_CAISSE)) {
    $AJOUTER_ENTREE_CAISSE_val='oui';
} else {
    $AJOUTER_ENTREE_CAISSE_val='non';
}
if (((int) $droits & VOIR_ENTREE_CAISSE)) {
    $VOIR_ENTREE_CAISSE_val='oui';
} else {
    $VOIR_ENTREE_CAISSE_val='non';
}
if (((int) $droits & MODIFIER_ENTREE_CAISSE)) {
    $MODIFIER_ENTREE_CAISSE_val='oui';
} else {
    $MODIFIER_ENTREE_CAISSE_val='non';
}
if (((int) $droits & SUPPRIMER_ENTREE_CAISSE)) {
    $SUPPRIMER_ENTREE_CAISSE_val='oui';
} else {
    $SUPPRIMER_ENTREE_CAISSE_val='non';
}
if (((int) $droits & SUPPRIMER_ENTREE_CAISSE)) {
    $SUPPRIMER_ENTREE_CAISSE_val='oui';
} else {
    $SUPPRIMER_ENTREE_CAISSE_val='non';
}
if (((int) $droits & IMPRIMER_ENTREE_CAISSE)) {
    $IMPRIMER_ENTREE_CAISSE_val='oui';
} else {
    $IMPRIMER_ENTREE_CAISSE_val='non';
}
if (((int) $droits & AJOUTER_SORTIE_CAISSE)) {
    $AJOUTER_SORTIE_CAISSE_val='oui';
} else {
    $AJOUTER_SORTIE_CAISSE_val='non';
}
if (((int) $droits & VOIR_SORTIE_CAISSE)) {
    $VOIR_SORTIE_CAISSE_val='oui';
} else {
    $VOIR_SORTIE_CAISSE_val='non';
}

if (((int) $droits & MODIFIER_SORTIE_CAISSE)) {
    $MODIFIER_SORTIE_CAISSE_val='oui';
} else {
    $MODIFIER_SORTIE_CAISSE_val='non';
}
if (((int) $droits & SUPPRIMER_SORTIE_CAISSE)) {
    $SUPPRIMER_SORTIE_CAISSE_val='oui';
} else {
    $SUPPRIMER_SORTIE_CAISSE_val='non';
}
if (((int) $droits & SUPPRIMER_SORTIE_CAISSE)) {
    $SUPPRIMER_SORTIE_CAISSE_val='oui';
} else {
    $SUPPRIMER_SORTIE_CAISSE_val='non';
}
if (((int) $droits & IMPRIMER_SORTIE_CAISSE)) {
    $IMPRIMER_SORTIE_CAISSE_val='oui';
} else {
    $IMPRIMER_SORTIE_CAISSE_val='non';
}
if (((int) $droits & IMPRIMER_JOURNAL_CAISSE)) {
    $IMPRIMER_JOURNAL_CAISSE_val='oui';
} else {
    $IMPRIMER_JOURNAL_CAISSE_val='non';
}
if (((int) $droits & ANALYSE_CAISSE)) {
    $ANALYSE_CAISSE_val='oui';
} else {
    $ANALYSE_CAISSE_val='non';
}
if (((int) $droits & IDENTIFICATION_MOTIF_CAISSE)) {
    $IDENTIFICATION_MOTIF_CAISSE_val='oui';
} else {
    $IDENTIFICATION_MOTIF_CAISSE_val='non';
}

