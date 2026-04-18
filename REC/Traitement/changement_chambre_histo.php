<?php
// Initialisation de la session
session_start();
require '../../bdd/connexion.php';
function NbJours($dte_a, $dte_now) {

    $tDeb = explode("-", $dte_a);
    $tFin = explode("-", $dte_now);
    $diff = mktime(0, 0, 0, $tFin[1], $tFin[2], $tFin[0]) -
            mktime(0, 0, 0, $tDeb[1], $tDeb[2], $tDeb[0]);
    return(($diff / 86400) + 1);
}
if (isset($_GET['id_ch_ezali']) && isset($_GET['id_client']) && isset($_GET['id_ch_eye'])) {
    $id_ch_ezali = $_GET['id_ch_ezali'];
    $id_client = $_GET['id_client'];
    $id_ch_eye = $_GET['id_ch_eye'];
    $id_res_eye = $_GET['id_res_eye'];
//            echo $id_ch_ezali.'<br>'.$id_client.'<br>'.$id_ch_eye.'<br>'.$id_res_eye;
    //maj dans table t_reserve_chambre
    $requete = $bdd->prepare("UPDATE t_reserve_chambre SET idchambre =:idchambree WHERE id_client=:id_client AND idreserv=:id_res AND idchambre=:idchambre AND statut='occupe'");
    $requete->BindParam(':idchambree', $id_ch_ezali);
    $requete->BindParam(':id_client', $id_client);
    $requete->BindParam(':id_res', $id_res_eye);
    $requete->BindParam(':idchambre', $id_ch_eye);
    $requete->execute();
   //maj dans capacite chambre
    $requete = $bdd->prepare("UPDATE t_chambre  SET occupe='non',libre='oui',capacite=capacite_init WHERE id_ch=:idchambre");
    $requete->BindParam(':idchambre', $id_ch_eye);
    $requete->execute();
     //maj dans capacite chambre
    $requete = $bdd->prepare("UPDATE t_chambre  SET occupe='oui',libre='non' WHERE id_ch=:idchambre");
    $requete->BindParam(':idchambre', $id_ch_ezali);
    $requete->execute();

$i = 1;


/* Recuperation du paiement d'un client */
$requete_reserv = $bdd->prepare("SELECT a.id_client,a.nom_client,b.id_res,b.num_reserv,b.type,d.id_ch,d.num_ch,b.dte_a,b.dte_s,b.statut_occ,b.statut_sorti
                                                            FROM t_client AS a, t_reservation AS b, t_reserve_chambre AS c, t_chambre AS d
                                                            WHERE a.id_client=c.id_client
                                                            AND b.id_res=c.idreserv
                                                            AND c.idchambre= d.id_ch 
                                                            AND b.id_hotel=:id_hotel
                                                            AND c.statut='occupe' ORDER BY a.id_client");
$requete_reserv->BindParam(':id_hotel', $_SESSION['id_hotel']);
$requete_reserv->execute();
while ($donnees = $requete_reserv->fetch()) {


    $id_res = $donnees['id_res'];
    $id_client = $donnees['id_client'];
    $num_reserv = $donnees['num_reserv'];
    $nom_client = $donnees['nom_client'];
    $type = $donnees['type'];
    $id_ch = $donnees['id_ch'];
    $num_ch = $donnees['num_ch'];
    $dte_a = $donnees['dte_a'];
    $dte_s = $donnees['dte_s'];
    $statut_occ = $donnees['statut_occ'];
    $statut_sorti = $donnees['statut_sorti'];
    $dte_now = date('Y-m-d');

    $date_occ1 = explode('-', $dte_a);
    $date_occ_expl = $date_occ1[2] . '/' . $date_occ1[1] . '/' . $date_occ1[0];

    $date_lib1 = explode('-', $dte_s);
    $date_lib_expl = $date_lib1[2] . '/' . $date_lib1[1] . '/' . $date_lib1[0];
    /* Nombre de jour */
    $Nombres_jours = NbJours($dte_a, $dte_now);
    $nb_jrs = $Nombres_jours;
    $nb_jr = $nb_jrs - 1;
    if ($nb_jr == 0) {
        $nb_jr++;
    }
    $nbre_jr = $nb_jr;
    /* Fin Nombre de jour */
    ?>

    <?php
    if ($dte_a <= date('Y-m-d')) {

        $_SESSION['date_d'] = date('Y-m-d');
        $_SESSION['date_f'] = date('Y-m-d');
        ?>
        <?php
        /* Ouverture IF statut_occ */
        //if($statut_occ=='loge'){
        ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td align='left'><?php echo $nom_client; ?></td>
            <td><?php echo 'Ch' . $num_ch; ?></td>
            <td><?php echo $date_occ_expl; ?></td>
            <td><?php echo $date_lib_expl; ?></td>
            <td>
                <?php
                if ($type == 'reservation') {
                    echo '<span class="label label-info">Indirecte</span>';
                } else {
                    echo '<span class="label label-warning">Directe</span>';
                }
                ?>
            </td>
            <td><a href="#" class="btn btn-primary btn-xs change_ch" id1='<?php echo $id_client; ?>' id2='<?php echo $id_ch; ?>' id3='<?php echo $id_res; ?>'><i class="fa fa-bed"></i> Changer de chambre </a></td>
        </tr>
        <?php
        $i++;
    }
    /* Fin de la Recuperation du paiement d'un client */
    ?>

    <?php
}
}
?>
