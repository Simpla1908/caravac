<?php
session_start();
include('../bdd/connexion.php');
include '../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
include 'PHPMailer/class.phpmailer.php';
$mode_paie = $_GET['mode_paie'];
 //insertion dans compagny
 $requete = $bdd->prepare("INSERT INTO t_company(nom_c,etat,adresse_c,logo,idnat,rccm)
			                 VALUES(:nom_c,:etat,:adresse_c,:logo,:idnat,:rccm)");
$nom_c=$_SESSION['compagnie'];
$etat='';
$adresse_c='';
$logo='';
$idnat='';
$rccm='';
$requete->BindParam(':nom_c', $nom_c);
$requete->BindParam(':etat', $etat);
$requete->BindParam(':adresse_c',$adresse_c);
$requete->BindParam(':logo', $logo);
$requete->BindParam(':idnat', $idnat);
$requete->BindParam(':rccm', $rccm);
$requete->execute();
$compagnie = $bdd->lastInsertId();
//insertion dans souscription
$requete = $bdd->prepare("INSERT INTO souscription(compagny_id,libelle,date_sous,date_activ,mode_paie,montant_tot_sous)
			                 VALUES(:compagny_id,:libelle,:date_sous,:date_activ,:mode_paie,:montant_tot_sous)");
$compagny_id=$compagnie;
$libelle='';
$date_sous=date('Y-m-d');
$date_activ='';
$montant_tot_sous=0;
$requete->BindParam(':compagny_id', $compagny_id);
$requete->BindParam(':libelle', $libelle);
$requete->BindParam(':date_sous',$date_sous);
$requete->BindParam(':date_activ', $date_activ);
$requete->BindParam(':mode_paie', $mode_paie);
$requete->BindParam(':montant_tot_sous', $montant_tot_sous);
$requete->execute();
$souscription= $bdd->lastInsertId();
 //insertion dans utilisateur
 $requete = $bdd->prepare("INSERT INTO t_utilisateur (nom_user,prenom_user,sexe_user,telephone_user,email_user,mdp_user,type,actif,id_hotel,company_id,id_droit)
			                 VALUES(:nom_user,:prenom_user,:sexe_user,:telephone_user,:email_user,:mdp_user,:type,:actif,:id_hotel,:company_id,:id_droit)");

$nom_user=$_SESSION['nom_souscri'] ; 
$prenom_user=$_SESSION['prenom']; 
$sexe_user=$_SESSION['sexe'] ; 
$telephone_user=$_SESSION['tel']; 
$email_user=$_SESSION['login'] ; 
$mdp_user=$_SESSION['mdp']; 
$adresse_mail=$_SESSION['email']; 
$type=1; 
$actif=1; 
$id_hotel=NULL; 
$company_id=$compagnie; 
$id_droit=1; 
$requete->BindParam(':nom_user', $nom_user);
$requete->BindParam(':prenom_user', $prenom_user);
$requete->BindParam(':sexe_user', $sexe_user);
$requete->BindParam(':telephone_user', $telephone_user);
$requete->BindParam(':email_user', $email_user);
$requete->BindParam(':mdp_user',$mdp_user);
$requete->BindParam(':type',$type);
$requete->BindParam(':actif',$actif);
$requete->BindParam(':id_hotel',$id_hotel);
$requete->BindParam(':company_id',$company_id); 
$requete->BindParam(':id_droit',$id_droit); 
$requete->execute();
 //insertion dans  t_modulecompany
$nb = count($_SESSION['souscri']['module']);
$tot=0;
for ($i = 0; $i < $nb; $i++) {
$requete = $bdd->prepare("INSERT INTO t_modulecompany(nbreuser,etat_module,montantmodule,prix_id,company_id,module_id,souscription_id)
			                 VALUES(:nbreuser,:etat_module,:montantmodule,:prix_id,:company_id,:module_id,:souscription_id)");
$requete1 = $bdd->prepare("SELECT id,prix_user FROM  prix WHERE module_id=:module  AND souscription=:souscription");
$requete1->BindParam(':module',$_SESSION['souscri']['module'][$i]);
$requete1->BindParam(':souscription',$_SESSION['souscri']['licence'][$i]);
$requete1->execute();
$prix= $requete1->fetchAll(PDO::FETCH_OBJ);
foreach ($prix as $prix) {
	$prix_id = $prix->id;
	$prix = $prix->prix_user;
}
$nbreuser=$_SESSION['souscri']['users'][$i];
$etat_module=1;
$montantmodule=$_SESSION['souscri']['users'][$i]*$prix ;
$prix_id=$prix_id;
$company_id=$compagnie;
$module_id=$_SESSION['souscri']['module'][$i];
$souscription_id=$souscription;
$tot+=$montantmodule;
$requete->BindParam(':nbreuser', $nbreuser);
$requete->BindParam(':etat_module', $etat_module);
$requete->BindParam(':montantmodule',$montantmodule);
$requete->BindParam(':prix_id', $prix_id);
$requete->BindParam(':company_id', $company_id);
$requete->BindParam(':module_id', $module_id);
$requete->BindParam(':souscription_id', $souscription_id);
$requete->execute();
$modulecompagny= $bdd->lastInsertId();
//insertion dans  t_facture
// $requete = $bdd->prepare("INSERT INTO  t_facture (etat,montant_total,mont_tva,modulecompagny)
// VALUES(:etat,:montant_total,:modulecompagny)");
// $etat="brouillon";
// $montant_total=$montantmodule;
// $montant_total_tva=$montantmodule+$montantmodule* $tva;
// $modulecompagny=$modulecompagny;
// $requete->BindParam(':etat', $etat);
// $requete->BindParam(':montant_total', $montant_total);
// $requete->BindParam(':mont_tva', $montant_total_tva);
// $requete->BindParam(':modulecompagny', $modulecompagny);
// $requete->execute();
// /* Fin d'Insertion dans t_facture */
// //Modification de num_fact dans la bdd
// $id_fact = $bdd->lastInsertId();
// $num_fact = 'Fac/' . str_pad($id_fact, 5, "0", STR_PAD_LEFT); //00001;
// $requete = $bdd->prepare("UPDATE t_facture  SET num_fact =:num_fact WHERE id_fact=:id_fact");
// $requete->BindParam(':id_fact', $id_fact);
// $requete->BindParam(':num_fact', $num_fact);
// $requete->execute();
// Fin Modification de num_fact dans la bdd

	}
//mise à jour montant total dans souscription
$requete = $bdd->prepare("UPDATE souscription SET montant_tot_sous=:montant_tot_sous WHERE id=:id");
$requete->BindParam(':montant_tot_sous',$tot);
$requete->BindParam(':id', $souscription);
$requete->execute();
//envoie d'un mail
$mail = new PHPMailer();
$mail->IsHTML(true);
$mail->CharSet = "utf-8";
$mail->SetFrom('expediteur@gmail.com', 'Expéditeur');
$mail->Subject = 'Objet de l\'email';
$mail->Body = '<p><b>E-Mail</b> au format <i>HTML</i>.</p>';
$mail->AddAddress($adresse_mail);
if(!$mail->send()) 
{
    echo "Mailer Error: " . $mail->ErrorInfo;
} 
else 
{
    echo "Message has been sent successfully";
}