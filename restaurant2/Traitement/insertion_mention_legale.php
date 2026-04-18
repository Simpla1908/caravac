<?php
session_start();
include '../bdd/connexion.php';
$json = array();
$json['message'] = ''; 
$json['s'] =False; 
$libelle=trim($_POST['nompos']);
$taux=trim($_POST['taux_op2']);
$remise=trim($_POST['remise']);
$ml=trim($_POST['ml']);
$id_sousresto=$_SESSION['id_sousresto'];
$json['nompos'] = ''; 
if($ml==''){
   $json['message'] = 'vide'; 
}elseif($libelle==''){
    $json['message'] = 'Veuillez entrer le nom du sous-site'; 
}elseif($taux==''){
    $json['message'] = 'Veuillez entrer le taux du sous-site'; 
}elseif($remise==''){
    $json['message'] = 'Veuillez entrer la remise'; 
}
else{
    
$requete = $bdd->prepare("UPDATE  t_sousresto  SET libelle=:libelle,taux=:taux, mentionlegale =:mentionlegale,remise=:remise WHERE id_sousresto=:id_sousresto");
$requete->BindParam(':libelle',$libelle);
$requete->BindParam(':taux',$taux);
$requete->BindParam(':mentionlegale', $ml);
$requete->BindParam(':remise', $remise);
$requete->BindParam(':id_sousresto', $id_sousresto);
$requete->execute();

$requete = $bdd->prepare("UPDATE  t_depot  SET libelle=:libelle WHERE id_depot=:id_depot");
$requete->BindParam(':libelle',$libelle);
$requete->BindParam(':id_depot',$_SESSION['depot_id']);
$requete->execute();

$requete = $bdd->prepare("UPDATE  t_reglage  SET tauxdollar =:taux,taux_op =:taux WHERE id_hotel=:id_hotel");
    $requete->BindParam(':taux', $taux);
    $requete->BindParam(':id_hotel',$_SESSION['id_hotel']);
    $requete->execute();
    
$json['s'] =True; 
 $_SESSION['libelle_resto'] = $libelle;
 $_SESSION['taux_resto'] = $taux;
 $_SESSION['mention']=$ml ;
 $_SESSION['remise']=$remise ;
$json['nom_ssite'] =$libelle; 
$json['message'] = 'succes'; 

}
echo json_encode($json);


