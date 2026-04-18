<?php
session_start();
include '../../bdd/connexion.php';

$requete = $bdd->prepare("SELECT * FROM t_chambre WHERE id_hotel=:hotel_id");
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->execute();
$operation_ch = $requete->fetchAll(PDO::FETCH_OBJ);




