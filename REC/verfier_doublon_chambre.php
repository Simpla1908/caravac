<?php
function pas_doublon($num_ch) {
 include('./Amelioration/bdd/connexion .php');
    $requete = $bdd->prepare("SELECT num_ch FROM t_chambre WHERE id_hotel=:id_hotel");
    $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
    $requete->execute();
    $num_ch_motif= $requete->fetchAll(PDO::FETCH_OBJ);
    $existe = 0;
      foreach ($num_ch_motif  as $n):
        if ($num_ch ==$n->num_ch) {
            $existe = 1;
            break;
        }
   endforeach;
    return $existe;
}
