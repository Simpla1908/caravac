<?php

// Initialisation de la session
session_start();
// Inclusion du fichier contenant la connexion à la base
require '../../bdd/connexion.php';
// récuperation des infos de reseervation n°1
//Fusion horaire
date_default_timezone_set('Europe/Paris');
//recuperetion montantcdf & montantusd tot caisse heberge
$montantUSD = 0;
$montantFC = 0;
$montant_solde_USD=0;
$montant_solde_CDF=0;
$requete = $bdd->prepare("SELECT SUM(montantFC) AS montantFC, SUM(montantUSD) AS montantUSD,type FROM t_operation WHERE libelle='Heberge' AND hotel_id=:hotel_id GROUP BY type");
$requete->BindParam(':hotel_id',$_SESSION['id_hotel']);
$requete->execute();
$montant_cdfusd = $requete->fetchAll(PDO::FETCH_OBJ);
//var_dump($reglages);
foreach ($montant_cdfusd as $cdfusd) {
 if($cdfusd->type=='entree'){
     $montant_solde_USD=$cdfusd->montantUSD;
     $montant_solde_CDF=$cdfusd->montantFC;
 }else{
     $montant_solde_USD=$montant_solde_USD-$cdfusd->montantUSD;
     $montant_solde_CDF=$montant_solde_CDF-$cdfusd->montantFC;
 }
}
//fin
//if (isset($_POST['id_res'])) {
$id_res = $_POST['id_res'];
$id_regl = $_POST['id_reglement'];
$Montant_retirer = $_POST['montant_pourcentage'];
$montant_rembourseUSD = $_POST['montant_rembourseUSD'];
$montant_rembourseCDF = $_POST['montant_rembourseCDF'];
$statut_res = 'annulee';
$date_annule_res = date('Y-m-d H:i:s');
$date_annule = date('Y-m-d');
$id_user = $_SESSION['id_user'];
$monnaie = 'USD';
$succes =0;
//verification montant usd
if($montant_rembourseUSD > $montant_solde_USD){
    echo 'Le montant USD doit être inferieur à celui de la caisse:'.$montant_solde_USD." USD";
}elseif($montant_rembourseCDF > $montant_solde_CDF){
    echo 'Le montant CDF doit être inferieur à celui de la caisse:'.$montant_solde_CDF." CDF";
}else{
    $montantUSD = $montant_rembourseUSD;
    $montantCDF= $montant_rembourseCDF;
    //Modification de num_res dans la bdd
    $requete = $bdd->prepare("UPDATE t_reservation  SET statut_res =:statut_res WHERE id_res=:id_res");
    $requete->BindParam(':id_res', $id_res);
    $requete->BindParam(':statut_res', $statut_res);
    $requete->execute();

    $requete1 = $bdd->prepare("UPDATE t_reserve_chambre  SET statut =:statut WHERE idreserv=:idreserv");
    $requete1->BindParam(':idreserv', $id_res);
    $statut = 'libre';
    $requete1->BindParam(':statut', $statut);
    $requete1->execute();


// Fin Modification de num_res dans la bdd
//Selection  du taux de la monnaie dans la base
    $taux = $bdd->prepare("SELECT idchambre FROM t_reserve_chambre 
									   WHERE idreserv=:idreserv");
    $taux->BindParam(':idreserv', $id_res);
    $taux->execute();

    while ($donnees = $taux->fetch()) {
        $idchambre = $donnees['idchambre'];
    }

//Insertion dans la table t_annule_reservation
    $requete = $bdd->prepare("INSERT INTO t_annule_reservation (id_res,id_ch,id_user,id_regl,Montant_retirer,monnaie,poucentage,mont_remb,date_annule_res,date_annule)
                                                                    VALUES(:id_res,:id_ch,:id_user,:id_regl,:Montant_retirer,:monnaie,:poucentage,:mont_remb,:date_annule_res,:date_annule)");
    $requete->BindParam(':id_res', $id_res);
    $requete->BindParam(':id_ch', $idchambre);
    $requete->BindParam(':id_user', $id_user);
    $requete->BindParam(':id_regl', $id_regl);
    $requete->BindParam(':Montant_retirer', $Montant_retirer);
    $requete->BindParam(':monnaie', $monnaie);
    $requete->BindParam(':poucentage', $_SESSION['poucentage']);
    $requete->BindParam(':mont_remb', $_SESSION['mont_remb']);
    $requete->BindParam(':date_annule_res', $date_annule_res);
    $requete->BindParam(':date_annule', $date_annule);
    $requete->execute();
    $operation_caisse='sortie';
    require '../../souscription/select_data_motif.php';
    require '../Amelioration/caisse/caisse_insertion.php';
    echo 'succes';
}
//fin


?>