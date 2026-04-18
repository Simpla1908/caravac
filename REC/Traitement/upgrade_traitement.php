 <?php 
 session_start ();
 include("../../bdd/connexion.php"); 
 include("../../admin/traitement/fonctionalites.php"); 

 $id=$_GET['id'];
 $tot=$_GET['tot'];
 $mode_souscription=$_GET['type'];
 $date_activ=date('Y-m-d');
 $dte_upgrade=date('Y-m-d');
 $nbrejr=1;
 if($mode_souscription=='annuel') $nbrejr=12;
 $dte_echeance=AddMonthToDate($dte_upgrade,$nbrejr);
 $nbrejr=7;
 $dte_blocage=AddDaysToDate($dte_echeance, $nbrejr);
 $statut='abonne';
 $etat=1;
 $requete = $bdd->prepare("UPDATE souscription  SET date_activ=:date_activ,dte_echeance=:dte_echeance,dte_blocage=:dte_blocage,dte_upgrade=:dte_upgrade,montant_tot_sous=:montant_tot_sous,statut=:statut,etat=:etat,type_souscription=:type_souscription WHERE id=:id");
 $requete->BindParam(':date_activ', $date_activ);
 $requete->BindParam(':dte_echeance', $dte_echeance);
$requete->BindParam(':dte_blocage', $dte_blocage);
$requete->BindParam(':dte_upgrade', $dte_upgrade);
$requete->BindParam(':montant_tot_sous', $tot);
$requete->BindParam(':statut', $statut);
$requete->BindParam(':etat', $etat);
$requete->BindParam(':type_souscription', $mode_souscription);
$requete->BindParam(':id', $id);
$requete->execute();
 ?>
