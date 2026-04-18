<?php
function StatutVersement($user_vers, $date_vers,$id_hotel, $bdd)
{
    $statut = 'Non versé';
    $nb = 0;
    $sql = "SELECT COUNT(*) AS nb_lg
                FROM t_versement
                WHERE id_hotel=:hotel_id
                AND date_vers=:date_vers
                AND user_vers=:user_vers
                AND type_vers='reservation'";
    $requete = $bdd->prepare($sql);
    $requete->BindParam(':hotel_id', $id_hotel);
    $requete->BindParam(':date_vers', $date_vers);
    $requete->BindParam(':user_vers', $user_vers);
    $requete->execute();
    $operations = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($operations as $op):
        $nb = $op->nb_lg;
    endforeach;
    if ($nb > 0) {
        $statut = 'Versé';
    }
    return $statut;
}
