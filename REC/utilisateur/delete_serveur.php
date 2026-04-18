<?php

include('../Amelioration/bdd/connexion .php');
$id= $_GET['id'];
$pseudo_supp=1;
$requete = $bdd->prepare("UPDATE serveurs SET psedo=:pseudo_supp WHERE id=:id");
$requete->BindParam(':pseudo_supp',$pseudo_supp);
$requete->BindParam(':id',$id);
$requete->execute();

