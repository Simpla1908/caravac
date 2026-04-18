<?php
// Initialisation de la session
 if (!isset($_SESSION)) {
            session_start();
 }
include('../bdd/connexion.php');

$requete = $bdd->prepare("SELECT * FROM  stk_famille AS f"
                          . " WHERE f.hotel_id=:hotel_id ORDER BY designation");
//session à enlever
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->execute();
$familles = $requete-> fetchAll(PDO::FETCH_OBJ);

