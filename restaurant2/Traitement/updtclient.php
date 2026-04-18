<?php
session_start();
include '../bdd/connexion.php';
include '../../FUNCTION/hebergement.php';
$json = array();
$json['message'] = ''; 
$id=$_POST['id'];
$noms=$_POST['noms'];
$sexe = $_POST['sexe'];
$tel = $_POST['tel'];
$email =$_POST['email'];
$remise=$_POST['remise'];

if($noms==''||$sexe==''||$tel==''||$email==''||$remise==''){
   $json['message'] = 'vide'; 
}else{
   
    $requete = $bdd->prepare("UPDATE t_client SET nom_client=:nom_client,sexe_client=:sexe_client,email_client=:email_client,telephone_client=:telephone_client,remise=:remise WHERE id_client=:id");
    $requete->BindParam(':nom_client', $noms);
    $requete->BindParam(':sexe_client',$sexe);
    $requete->BindParam(':email_client', $email);
    $requete->BindParam(':telephone_client',$tel);
    $requete->BindParam(':remise',$remise);
    $requete->BindParam(':id',$id);
    $requete->execute();
    $json['message'] = 'succes'; 

}
echo json_encode($json);


