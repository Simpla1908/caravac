<?php

// Initialisation de la session
// session_start();
include('bdd/connexion.php');
$type_cl = 'table';
$requete = $bdd->prepare("SELECT * FROM  t_client AS cl WHERE cl.id_hotel=:hotel_id AND cl.en_attente=0 AND cl.type=:type_cl AND (cl.statut='libre' OR cl.statut='reserve') ORDER BY cl.id_client ASC");
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->BindParam(':type_cl', $type_cl);
$requete->execute();
$tables = $requete->fetchAll(PDO::FETCH_OBJ);

$type_cl = 'client';
$requete = $bdd->prepare("SELECT cl.id_client,cl.id_hotel,cl.type,cl.nom_client,ch.id_ch,ch.num_ch,rc.id,rc.idreserv FROM  t_client AS cl ,t_chambre AS ch, t_reserve_chambre AS rc  "
    . "WHERE rc.id_client=cl.id_client AND rc.idchambre=ch.id_ch AND rc.statut='occupe' AND cl.id_hotel=:hotel_id AND cl.type=:type_cl  ORDER BY cl.id_client ASC");
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->BindParam(':type_cl', $type_cl);
$requete->execute();
$clients = $requete->fetchAll(PDO::FETCH_OBJ);

$type_cl = 'occasionnel';
$requete = $bdd->prepare("SELECT * FROM  t_client AS cl WHERE cl.id_hotel=:hotel_id AND cl.type=:type_cl");
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->BindParam(':type_cl', $type_cl);
$requete->execute();
$client_occasionnel = $requete->fetchAll(PDO::FETCH_OBJ);