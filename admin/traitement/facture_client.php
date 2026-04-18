<?php

$company_id = $_GET['id'];
$modulecompagny = $_GET['idmodcomp'];
$id_fact = $_GET['id_fact'];
$requete = $bdd->prepare("SELECT *,MONTHNAME(date_echeance) AS nom_mois,f.etat AS etat_fac FROM t_facture AS f,t_hotel AS h,v_souscription AS c WHERE f.modulecompagny=c.module_id AND f.company_id=c.id_c AND h.id_hotel=f.id_hotel AND f.id_hotel =:id_c AND f.modulecompagny=:modulecompagny GROUP BY f.modulecompagny ");
$requete->BindParam(':id_c', $company_id);
$requete->BindParam(':modulecompagny', $modulecompagny);
$requete->execute();
$resultats = $requete->fetchAll(PDO::FETCH_OBJ);

$requete = $bdd->prepare("SELECT SUM(montant_dollar) AS mont_rglt FROM  t_reglement WHERE id_fact=:id_fact");
$requete->BindParam(':id_fact', $id_fact);
$requete->execute();
$reglement_by_facture = $requete->fetchAll(PDO::FETCH_OBJ);

