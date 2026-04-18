<?php

$company_id = $_GET['id'];
$modulecompagny = $_GET['idmodcomp'];
$id_fact = $_GET['id_fact'];
$requete = $bdd->prepare($req_fac_bymodule);
$requete->BindParam(':site_id', $company_id);
$requete->BindParam(':id_fact', $id_fact);
$requete->execute();
$resultats = $requete->fetchAll(PDO::FETCH_OBJ);

$requete = $bdd->prepare("SELECT SUM(montant_dollar) AS mont_rglt FROM  t_reglement WHERE id_fact=:id_fact");
$requete->BindParam(':id_fact', $id_fact);
$requete->execute();
$reglement_by_facture = $requete->fetchAll(PDO::FETCH_OBJ);

