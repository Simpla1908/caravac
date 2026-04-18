<?php
session_start();
$json = array();
include '../bdd/connexion.php';

$sous_resto=$_GET['sous_resto'];
$user_id=$_GET['user_id'];
$date_affect=date('Y-m-d');
$statut=1;
$etat=0;

$requete = $bdd->prepare("SELECT id_affect,sousresto_id,statut FROM affectation_sousresto AS a WHERE a.user_id=:user_id AND a.statut=:statut");
$requete->BindParam(':user_id', $user_id);
$requete->BindParam(':statut', $statut);
$requete->execute();
$result = $requete->fetchAll(PDO::FETCH_OBJ);
foreach ($result as $r) {
   $id_affect=$r->id_affect; 
   $etat=$r->statut; 
   $sousresto_id=$r->sousresto_id;
}
if($etat==1){
    //UPDATE affectation_sousresto
    $statut1=0;
    $requete = $bdd->prepare("UPDATE affectation_sousresto SET statut=:statut WHERE id_affect=:id_affect");
    $requete->BindParam(':statut', $statut1);
    $requete->BindParam(':id_affect', $id_affect);
    $requete->execute();
    
    //INSERTION affectation_sousresto
    $requete = $bdd->prepare("INSERT INTO  affectation_sousresto(date_affect,user_id,sousresto_id,statut)
                    VALUES(:date_affect,:user_id,:sousresto_id,:statut)");
    $requete->BindParam(':date_affect', $date_affect);
    $requete->BindParam(':user_id', $user_id);
    $requete->BindParam(':sousresto_id', $sous_resto);
    $requete->BindParam(':statut', $statut);
    $requete->execute();
}  else {
    $requete = $bdd->prepare("INSERT INTO  affectation_sousresto(date_affect,user_id,sousresto_id,statut)
                    VALUES(:date_affect,:user_id,:sousresto_id,:statut)");
    $requete->BindParam(':date_affect', $date_affect);
    $requete->BindParam(':user_id', $user_id);
    $requete->BindParam(':sousresto_id', $sous_resto);
    $requete->BindParam(':statut', $statut);
    $requete->execute();
}

//  echo 'Enregistrement effectue avec succes';
$json['message_succes'] = 'succes';
//
//
echo json_encode($json);
?>