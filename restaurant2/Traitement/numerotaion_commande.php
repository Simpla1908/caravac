<?php

//Numérotation de la commande

$requete = $bdd->prepare("SELECT COUNT(*) AS lignes FROM t_reservation WHERE type='commande' AND id_hotel=:id_hotel");
$requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
$requete->execute();
$operations = $requete->fetchAll(PDO::FETCH_OBJ);
foreach ($operations as $op) {
    $lignes = $op->lignes;
}
if ($lignes == 0) {
    $num_com = 1;
} else {
    $requete = $bdd->prepare("SELECT num_com FROM  t_reservation WHERE type='commande' AND id_hotel=:id_hotel ORDER BY id_res DESC LIMIT 1");
    $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
    $requete->execute();
    $commandes = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($commandes as $c) {
        $num_com = $c->num_com;
    }
}
// Fin Numérotation de la commande