<?php
session_start();
include('../bdd/connexion.php');
include('../../FUNCTION/stock.php');
$json = array();
//RECUPERATION DES DONNEES
$id_fiche = $_POST['id_fiche'];
$num_bon = $_POST['num_bon'];
$depot_id = $_POST['depot_id'];
$erreur=0;
//FIN RECUPERATION
$N = count($_POST["validates"]);
for ($i = 0; $i < $N; $i++) {
$id_validation=$_POST["validates"][$i];
$qteE=$_POST["qteE".$id_validation];
$qteR=$_POST["qteR".$id_validation];
if($qteR==''||$qteR==0||$qteR>$qteE)$erreur=1;
}
if($erreur==0){
//MAJ STK FICHE
$approuve=1;
$requete = $bdd->prepare("UPDATE skt_fiche SET approuve=:approuve WHERE id_fiche=:id_fiche");
$requete->BindParam(':approuve', $approuve);
$requete->BindParam(':id_fiche', $id_fiche);
$requete->execute();
//FIN MAJ STK FICHE
$N = count($_POST["validates"]);
for ($i = 0; $i < $N; $i++) {
$id_validation=$_POST["validates"][$i];
$idprod=$_POST["idprod".$id_validation];
$qteE=$_POST["qteE".$id_validation];
$qteR=$_POST["qteR".$id_validation];
//MAJ T VALIDAT
$requete = $bdd->prepare("UPDATE t_validation SET qte_verif=:qte_verif WHERE id_validation=:id_validation");
$requete->BindParam(':qte_verif', $qteR);
$requete->BindParam(':id_validation', $id_validation);
$requete->execute();
//FIN MAJ 

//INSERTION DANS T MOUVEMENT
$quantite=$qteR;
$date_bon=date('Y-m-d');
$article=$idprod;
$fiche_id=$id_fiche;
$user_id=$_SESSION['id_user'];
$hotel_id=$_SESSION['id_hotel'];
$motif_sortie_id=6;
ApprovisionnementStk($quantite,$date_bon,$article,$fiche_id,$depot_id,$user_id,$hotel_id,$motif_sortie_id,$bdd);
//FIN

}
     $json['message_erreur'] = 'no';

}else{
     $json['message_erreur'] = 'yes';
}
echo json_encode($json);
