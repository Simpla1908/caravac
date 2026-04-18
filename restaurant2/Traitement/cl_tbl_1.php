<?php

// Initialisation de la session
// session_start();
include('bdd/connexion.php');

//$tables=array();
//if (in_array('VLTR', $_SESSION['actions']['code_actions'])){
//    $type_cl = 'table';
//    $requete = $bdd->prepare("SELECT * FROM  t_client AS cl WHERE cl.id_hotel=:hotel_id AND cl.type=:type_cl  ORDER BY cl.id_client ASC");
//    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
//    $requete->BindParam(':type_cl', $type_cl);
//    $requete->execute();
//    $tables = $requete->fetchAll(PDO::FETCH_OBJ);  
//}elseif(in_array('TBLOCP', $_SESSION['actions']['code_actions'])){
//    $type_cl = 'table';
//    $requete = $bdd->prepare("SELECT * FROM  t_client AS cl WHERE cl.id_hotel=:hotel_id AND cl.type=:type_cl AND cl.en_attente=1 ORDER BY cl.id_client ASC");
//    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
//    $requete->BindParam(':type_cl', $type_cl);
//    $requete->execute();
//    $tables = $requete->fetchAll(PDO::FETCH_OBJ);   
//}
//$type_cl = 'table';
//$requete = $bdd->prepare("SELECT * FROM  t_client AS cl WHERE cl.id_hotel=:hotel_id AND cl.type=:type_cl AND (cl.statut='libre' OR cl.statut='reserve') ORDER BY cl.id_client ASC");
//$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
//$requete->BindParam(':type_cl', $type_cl);
//$requete->execute();
//$tables = $requete->fetchAll(PDO::FETCH_OBJ);

//$type_cl = 'serveur';
//$requete = $bdd->prepare("SELECT cl.id_client,cl.id_hotel,cl.type,cl.nom_client FROM  t_client AS cl WHERE cl.id_hotel=:hotel_id AND cl.type=:type_cl  ORDER BY cl.nom_client ASC");
//$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
//$requete->BindParam(':type_cl', $type_cl);
//$requete->execute();
//$serveurs = $requete->fetchAll(PDO::FETCH_OBJ);


$client_occasionnel ='';
if(in_array('AR6', $_SESSION['actions']['code_actions'])){
$type_cl = 'occasionnel';
$requete = $bdd->prepare("SELECT * FROM  t_client AS cl WHERE cl.id_hotel=:hotel_id AND cl.type=:type_cl");
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->BindParam(':type_cl', $type_cl);
$requete->execute();
$client_occasionnel = $requete->fetchAll(PDO::FETCH_OBJ);
$type_cl = 'client';
$requete = $bdd->prepare("SELECT * FROM  t_client AS cl WHERE cl.id_hotel=:hotel_id AND cl.type=:type_cl AND cl.pseudo_supp=0");
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->BindParam(':type_cl', $type_cl);
$requete->execute();
$clients = $requete->fetchAll(PDO::FETCH_OBJ); 
}elseif(in_array('VSCQOC', $_SESSION['actions']['code_actions'])){
$type_cl = 'client';
$requete = $bdd->prepare("SELECT * FROM  t_client AS cl WHERE cl.id_hotel=:hotel_id AND cl.type=:type_cl AND cl.en_attente=1
AND cl.pseudo_supp=0");
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->BindParam(':type_cl', $type_cl);
$requete->execute();
$clients = $requete->fetchAll(PDO::FETCH_OBJ);    
}
