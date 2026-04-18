<?php
session_start();
include('../bdd/connexion.php');
//include '../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
include '../FUNCTION/reference.php';
include '../FUNCTION/hebergement.php';
include '../admin/traitement/fonctionalites.php';
include '../lib/password_compat-master/lib/password.php';
require_once '../PHPMailer/class.phpmailer.php';
include '../FUNCTION/envoi_mail.php';
//recuperation tva dans table reglage_systeme
$req_tva=$bdd->prepare("SELECT tva FROM reglage_systeme");
$req_tva->execute();
$tva=$req_tva->fetchAll(PDO::FETCH_OBJ);
foreach ($tva as $tva)$tva=$tva->tva;
//$mode_paie=$_GET['mode_paie'];
$mode_paie='';

//creation company
$requete=$bdd->prepare("INSERT INTO t_company(nom_c,etat,adresse_c,logo,idnat,rccm)
                             VALUES(:nom_c,:etat,:adresse_c,:logo,:idnat,:rccm)");
$nom_c=$_SESSION['compagnie'];
$etat='';
$adresse_c='';
$logo='';
$idnat='';
$rccm='';
$requete->BindParam(':nom_c', $nom_c);
$requete->BindParam(':etat', $etat);
$requete->BindParam(':adresse_c', $adresse_c);
$requete->BindParam(':logo', $logo);
$requete->BindParam(':idnat', $idnat);
$requete->BindParam(':rccm', $rccm);
$requete->execute();
$companie_id=$bdd->lastInsertId();
//creation site
$requete=$bdd->prepare("INSERT INTO t_hotel(nom_hotel,adresse_hotel,province_hotel,ville_hotel,default_site,company_id,statut_site)
                             VALUES(:nom_hotel,:adresse_hotel,:province_hotel,:ville_hotel,:default,:company_id,:statut_site)");
$nom_hotel=$_SESSION['compagnie'];
$adresse_hotel='';
$province_hotel='';
$ville_hotel='';
$default=1;
$statut_site='opérationnel';
$requete->BindParam(':nom_hotel', $nom_hotel);
$requete->BindParam(':adresse_hotel', $adresse_hotel);
$requete->BindParam(':province_hotel', $province_hotel);
$requete->BindParam(':ville_hotel', $ville_hotel);
$requete->BindParam(':default', $default);
$requete->BindParam(':company_id', $companie_id);
$requete->BindParam(':statut_site', $statut_site);
$requete->execute();
$hotel_id=$bdd->lastInsertId();
//Données de base
include('data_configuration.php');
//creation utilisateur
$requete=
    $bdd->prepare(
        "INSERT INTO t_utilisateur (nom_user,prenom_user,sexe_user,telephone_user,email_user,mdp_user,type,actif,id_hotel,company_id,id_droit,fconnect,adresse_mail)
                             VALUES(:nom_user,:prenom_user,:sexe_user,:telephone_user,:email_user,:mdp_user,:type,:actif,:id_hotel,:company_id,:id_droit,:fconnect,:adresse_mail)");

$nom_user=$_SESSION['nom_souscri'];
$prenom_user=$_SESSION['prenom'];
$sexe_user=$_SESSION['sexe'];
$telephone_user=$_SESSION['tel'];
$email_user=$_SESSION['login'];
$mdp_user=password_hash($_SESSION['mdp'],PASSWORD_DEFAULT);
//$mdp_user=$_SESSION['mdp'];
$adresse_mail=$_SESSION['email'];
$type=1;
$actif=1;
//Mise à jour id_hotel dans la table user(n'est doit pas etre NULL)
$id_hotel=$hotel_id;
$id_droit=1;
$fconnect=0;
$requete->BindParam(':nom_user', $nom_user);
$requete->BindParam(':prenom_user', $prenom_user);
$requete->BindParam(':sexe_user', $sexe_user);
$requete->BindParam(':telephone_user', $telephone_user);
$requete->BindParam(':email_user', $email_user);
$requete->BindParam(':mdp_user', $mdp_user);
$requete->BindParam(':type', $type);
$requete->BindParam(':actif', $actif);
$requete->BindParam(':id_hotel', $id_hotel);
$requete->BindParam(':company_id',$companie_id);
$requete->BindParam(':id_droit', $id_droit);
$requete->BindParam(':fconnect', $fconnect);
$requete->BindParam(':adresse_mail',$adresse_mail);
$requete->execute();
//creation souscription
$requete=$bdd->prepare("INSERT INTO souscription(compagny_id,libelle,date_sous,date_activ,mode_paie,montant_tot_sous)
                             VALUES(:compagny_id,:libelle,:date_sous,:date_activ,:mode_paie,:montant_tot_sous)");
$libelle='SCT' . reference();
$date_sous=date('Y-m-d');
$date_activ='';
$montant_tot_sous=0;
$requete->BindParam(':compagny_id', $companie_id);
$requete->BindParam(':libelle', $libelle);
$requete->BindParam(':date_sous', $date_sous);
$requete->BindParam(':date_activ', $date_activ);
$requete->BindParam(':mode_paie', $mode_paie);
$requete->BindParam(':montant_tot_sous', $montant_tot_sous);
$requete->execute();
$souscription=$bdd->lastInsertId();
// creation facture
$type='souscription';
$systeme_id_sous=getIdSystem($bdd);
$num_cmd = getnumerotation($systeme_id_sous,$type, $bdd);
$num_cmd_format = format_numero($num_cmd);
$monnaie=getsymbole_devise();
$montant_tva=0;
$montant_remise=0;
$remise_pourcent=0;
$mont_ttc=0;
$etat=0;
$fact1=1;
$requete = $bdd->prepare("INSERT INTO t_facture (type,num_fact,tva,monnaie,date_edition,id_hotel,company_id,mont_tva,remise,mont_ttc_remise,mont_ttc,etat,modulecompagny,fact1)
                                          VALUES(:type,:num_fact,:tva,:monnaie,:date_edition,:id_hotel,:company_id,:mont_tva,:remise,:mont_ttc_remise,:mont_ttc,:etat,:modulecompagny,:fact1)");
$requete->BindParam(':type', $type);
$requete->BindParam(':num_fact',$num_cmd_format);
$requete->BindParam(':tva', $tva);
$requete->BindParam(':monnaie',$monnaie);
$requete->BindParam(':date_edition',$date_sous);
$requete->BindParam(':id_hotel', $hotel_id);
$requete->BindParam(':company_id',$companie_id);
$requete->BindParam(':mont_tva', $montant_tva);
$requete->BindParam(':remise', $montant_remise);
$requete->BindParam(':mont_ttc_remise',$remise_pourcent);
$requete->BindParam(':mont_ttc', $mont_ttc);
$requete->BindParam(':etat', $etat);
$requete->BindParam(':modulecompagny',$souscription);
$requete->BindParam(':fact1',$fact1);
$requete->execute();
$id_fact = $bdd->lastInsertId();
//  Fin creation facture
//creation pack company,module company et lignes facture
$nb=count($_SESSION['souscri']['module']);
$etat_pack=0;
$totmontantpack=0;
for ($i=0; $i < $nb; $i++) {
    $requete=$bdd->prepare("INSERT INTO t_pack_company(pack_id,company_id,etat)
                             VALUES(:pack_id,:company_id,:etat)");
    $requete->BindParam(':pack_id', $_SESSION['souscri']['module'][$i]);
    $requete->BindParam(':company_id',$companie_id);
    $requete->BindParam(':etat', $etat_pack);
    $requete->execute();
    $pack_company_id=$bdd->lastInsertId();
    $totmontantpack+=$_SESSION['souscri']['prix'][$i];
    $modules_packs=ModulesPack($_SESSION['souscri']['module'][$i],$bdd);
    $data=PrixPack($_SESSION['souscri']['module'][$i],$_SESSION['souscri']['licence'][$i],$bdd);
    $prix_id=$data['id'];
    $nbreuser=$_SESSION['souscri']['users'][$i];
    $nbre_user_maj=$nbreuser;
    
    //insertion t_lignesfact_pack
    $requete=$bdd->prepare("INSERT INTO t_lignesfact_pack(montant,pack_company_id,pack_id,fact_id,type)
                             VALUES(:montant,:pack_company_id,:pack_id,:fact_id,:type)");
    $mont_ttc_pack=$_SESSION['souscri']['prix'][$i]+montant_tva($_SESSION['souscri']['prix'][$i],0,$tva);
    $requete->BindParam(':montant',$mont_ttc_pack);
    $requete->BindParam(':pack_company_id',$pack_company_id);
    $requete->BindParam(':pack_id',$_SESSION['souscri']['module'][$i]);
    $requete->BindParam(':fact_id', $id_fact);
    $requete->BindParam(':type',$_SESSION['souscri']['licence'][$i]);
    $requete->execute();
    //fin insertion
    //insertion t_module_company
    foreach ($modules_packs as $mp):
    $module_id=$mp->idmodule;
	$nbre_agent_rh=$_SESSION['lbl_rh'];
    $etat_module=0;
    $montantmodule=0;
    $requete =
        $bdd->prepare(
            "INSERT INTO t_modulecompany(nbreuser,nbre_user_maj,etat_module,montantmodule,prix_id,pack_id,company_id,module_id,souscription_id,date_sous,site_id,nbre_agent)
    VALUES(:nbreuser,:nbre_user_maj,:etat_module,:montantmodule,:prix_id,:pack_id,:company_id,:module_id,:souscription_id,:date_sous,:site_id,:nbre_agent)");
    $requete->BindParam(':nbreuser', $nbreuser);
    $requete->BindParam(':nbre_user_maj',$nbre_user_maj);
    $requete->BindParam(':etat_module', $etat_module);
    $requete->BindParam(':montantmodule',$montantmodule);
    $requete->BindParam(':prix_id', $prix_id);
    $requete->BindParam(':pack_id', $pack_company_id);
    $requete->BindParam(':company_id', $companie_id);
    $requete->BindParam(':module_id',$module_id);
    $requete->BindParam(':souscription_id',$souscription);
    $requete->BindParam(':date_sous',$date_sous);
    $requete->BindParam(':site_id', $hotel_id);
    $requete->BindParam(':nbre_agent', $nbre_agent);
    $requete->execute();
    endforeach;
    //fin insertion
}
//maj montant_tva & mont_ttc dans t_facture
$montant_tva=montant_tva($totmontantpack,0,$tva);
$mont_ttc=$totmontantpack+$montant_tva;
$requete = $bdd->prepare("UPDATE t_facture  SET mont_tva=:mont_tva,mont_ttc=:mont_ttc WHERE id_fact=:id_fact");
$requete->BindParam(':mont_tva', $montant_tva);
$requete->BindParam(':mont_ttc', $mont_ttc);
$requete->BindParam(':id_fact', $id_fact);
$requete->execute();
paiement_souscription($id_fact,$date_sous,Null,$hotel_id,$companie_id,0,3,'',$bdd);
setnumerotation($systeme_id_sous,$type,$num_cmd+1,$bdd);
//fin maj
//envoie mail au client
$name=$prenom_user.' '.$nom_user;
$login=$email_user;
$pawd=$_SESSION['mdp'];
include './mail_souscription.php';
//fin envoie