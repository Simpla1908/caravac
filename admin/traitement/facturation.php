<?php

include '../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
if (!empty($_GET['id'])){
    $company_id = $_GET['id'];
} else{
    $company_id = 0;
}
$type = 'souscription';
$company_id = $_GET['id'];
//$requete = $bdd->prepare("SELECT vs.idmodule,vs.dte_activ, vs.montantmodule,vs.idmodule,vs.module_id FROM v_souscription AS vs WHERE vs.id_c=:id_c");

$requete = $bdd->prepare("SELECT vs.date_activ AS dte_activ,vs.montantmodule,vs.module_id ,vs.id FROM t_modulecompany AS vs WHERE vs.site_id=:id_c");
$requete->BindParam(':id_c', $company_id);
$requete->execute();
$resultats = $requete->fetchAll(PDO::FETCH_OBJ);
foreach ($resultats as $o){
    include '../traitement/numerotaion_facture_souscription.php';
    $num_fact = 'FAC' . str_pad($i_souscription, 4, "0", STR_PAD_LEFT); //001;
    $datedepart = $o->dte_activ;
    $duree = 1;
    $datedepartT = strtotime($datedepart);
    $date_echeance = date('Y-m-d', strtotime('+' . $duree . 'month', $datedepartT));
    $date_echeanceT = strtotime($date_echeance);
    $duree = -3;
    $date_edition = date('Y-m-d', strtotime('+' . $duree . 'days', $date_echeanceT));
    $module_id = $o->module_id ;
    $companymodule_id=$o->id;
//Verification si la facture est déja générée à cette date 
    $requete = $bdd->prepare("SELECT f.date_edition FROM t_facture AS f WHERE f.date_edition=:date_edition AND f.modulecompagny=:modulecompagny AND f.company_id=:company_id ");
    $requete->BindParam(':date_edition', $date_edition);
    $requete->BindParam(':modulecompagny',$companymodule_id);
    $requete->BindParam(':company_id',$company_id);
    $requete->execute();
    $resultats = $requete->fetchAll(PDO::FETCH_OBJ);
    $verif = count($resultats);
//Fin Verification si la facture est déja générée à cette date
    if ($verif == 0) {
        if ($date_edition == date('Y-m-d')) {
            /* Insertion dans t_facture */
            $mont_tva = $o->montantmodule * $tva / 100;
            $mont_ttc =  round($mont_tva + $o->montantmodule,2);
            $etat = 'Brouillon';
            $requete = $bdd->prepare("INSERT INTO  t_facture (num_fact,type,etat,date_edition,date_echeance,montant_total,mont_tva,mont_ttc,modulecompagny,i_souscription,company_id)
             VALUES(:num_fact,:type,:etat,:date_edition,:date_echeance,:montant_total,:mont_tva,:mont_ttc,:modulecompagny,:i_souscription,:company_id)");

            $requete->BindParam(':num_fact', $num_fact);
            $requete->BindParam(':type', $type);
            $requete->BindParam(':etat', $etat);
            $requete->BindParam(':date_edition', $date_edition);
            $requete->BindParam(':date_echeance', $date_echeance);
            $requete->BindParam(':montant_total', $o->montantmodule);
            $requete->BindParam(':mont_tva', $mont_tva);
            $requete->BindParam(':mont_ttc', $mont_ttc);
            $requete->BindParam(':modulecompagny', $companymodule_id);
            $i = $i_souscription + 1;
            $requete->BindParam(':i_souscription', $i);
            $requete->BindParam(':company_id',$company_id);
            $requete->execute();
            /* Fin d'Insertion dans t_facture */
        }
    }
}

$requete = $bdd->prepare("SELECT *,MONTHNAME(date_echeance) AS nom_mois,f.etat AS etat_fac,ho.nom_hotel FROM t_hotel AS ho,t_facture AS f,v_souscription AS c WHERE f.id_hotel=ho.id_hotel AND f.modulecompagny=c.module_id AND f.company_id=c.id_c  AND f.id_hotel=:id_c");
$requete->BindParam(':id_c', $company_id);
$requete->execute();
$resultats = $requete->fetchAll(PDO::FETCH_OBJ);


