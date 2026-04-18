<?php
session_start();
include '../bdd/connexion.php';
$json = array();
$json['message'] = '';
$noms = $_POST['noms'];
$sexe = $_POST['sexe'];
$tel = $_POST['tel'];
$email = $_POST['email'];
$remise = $_POST['remisecl'];
$type = "client";
$type_cl = 'restaurant';
if ($noms == '' || $sexe == '' || $tel == '' || $email == '' || $remise == '') {
   $json['message'] = 'vide';
} else {

   $requete = $bdd->prepare("INSERT INTO t_client (nom_client,sexe_client,email_client,telephone_client,type,id_hotel,type_cl,remise)
			                    VALUES(:nom_client,:sexe_client,:email_client,:telephone_client,:type,:id_hotel,:type_cl,:remise)");

   $requete->BindParam(':nom_client', $noms);
   $requete->BindParam(':sexe_client', $sexe);
   $requete->BindParam(':email_client', $email);
   $requete->BindParam(':telephone_client', $tel);
   $requete->BindParam(':type', $type);
   $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
   $requete->BindParam(':type_cl', $type_cl);
   $requete->BindParam(':remise', $remise);
   $requete->execute();
   $json['message'] = 'succes';
}
echo json_encode($json);
