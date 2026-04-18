<?php
include('../../bdd/connexion.php');
$tvaval = $_POST['tvaval'];
$requete = $bdd->prepare("UPDATE reglage_systeme SET tva=:tva");
$requete->BindParam(':tva',$tvaval);
$requete->execute();
?>