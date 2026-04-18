<?php
session_start();
include '../bdd/connexion.php';

if (isset($_GET['table_res_id'])) {
    $table_res_id=$_GET['table_res_id'];
    $pseudo_supp=1;

//Update du num_com
$requete = $bdd->prepare("UPDATE  t_client  SET pseudo_supp =:pseudo_supp WHERE id_client=:id_client");
$requete->BindParam(':pseudo_supp', $pseudo_supp);
$requete->BindParam(':id_client', $table_res_id);
$requete->execute();
}