<?php
function pas_doublon_cat($lib) {
    include('./Amelioration/bdd/connexion .php');
    $requete = $bdd->prepare("SELECT lib_cat_cha FROM categorie_chambre WHERE hotel_id=:id_hotel");
    $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
    $requete->execute();
    $lib_motif= $requete->fetchAll(PDO::FETCH_OBJ);
    $existe = 0;
    foreach ($lib_motif  as $l):
    if ($lib ==$l->lib_cat_cha) {
        $existe = 1;
        break;
    }
    endforeach;
    return $existe;
}

function pas_doublon_cat2($lib_a,$lib_n) {
    $existe = 0;
    if($lib_a==$lib_n){
        return $existe;
    }else{
        include('./Amelioration/bdd/connexion .php');
        $requete = $bdd->prepare("SELECT lib_cat_cha FROM categorie_chambre WHERE hotel_id=:id_hotel");
        // $requete->BindParam(':num_ch_A',$num_ch_A);
        $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
        $requete->execute();
        $lib_motif= $requete->fetchAll(PDO::FETCH_OBJ);

        foreach ($lib_motif  as $l):
        if ($lib_n ==$l->lib_cat_cha) {
            $existe = 1;
            break;
        }
        endforeach;
        return $existe;

    }

}
