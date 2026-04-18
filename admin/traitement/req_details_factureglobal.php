<?php
//if (!empty($_GET['mois'])&& !empty($_GET['id'])) {
    $company_id = $_GET['id'];
    $mois=$_GET['mois'];
    $requete = $bdd->prepare($req_details_factureglobal_mois);
    $requete->BindParam(':mois', $mois);
    $requete->BindParam(':id_hotel', $company_id);
    $requete->execute();
    $resultats = $requete->fetchAll(PDO::FETCH_OBJ);
//} else {
//    if (!empty($_GET['id']))
//    $company_id = $_GET['id'];
//    $requete = $bdd->prepare($req_details_factureglobal);
//    $requete->BindParam(':id_hotel', $company_id);
//    $requete->execute();
//    $resultats = $requete->fetchAll(PDO::FETCH_OBJ);
//}
$totalregle = 0;
$total = 0;

foreach ($resultats as $r) {
    $id_fact = $r->id_fact;
    $requete = $bdd->prepare("SELECT SUM(montant_dollar) AS mont_rglt FROM  t_reglement WHERE id_fact=:id_fact");
    $requete->BindParam(':id_fact', $id_fact);
    $requete->execute();
    $reglement_by_facture = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($reglement_by_facture as $r1) {
        $totalregle+=$r1->mont_rglt;
    }
    $total+=$r->montantmodule;
}
$totalregle=round($totalregle,2);
$reste=$total -$totalregle;