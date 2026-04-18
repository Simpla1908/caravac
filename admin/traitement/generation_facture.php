<?php

include '../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
if (!empty($_GET['id'])&& !empty($_GET['idmodcomp'])){
    $hotel_id = $_GET['id'];
    $company_id = $_GET['idmodcomp'];
} else{
    $company_id = 0;
    $hotel_id=0;
}
$type = 'souscription';

$requete = $bdd->prepare("SELECT f.date_echeance,f.date_echeance_old,vs.montantmodule,vs.module_id ,vs.id,p.souscription FROM t_modulecompany AS vs,t_facture AS f,prix AS p WHERE vs.id=f.modulecompagny AND p.id=vs.prix_id AND vs.etat_module=1 AND vs.site_id=:id_c GROUP BY vs.id");
$requete->BindParam(':id_c', $hotel_id);
$requete->execute();
$resultats = $requete->fetchAll(PDO::FETCH_OBJ);
foreach ($resultats as $o){
    include '../traitement/numerotaion_facture_souscription.php';
    $num_fact = 'FAC' . str_pad($i_souscription, 4, "0", STR_PAD_LEFT); //001;
    $datedepart = $o->date_echeance;
    $date_echeance_old = $o->date_echeance_old;
    if($o->souscription=='mensuel'){
        $duree = 1;
    } else {
        $duree = 12;
    }
    $datedepartT = strtotime($datedepart);
    $date_echeance_oldT = strtotime($date_echeance_old);
    $date_echeance = date('Y-m-d', strtotime('+' . $duree . 'month', $datedepartT));
    $date_echeanceT = strtotime($date_echeance);
    
    $date_edit_old1 = date('Y-m-d', strtotime('+' . $duree . 'month', $date_echeance_oldT));
    $date_edit_old2 = strtotime($date_edit_old1);
    $duree = -3;
    $date_edition = date('Y-m-d', strtotime('+' . $duree . 'days', $date_echeanceT));
    $d = 7;
    $dte_blocage= date('Y-m-d', strtotime('+' . $d . 'days', $date_echeanceT));
    $date_edit_old3 = date('Y-m-d', strtotime('+' . $duree . 'days', $date_edit_old2));
    $module_id = $o->module_id ;
    $companymodule_id=$o->id;
//Verification si la facture est déja générée à cette date 
    $requete = $bdd->prepare("SELECT f.date_edition FROM t_facture AS f WHERE f.date_edition=:date_edition AND f.modulecompagny=:modulecompagny AND f.id_hotel=:company_id ");
    $requete->BindParam(':date_edition', $date_edition);
    $requete->BindParam(':modulecompagny',$companymodule_id);
    $requete->BindParam(':company_id',$hotel_id);
    $requete->execute();
    $resultats = $requete->fetchAll(PDO::FETCH_OBJ);
    $verif = count($resultats);
//Fin Verification si la facture est déja générée à cette date
    if ($verif == 0) {
        if (date('Y-m-d')>=$date_edit_old3){
            /* Insertion dans t_facture */
            // $mont_tva = $o->montantmodule * $tva / 100;
            $mont_ttc = $o->montantmodule;
            $mont_tva =0;
            $etat = 'Brouillon';
            $requete = $bdd->prepare("INSERT INTO  t_facture (num_fact,type,etat,date_echeance_old,date_edition,date_echeance,montant_total,mont_tva,mont_ttc,modulecompagny,id_hotel,i_souscription,dte_blocage)
             VALUES(:num_fact,:type,:etat,:date_echeance_old,:date_edition,:date_echeance,:montant_total,:mont_tva,:mont_ttc,:modulecompagny,:id_hotel,:i_souscription,:dte_blocage)");

            $requete->BindParam(':num_fact', $num_fact);
            $requete->BindParam(':type', $type);
            $requete->BindParam(':etat', $etat);
            $requete->BindParam(':date_echeance_old',$datedepart);
            $requete->BindParam(':date_edition', $date_edition);
            $requete->BindParam(':date_echeance', $date_echeance);
            $requete->BindParam(':montant_total', $o->montantmodule);
            $requete->BindParam(':mont_tva', $mont_tva);
            $requete->BindParam(':mont_ttc', $mont_ttc);
            $requete->BindParam(':modulecompagny', $companymodule_id);
            $requete->BindParam(':id_hotel',$hotel_id);
            $i = $i_souscription + 1;
            $requete->BindParam(':i_souscription', $i);
            $requete->BindParam(':dte_blocage', $dte_blocage);
//            $requete->BindParam(':company_id',$company_id);
            $requete->execute();
            /* Fin d'Insertion dans t_facture */
            /* Maj de date de blocage dans t_modulecompany */
            $etat_module = 1;
            $requete = $bdd->prepare("UPDATE t_modulecompany SET dte_blocage=:dte_blocage WHERE id=:id");
            $requete->BindParam(':dte_blocage', $dte_blocage);
            $requete->BindParam(':id', $companymodule_id);
            $requete->execute();
            /* Fin Maj */
        }
    }
}

//$requete = $bdd->prepare("SELECT MONTHNAME(f.date_echeance_old) AS nom_mois,f.etat AS etat_fac,ho.nom_hotel FROM t_hotel AS ho,t_facture AS f,module AS m,t_modulecompany AS mc WHERE f.id_hotel=ho.id_hotel AND f.modulecompagny=c.module_id AND f.company_id=c.id_c  AND f.id_hotel=:id_c");
$requete = $bdd->prepare($req_factureByhotel);
$requete->BindParam(':id_c',$hotel_id);
$requete->execute();
$resultats = $requete->fetchAll(PDO::FETCH_OBJ);


