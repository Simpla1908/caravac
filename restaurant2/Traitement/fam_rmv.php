<?php
include('../bdd/connexion.php');
$id= $_GET['id'];
$requete = $bdd->prepare("DELETE FROM  stk_famille WHERE idfamille=:id");
$requete->BindParam(':id',$id);
$requete->execute();
echo $id;
?>