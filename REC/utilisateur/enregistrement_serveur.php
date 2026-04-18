<?php
session_start();
include('../Amelioration/bdd/connexion .php');

$json = array();
$json['message'] = "";

if (empty($_POST['nom']) || empty($_POST['prenom'])) {
    $json['message'] = 'champvide';
}else {

    $code =null;
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $tel = $_POST['tel'];
    $sexe = $_POST['sexe'];
    $hotel_id = $_POST['hotel_id'];

    $requete = $bdd->prepare("INSERT INTO serveurs(code,nom,prenom,tel,sexe,site_id)
			         VALUES(:code,:nom,:prenom,:tel,:sexe,:site_id)");
    $requete->BindParam(':code', $code);
    $requete->BindParam(':nom', $nom);
    $requete->BindParam(':prenom', $prenom);
    $requete->BindParam(':tel', $tel);
    $requete->BindParam(':sexe', $sexe);
    $requete->BindParam(':site_id',$hotel_id);
    $requete->execute();
   
    $json['message'] = 'succes';
}
echo json_encode($json);
