<?php
session_start();
include '../bdd/connexion.php';

if (isset($_GET['table_res_id'])) {
    $table_res_id=$_GET['table_res_id'];
    $statut='libre';

//Update du num_com
$requete = $bdd->prepare("UPDATE  t_client  SET statut =:statut WHERE id_client=:id_client");
$requete->BindParam(':statut', $statut);
$requete->BindParam(':id_client', $table_res_id);
$requete->execute();

echo $table_res_id;
}