<?php
// Initialisation de la session
if (!isset($_SESSION)) {
    session_start();
}
//include('../Amelioration/bdd/connexion .php');
$requete = $bdd->prepare("SELECT * FROM  t_utilisateur WHERE type !=1 AND id_hotel=:hotel_id  AND psedo=0 ORDER BY nom_user ASC");
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->execute();
$utilisateurs = $requete->fetchAll(PDO::FETCH_OBJ);
