<?php
// Initialisation de la session
if (!isset($_SESSION)) {
    session_start();
}
//$_GET['id_hotel']=1;
//include('../Amelioration/bdd/connexion .php');
$requete = $bdd->prepare("SELECT * FROM t_hotel WHERE id_hotel<>:id_hotel");
$requete->BindParam(':id_hotel',$_GET['id_hotel']);
$requete->execute();
$hotels = $requete->fetchAll(PDO::FETCH_OBJ);
