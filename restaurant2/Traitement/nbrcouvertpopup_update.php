<?php
if (!isset($_SESSION)){
    session_start();
}

include '../bdd/connexion.php';
$nbrcouvert = $_GET['nbrcouvert'];
$id_client= $_GET['id_client'];
$requete = $bdd->prepare("UPDATE t_client  SET nbrcouvert =:nbrcouvert  WHERE id_client=:client_id");
$requete->BindParam(':nbrcouvert', $nbrcouvert);
$requete->BindParam(':client_id', $id_client);
$requete->execute();