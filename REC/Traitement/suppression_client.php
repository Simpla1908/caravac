<?php
include('../../bdd/connexion.php');
$id_client= $_GET['id'];
$requete = $bdd->prepare("DELETE FROM t_client WHERE id_client=:id_client");
$requete->BindParam(':id_client',$id_client);
$requete->execute();
?>