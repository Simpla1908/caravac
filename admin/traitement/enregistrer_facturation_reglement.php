<?php

/* Insertion dans t_facture */
$mont_tva = $o->montantmodule * $tva / 100;
$mont_ttc = $mont_tva + $o->montantmodule;
$etat = 'Brouillon';
$requete = $bdd->prepare("INSERT INTO t_reglement (montant_dollar,id_mode_regl,date_regl,date_edition,date_echeance,montant_total,mont_tva,mont_ttc,modulecompagny,i_souscription)
             VALUES(:montant_dollar,:id_mode_regl,:date_regl,:date_edition,:date_echeance,:montant_total,:mont_tva,:mont_ttc,:modulecompagny,:i_souscription)");

$requete->BindParam(':montant_dollar', $num_fact);
$requete->BindParam(':id_mode_regl', $type);
$requete->BindParam(':date_regl', $etat);
$requete->BindParam(':date_edition', $date_edition);
$requete->BindParam(':date_echeance', $date_echeance);
$requete->BindParam(':montant_total', $o->montantmodule);
$requete->BindParam(':mont_tva', $mont_tva);
$requete->BindParam(':mont_ttc', $mont_ttc);
$requete->BindParam(':modulecompagny', $module_id);
$i = $i_souscription + 1;
$requete->BindParam(':i_souscription', $i);
$requete->execute();
/* Fin d'Insertion dans t_facture */
;?>