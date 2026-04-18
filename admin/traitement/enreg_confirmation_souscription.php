<?php

include '../../bdd/connexion.php';
include '../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
include '../traitement/requette_abonnement.php';
if (!empty($_POST['id']) && !empty($_POST['mode_rglmt']) && !empty($_POST['montant_paye']) && !empty($_POST['mont_tot'])) {
    if (is_numeric($_POST['montant_paye']) && is_numeric($_POST['montant_paye'])) {
        $mont_paye = $_POST['montant_paye'];
        $mont_tot = $_POST['mont_tot'];
        if ($mont_paye == $mont_tot) {
            $type = 'souscription';
            $company_id = $_POST['id'];
            $hotel_id = $_POST['hotel_id'];
            $requete = $bdd->prepare($req_moduleBysite);
            $requete->BindParam(':id_c', $hotel_id);
            $requete->execute();
            $req_moduleBysite = $requete->fetchAll(PDO::FETCH_OBJ);

            foreach ($req_moduleBysite as $o) {
                if ($o->paye == 0) {
                    include '../traitement/numerotaion_facture_souscription.php';
                    $num_fact = 'FAC' . str_pad($i_souscription, 4, "0", STR_PAD_LEFT); //001;
                    $datedepart = date('Y-m-d');
                    $duree = 1;
                    $datedepartT = strtotime($datedepart);
                    $date_echeance = date('Y-m-d', strtotime('+' . $duree . 'month', $datedepartT));
                    $date_echeanceT = strtotime($date_echeance);
                    $duree = -3;
                    $date_edition = date('Y-m-d');
                    $module_id = $o->idmodule;
                    /* Insertion dans t_facture */
                    $mont_tva =0 ;
                    $mont_ttc =$o->montantmodule;
                    $etat = 'Payé';
                    $requete = $bdd->prepare("INSERT INTO  t_facture (num_fact,type,etat,date_echeance_old,date_edition,date_echeance,montant_total,mont_tva,mont_ttc,modulecompagny,i_souscription,company_id,id_hotel,dte_blocage)
                VALUES(:num_fact,:type,:etat,:date_echeance_old,:date_edition,:date_echeance,:montant_total,:mont_tva,:mont_ttc,:modulecompagny,:i_souscription,:company_id,:id_hotel,:dte_blocage)");

                    $requete->BindParam(':num_fact', $num_fact);
                    $requete->BindParam(':type', $type);
                    $requete->BindParam(':etat', $etat);
                    $requete->BindParam(':date_echeance_old', $datedepart);
                    $requete->BindParam(':date_edition', $date_edition);
                    $requete->BindParam(':date_echeance', $date_echeance);
                    $requete->BindParam(':montant_total', $o->montantmodule);
                    $requete->BindParam(':mont_tva', $mont_tva);
                    $requete->BindParam(':mont_ttc', $mont_ttc);
                    $requete->BindParam(':modulecompagny', $module_id);
                    $i = $i_souscription + 1;
                    $requete->BindParam(':i_souscription', $i);
                    $requete->BindParam(':company_id', $company_id);
                    $requete->BindParam(':id_hotel', $hotel_id);
                    $date_echeanceT = strtotime($date_echeance);
                    $d = 7;
                    $dte_blocage= date('Y-m-d', strtotime('+' . $d . 'days', $date_echeanceT));
                    $requete->BindParam(':dte_blocage', $dte_blocage);
                    $requete->execute();
                    $id_fact = $bdd->lastInsertId();
                    /* Fin d'Insertion dans t_facture */

                    /* Insertion dans t_reglement */
                     $requete = $bdd->prepare("INSERT INTO  t_reglement (montant_dollar,id_mode_regl,date_regl,dte,id_fact)
                     VALUES(:montant_dollar,:id_mode_regl,:date_regl,:dte,:id_fact)");
                    /* monnaie Mis pour les besoins de la cause */
                    $requete->BindParam(':montant_dollar', $mont_ttc);
                    $requete->BindParam(':id_mode_regl', $_POST['mode_rglmt']);
                    $dte_souscription_h = date('Y-m-d H:i:s', time() + 3600);
                    $requete->BindParam(':date_regl', $dte_souscription_h);
                    $dte_souscription = date('Y-m-d');
                    $requete->BindParam(':dte', $dte_souscription);
                    $requete->BindParam(':id_fact', $id_fact);
                    $requete->execute();
                    /* Fin Insertion dans t_reglement */
                    /* Activation module */
                    $etat = 1;
                    $module_id = $o->idmodule;
                    $requete = $bdd->prepare("UPDATE t_modulecompany SET etat_module=:etat,date_activ=:date_activ,paye=:paye,dte_blocage=:dte_blocage WHERE id=:id");
                    $requete->BindParam(':etat', $etat);
                    $requete->BindParam(':date_activ', $date_edition);
                    $requete->BindParam(':paye', $etat);
                    $requete->BindParam(':dte_blocage', $dte_blocage);
                    $requete->BindParam(':id', $module_id);
                    $requete->execute();
                    /* Fin Activation module */
                }
            }
            /* Activation Hotel */
            $etat = 1;
            $statut_site = 'opérationnel';
            $requete = $bdd->prepare("UPDATE t_hotel SET etat=:etat,statut_site=:statut_site WHERE id_hotel=:id");
            $requete->BindParam(':etat', $etat);
            $requete->BindParam(':statut_site', $statut_site);
            $requete->BindParam(':id', $hotel_id);
            $requete->execute();
            /* Fin Activation Hotel */
            /* Activation compagnie */
            $etat = 1;
            $requete = $bdd->prepare("UPDATE t_company SET etat=:etat WHERE id_c=:id");
            $requete->BindParam(':etat', $etat);
            $requete->BindParam(':id', $company_id);
            $requete->execute();
            /* Fin Activation compagnie */

            /* Maj date souscription  */
//            $requete = $bdd->prepare("UPDATE souscription SET date_activ=:date_activ WHERE compagny_id =:id");
//            $requete->BindParam(':date_activ',$date_edition);
//            $requete->BindParam(':id',$company_id);
//            $requete->execute();
            /* Fin Maj date souscription */
        } else {
            echo 'Le montant saisi doit être au total de la souscription!';
        }
    } else {
        echo "Veuiller saisir une valeur numérique!";
    }
} else {
    echo 'Veuiller remplir tous les champs!';
}
