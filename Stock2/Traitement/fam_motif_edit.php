<?php
//session_start();
function getfam_motif($idfamille, $bdd)
{
    $requete = $bdd->prepare("SELECT fam.idfamille,fam.designation,fam.familletype_id FROM stk_famille AS fam,stk_familletype AS famtyp WHERE fam.familletype_id=famtyp.id AND fam.idfamille=:famille_id AND fam.hotel_id=:hotel_id ORDER BY fam.idfamille DESC");
    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->BindParam(':famille_id', $idfamille);
    $requete->execute();
    $fam_motifs = $requete->fetchAll(PDO::FETCH_OBJ);
    return $fam_motifs;
}
