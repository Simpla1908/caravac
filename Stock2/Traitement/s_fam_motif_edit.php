<?php

//session_start();
function gets_fam_motif($id_s_fam, $bdd) {
    $requete = $bdd->prepare("SELECT s_fam.id_s_fam,s_fam.des,fam.idfamille,fam.designation FROM stk_sous_famille AS s_fam,stk_famille AS fam WHERE s_fam.id_s_fam=:famille_id AND s_fam.famille=fam.idfamille AND s_fam.hotel_id=:hotel_id ORDER BY s_fam.id_s_fam DESC");
    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->BindParam(':famille_id',$id_s_fam);
    $requete->execute();
    $fam_motifs = $requete->fetchAll(PDO::FETCH_OBJ);
    return $fam_motifs;
}
