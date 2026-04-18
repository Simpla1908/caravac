<?php

// Initialisation de la session
if (!isset($_SESSION)) {
    session_start();
}

$id_hotel = $_SESSION['id_hotel'];
$entree = 'entree';
$sortie = 'sortie';
//Entree de l'hotel
$requete = $bdd->prepare("SELECT SUM(montantFC) AS montantFC_entree_jr ,SUM(montantUSD) AS montantUSD_entree_jr"
        . " FROM t_operation AS op  WHERE op.type=:type AND op.hotel_id=:hotel_id  AND op.libelle='Heberge'");
$requete->BindParam(':type', $entree);
$requete->BindParam(':hotel_id', $id_hotel);
$requete->execute();
$operations = $requete->fetchAll(PDO::FETCH_OBJ);

foreach ($operations as $op) {
    $montantFC_entree_jr = $op->montantFC_entree_jr;
    $montantUSD_entree_jr = $op->montantUSD_entree_jr;
}
//  Sortie de l'hotel
$requete = $bdd->prepare("SELECT SUM(montantFC) AS montantFC_sortie_jr ,SUM(montantUSD) AS montantUSD_sortie_jr"
        . " FROM t_operation AS op  WHERE op.type=:type AND op.hotel_id=:hotel_id  AND op.libelle='Heberge'");
$requete->BindParam(':type', $sortie);
$requete->BindParam(':hotel_id', $id_hotel);
$requete->execute();
$operations = $requete->fetchAll(PDO::FETCH_OBJ);

foreach ($operations as $op) {
    $montantFC_sortie_jr = $op->montantFC_sortie_jr;
    $montantUSD_sortie_jr = $op->montantUSD_sortie_jr;
}

$caisse_montantUSD_entree = $montantUSD_entree_jr;
$caisse_montantFC_entree = $montantFC_entree_jr;
$caisse_montantUSD_sortie = $montantUSD_sortie_jr;
$caisse_montantFC_sortie = $montantFC_sortie_jr;
$caisse_montantUSD_solde = $caisse_montantUSD_entree - $caisse_montantUSD_sortie;
$caisse_montantFC_solde = $caisse_montantFC_entree - $caisse_montantFC_sortie;
?>
