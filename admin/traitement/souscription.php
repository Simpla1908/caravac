<?php
ini_set('display_errors',1);
?>
<?php
include '../../bdd/connexion.php';
include '../traitement/fonctionalites.php';
include '../../FUNCTION/hebergement.php';
require_once '../../PHPMailer/class.phpmailer.php';
include '../../FUNCTION/envoi_mail.php';
$action=$_POST['action'];
$montantsaisi = $_POST['montant'];
$modepaiement= $_POST['modepaiement'];
$fact_id = $_POST['fact_id'];
$mont_fact= $_POST['mont_fact'];
$modulecomp_id = $_POST['modulecomp_id'];
$lfp_id= $_POST['lfp_id'];
$pack_id= $_POST['pack_id'];
$activer=$_POST['activer'];
$id_hotel = $_POST['id_hotel'];
$company_id= $_POST['company_id'];
$dte=date('Y-m-d');
$statut=(int)$_POST['statut'];
$pack_company_id=$_POST['pack_company_id'];
$type_souscript=$_POST['type_souscript'];
$fact1=$_POST['fact1'];
$id_user=$_POST['id_user'];
$prenom_user=$_POST['prenom_user'];
$nom_user=$_POST['nom_user'];
$mail_company=$_POST['mail_company'];
$id_user=NULL;
$justification=NULL;
if ($action=='regler') {
    paiement_souscription($fact_id,$dte,$id_user,$id_hotel,$company_id,$montantsaisi,$modepaiement,$justification,$bdd);
    incrementeMontPayePack($lfp_id,$montantsaisi,$bdd);
    if($statut==0 && arrondir($montantsaisi)== arrondir($mont_fact)){
        activationPack($pack_company_id,1,$type_souscript,$dte,$bdd);
        changerEtatPayePack($pack_company_id,$bdd);
        $dte=getDateEcheance($dte,$type_souscript);
        UpdateDateEcheanceFacture($fact_id,$dte,$bdd);
        ActivationSiteCompany($id_hotel,$company_id,$bdd);
        
        if($fact1==1){
        //envoie mail au client
            $name=$prenom_user.' '.$nom_user;
            $email=$mail_company;
            $pawd='';
            include './mail_activation.php';
        //fin envoie
        }
    }
}

