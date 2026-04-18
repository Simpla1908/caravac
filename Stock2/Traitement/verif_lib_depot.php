<?php

function verif_des_fam($lib) {
    include('../bdd/connexion.php');
    $requete = $bdd->prepare("SELECT libelle FROM  t_depot WHERE hotel_id=:hotel_id");
    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->execute();
    $dess = $requete->fetchAll(PDO::FETCH_OBJ);
    $existe = 0;
      foreach ($dess  as $d):
        if ($lib ==$d->libelle) {
            $existe = 1;
            break;
        }
   endforeach;
    return $existe;
}
