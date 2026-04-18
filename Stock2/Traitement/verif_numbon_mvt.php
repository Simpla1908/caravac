<?php

function verif_numbon_mvt($numbon) {
    include('../bdd/connexion.php');
    $requete = $bdd->prepare("SELECT num_bon FROM  stk__mouvement WHERE hotel_id=:hotel_id");
    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->execute();
    $num_bons= $requete->fetchAll(PDO::FETCH_OBJ);
    $existe = 0;
      foreach ($num_bons as $nb):

        if ($numbon==$nb->num_bon) {
            $existe = 1;
            break;
        }
   endforeach;
    return $existe;
}
