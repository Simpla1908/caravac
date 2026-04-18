<?php

include('../Amelioration/bdd/connexion .php');
$json = array();
$json['message'] = "";

if (empty($_POST['nom']) || empty($_POST['prenom'])) {
    $json['message'] = 'champvide';
} else {
    $serveur_id = $_POST['serveur_id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $tel = $_POST['tel'];
    $sexe = $_POST['sexe'];
    $hotel_id = $_POST['hotel_id'];
    $code=null;

    $requete = $bdd->prepare("UPDATE serveurs SET code=:code, nom=:nom, prenom=:prenom, sexe=:sexe, tel=:tel,site_id=:site_id WHERE id=:id");

    $requete->BindParam(':nom', $nom);
    $requete->BindParam(':prenom', $prenom);
    $requete->BindParam(':tel', $tel);
    $requete->BindParam(':sexe', $sexe);
    $requete->BindParam(':site_id',$hotel_id);
    $requete->BindParam(':code', $code);
    $requete->BindParam(':id', $serveur_id);
    $requete->execute();
    $json['message'] = 'succes';
}

echo json_encode($json);
