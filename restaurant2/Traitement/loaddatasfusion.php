<?php
if (!isset($_SESSION)) {
session_start();
}
$id_client=$_GET['id_client'];
$nom_client=$_GET['nom_client'];
$id_fact=$_GET['id_fact'];
$mont_ttc=$_GET['mont_ttc'];
$taux=$_GET['taux'];
$type_cl=$_GET['type_cl'];
$serveur_id=$_GET['serveur_id'];
$serveur_name=$_GET['serveur_name'];
 if (!in_array($id_client, $_SESSION['fusion']['id_client'])) {
 array_push($_SESSION['fusion']['id_client'], $id_client);
 $_SESSION['fusion']['nom_client'][$id_client]=$nom_client;
 $_SESSION['fusion']['id_fact'][$id_client]=$id_fact;
 $_SESSION['fusion']['mont_ttc'][$id_client]=$mont_ttc;
 $_SESSION['fusion']['taux'][$id_client]=$taux;
 $_SESSION['fusion']['type_cl'][$id_client]=$type_cl;
 $_SESSION['fusion']['serveur_id'][$id_client]=$serveur_id;
 $_SESSION['fusion']['serveur_name'][$id_client]=$serveur_name;
 }
