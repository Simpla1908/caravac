<?php

// Initialisation de la session
if (!isset($_SESSION)) {
    session_start();
}
$hotel_id=$_SESSION['id_hotel'];
include('../Amelioration/bdd/connexion .php');
$hotel_id=$_SESSION['id_hotel'];
$requete = $bdd->prepare("SELECT DISTINCT v.user_vers AS id_user,u.nom_user FROM t_utilisateur AS u,t_versement AS v WHERE v.user_vers=u.id_user AND v.id_hotel=:id_hotel ORDER BY u.nom_user ASC");
$requete->BindParam(':id_hotel',$hotel_id);
$requete->execute();
$users = $requete->fetchAll(PDO::FETCH_OBJ);
?>
