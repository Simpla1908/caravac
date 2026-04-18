<?php
$nom_c = '';
$id_c=0;
if (!empty($_GET['id']) && $_GET['id'] >= 0) {
    $id = (int) $_GET['id'];
    $requete = $bdd->prepare($req_fac_global_parsite);
    $requete->BindParam(':id_hotel', $id);
    $requete->execute();
    $resultats = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($resultats as $o) {
        $id_c = $o->id_hotel;
        $nom_c = $o->nom_hotel;
    }
} 

