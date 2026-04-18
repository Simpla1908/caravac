<?php

function verif_code_prod($code) {
    include('../bdd/connexion.php');
    $requete = $bdd->prepare("SELECT code FROM stk_produit WHERE hotel_id=:hotel_id");
    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->execute();
    $codes = $requete->fetchAll(PDO::FETCH_OBJ);
    $existe = 0;
      foreach ($codes  as $c):

        if ($code ==$c->code) {
            $existe = 1;
            break;
        }
   endforeach;
    return $existe;
}
