<?php
session_start();
include('../bdd/connexion.php');
include '../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
include 'PHPMailer/class.phpmailer.php';
include '../FUNCTION/reference.php';
$mode_paie = $_GET['mode_paie'];
$company =  $_SESSION['company_id'];
$id_site = $_SESSION['id_hotel'];
//recuperation idsouscription
$requete = $bdd->prepare("SELECT id FROM  souscription WHERE compagny_id=:id_c");
$requete->BindParam(':id_c', $company);
$requete->execute();
$requete_sous= $requete->fetchAll(PDO::FETCH_OBJ);
foreach ($requete_sous as $requete_sous) $souscription_id = $requete_sous->id;
 //insertion dans  t_modulecompany
$nb = count($_SESSION['souscri']['module']);
$tot=0;
for ($i = 0; $i < $nb; $i++) {
    $requete = $bdd->prepare("INSERT INTO t_modulecompany(nbreuser,nbre_user_maj,etat_module,montantmodule,prix_id,company_id,module_id,souscription_id,date_sous,site_id)
                             VALUES(:nbreuser,:nbre_user_maj,:etat_module,:montantmodule,:prix_id,:company_id,:module_id,:souscription_id,:date_sous,:site_id)");
$requete1 = $bdd->prepare("SELECT id,prix_user FROM  prix WHERE module_id=:module  AND souscription=:souscription");
$requete1->BindParam(':module',$_SESSION['souscri']['module'][$i]);
$requete1->BindParam(':souscription',$_SESSION['souscri']['licence'][$i]);
$requete1->execute();
$prix= $requete1->fetchAll(PDO::FETCH_OBJ);
foreach ($prix as $prix)$prix_id = $prix->id;
$nbreuser=$_SESSION['souscri']['users'][$i];
$nbre_user_maj=$nbreuser;
$etat_module=0;
    //recuperation tva dans table reglage_systeme
$req_tva=$bdd->prepare("SELECT tva FROM reglage_systeme");
$req_tva->execute();
$tva=$req_tva->fetchAll(PDO::FETCH_OBJ);
foreach ($tva as $tva)$tva=$tva->tva;
$montantmodule=$_SESSION['souscri']['prix'][$i]+($_SESSION['souscri']['prix'][$i]*$tva/100);
$prix_id=$prix_id;
$company_id=$company;
$module_id=$_SESSION['souscri']['module'][$i];
$date_sous=date('Y-m-d');
$tot+=$montantmodule;
$requete->BindParam(':nbreuser', $nbreuser);
$requete->BindParam(':nbre_user_maj', $nbre_user_maj);
$requete->BindParam(':etat_module', $etat_module);
$requete->BindParam(':montantmodule', round($montantmodule,2));
$requete->BindParam(':prix_id', $prix_id);
$requete->BindParam(':company_id', $company_id);
$requete->BindParam(':module_id', $module_id);
$requete->BindParam(':souscription_id', $souscription_id);
$requete->BindParam(':date_sous', $date_sous);
$requete->BindParam(':site_id', $id_site);
$requete->execute();

    }
//mise a jour montant total dans souscription
$requete = $bdd->prepare("UPDATE souscription SET montant_tot_sous=montant_tot_sous+:montant_tot_sous WHERE id=:id");
$requete->BindParam(':montant_tot_sous',round($tot,2));
$requete->BindParam(':id', $souscription_id);
$requete->execute();
//mise a jour statut du site
$statut_site='en attente';
$requete = $bdd->prepare("UPDATE t_hotel SET statut_site=:statut_site WHERE id_hotel=:id_site");
$requete->BindParam(':statut_site',$statut_site);
$requete->BindParam(':id_site', $id_site);
$requete->execute();
echo $id_site;
