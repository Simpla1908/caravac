<?php

// Initialisation de la session
if (!isset($_SESSION)) {
    session_start();
}
include('../Amelioration/bdd/connexion .php');
$requete = $bdd->prepare("SELECT * FROM module WHERE id<>:id ORDER BY nom ASC");
$requete->BindParam(':id',$_GET['idmodule']);
$requete->execute();
$modules = $requete->fetchAll(PDO::FETCH_OBJ);

?>
