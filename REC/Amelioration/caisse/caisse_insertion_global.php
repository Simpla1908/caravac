<?php

// Initialisation de la session
if (!isset($_SESSION)) {
    session_start();
}
// Récuperer le nom du client
$requete = $bdd->prepare("SELECT nom_client FROM t_client WHERE  id_client=:id_client");
$requete->BindParam(':id_client', $_SESSION['id_client']);
$requete->execute();
$operations = $requete->fetchAll(PDO::FETCH_OBJ);
foreach ($operations as $op) {
    $nom_client = $op->nom_client;
}

//Recuperation de l'indice entree & sortie
$requete = $bdd->prepare("SELECT COUNT(*) AS lignes FROM t_operation WHERE  hotel_id=:hotel_id");
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->execute();
$operations = $requete->fetchAll(PDO::FETCH_OBJ);
foreach ($operations as $op) {
    $lignes = $op->lignes;
}
if ($lignes == 0) {
    $indice_be = 1;
    $indice_bs = 1;
} else {
    $requete = $bdd->prepare("SELECT indice_be,indice_bs FROM t_operation WHERE  hotel_id=:hotel_id ORDER BY idoperation DESC LIMIT 1");

    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);

    $requete->execute();

    $operations = $requete->fetchAll(PDO::FETCH_OBJ);

    foreach ($operations as $op) {
        $indice_be = $op->indice_be;
        $indice_bs = $op->indice_bs;
    }
}
// Fin Recuperation de l'indice entree & sortie
// Insertion t_operation (caisse)
$requete = $bdd->prepare("INSERT INTO t_operation (libelle,beneficiaire,date_bon,date_heure_bon,montantFC,
                                                           montantUSD,numBordereau,mode_operation,session_id,motif_id,hotel_id)
			                 VALUES(:libelle,:beneficiaire,:date_bon,:date_heure_bon,:montantFC
                                                ,:montantUSD,:numBordereau,:mode_operation,:session_id,
                                             :motif_id,:hotel_id)");
$session_id = 1;
$date_bon = date('Y-m-d');
$date_res = date('Y-m-d H:i:s', time() + 3600);
$numBordereau = ' ';
$entree='entree';
$sortie='sortie';
$type_caisse='normal';
$requete->BindParam(':libelle', $libelle);
$requete->BindParam(':beneficiaire', $nom_client);
$requete->BindParam(':date_bon', $date_bon);
$requete->BindParam(':date_heure_bon', $date_res);
$requete->BindParam(':montantFC', $montantFC);
$requete->BindParam(':montantUSD', $montantUSD);
$requete->BindParam(':numBordereau', $numBordereau);
$requete->BindParam(':mode_operation', $type_caisse);
$requete->BindParam(':session_id', $session_id);
$requete->BindParam(':motif_id', $motif_id);
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->execute();

$id_operation = $bdd->lastInsertId();

if ($operation_caisse == 'entree') {
    $id_operation = $bdd->lastInsertId();
    $numBon = 'BE/' . str_pad($indice_be, 4, "0", STR_PAD_LEFT); //001;
    $indice_be = $indice_be + 1;
    $requete = $bdd->prepare("UPDATE t_operation  SET numBon =:numBon,type =:type,indice_be =:indice_be,indice_bs =:indice_bs WHERE idoperation=:idoperation");
    $requete->BindParam(':numBon', $numBon);
    $requete->BindParam(':type', $entree);
    $requete->BindParam(':indice_be', $indice_be);
    $requete->BindParam(':indice_bs', $indice_bs);
    $requete->BindParam(':idoperation', $id_operation);
    $requete->execute();
} else {
    $numBon = 'BS/' . str_pad($indice_bs, 4, "0", STR_PAD_LEFT); //001;
    $indice_bs = $indice_bs + 1;
    $requete = $bdd->prepare("UPDATE t_operation  SET numBon =:numBon,type =:type,indice_bs =:indice_bs,indice_be =:indice_be WHERE idoperation=:idoperation");
    $requete->BindParam(':numBon', $numBon);
    $requete->BindParam(':type', $sortie);
    $requete->BindParam(':indice_bs', $indice_bs);
    $requete->BindParam(':indice_be', $indice_be);
    $requete->BindParam(':idoperation', $id_operation);
    $requete->execute();
}

