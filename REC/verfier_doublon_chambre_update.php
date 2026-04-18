<?php
function pas_doublon($num_ch_A,$num_ch_N) {
    $existe = 0;
    if($num_ch_A==$num_ch_N){
        return $existe;
    }else{
        include('./Amelioration/bdd/connexion .php');
        $requete = $bdd->prepare("SELECT num_ch FROM t_chambre WHERE id_hotel=:id_hotel");
        // $requete->BindParam(':num_ch_A',$num_ch_A);
        $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
        $requete->execute();
        $num_ch_motif= $requete->fetchAll(PDO::FETCH_OBJ);

        foreach ($num_ch_motif  as $n):
        if ($num_ch_N ==$n->num_ch) {
            $existe = 1;
            break;
        }
        endforeach;
        return $existe;

    }

}
