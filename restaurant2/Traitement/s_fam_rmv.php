<?php
include('../bdd/connexion.php');
$id= $_GET['id'];
$requete = $bdd->prepare("DELETE FROM  stk_sous_famille WHERE id_s_fam=:id");
$requete->BindParam(':id',$id);
$requete->execute();
?>