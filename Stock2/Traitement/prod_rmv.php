<?php
include('../bdd/connexion.php');
$id= $_GET['id'];
$pseudo_supp=1;
$requete = $bdd->prepare("UPDATE stk_produit SET pseudo_supp=:pseudo_supp WHERE idprod=:id");
$requete->BindParam(':pseudo_supp',$pseudo_supp);
$requete->BindParam(':id',$id);
$requete->execute();
?>