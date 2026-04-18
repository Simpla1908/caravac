<?php

function verif_libelle_depot($des_ex,$des) {
    include('../bdd/connexion.php');
    $requete = $bdd->prepare("SELECT libelle FROM  t_depot WHERE hotel_id=:hotel_id AND libelle<>:des_ex");
    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->BindParam(':des_ex',$des_ex);
    $requete->execute();
    $dess = $requete->fetchAll(PDO::FETCH_OBJ);
    $existe = 0;
      foreach ($dess  as $d):
        if ($des ==$d->des) {
            $existe = 1;
            break;
        }
   endforeach;
    return $existe;
}