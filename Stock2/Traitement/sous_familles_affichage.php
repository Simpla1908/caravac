<?php
// Initialisation de la session
if (!isset($_SESSION)) {
    session_start();
}
include('../bdd/connexion.php');

$requete = $bdd->prepare("SELECT * FROM  stk_famille AS f,stk_sous_famille sf"
            . " WHERE f.idfamille= sf.famille AND f.hotel_id=:hotel_id AND f.plat=0 AND sf.pseudo_supp=0 ORDER BY sf.des");

$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->execute();
$sous_familles = $requete->fetchAll(PDO::FETCH_OBJ);
