<?php

function verif_des_cuisson($des,$bdd) {
    $requete = $bdd->prepare("SELECT nom FROM  detailsplats WHERE hotel_id=:hotel_id");
    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->execute();
    $dess = $requete->fetchAll(PDO::FETCH_OBJ);
    $existe = 0;
      foreach ($dess  as $d):
        if ($des ==$d->nom) {
            $existe = 1;
            break;
        }
   endforeach;
    return $existe;
}
