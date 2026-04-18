<?php
include('../bdd/connexion.php');
$idmvt= $_GET['id'];
$requete = $bdd->prepare("DELETE FROM stk__mouvement WHERE idmvt=:idmvt");
$requete->BindParam(':idmvt',$idmvt);
$requete->execute();
?>