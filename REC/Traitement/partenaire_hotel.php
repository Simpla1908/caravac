<?php
// Initialisation de la session
if (!isset($_SESSION)) {
    session_start();
}
//include('../Amelioration/bdd/connexion .php');
$requete = $bdd->prepare("SELECT * FROM t_responsable WHERE company_id=:company_id");
$requete->BindParam(':company_id',$_SESSION['company_id']);
$requete->execute();
$partenaire = $requete->fetchAll(PDO::FETCH_OBJ);
