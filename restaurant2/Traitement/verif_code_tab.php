<?php


function verif_code_tab($code) {
    include('../bdd/connexion.php');
    $requete = $bdd->prepare("SELECT code FROM t_client WHERE id_hotel=:hotel_id AND type='table' AND pseudo_supp=0");
    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->execute();
    $codes = $requete->fetchAll(PDO::FETCH_OBJ);
    $existe = 0;
    foreach ($codes  as $c):
        if ($code == $c->code) {
            $existe = 1;
            break;
        }
    endforeach;
//    echo $existe;
    return $existe;
}
