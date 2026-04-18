<?php

function verif_des_fam($des) {
    include('../bdd/connexion.php');
    $requete = $bdd->prepare("SELECT designation FROM  stk_famille WHERE hotel_id=:hotel_id");
    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->execute();
    $dess = $requete->fetchAll(PDO::FETCH_OBJ);
    $existe = 0;
      foreach ($dess  as $d):
        if ($des ==$d->designation) {
            $existe = 1;
            break;
        }
   endforeach;
    return $existe;
}
