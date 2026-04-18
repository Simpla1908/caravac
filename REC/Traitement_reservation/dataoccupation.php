<?php
session_start();
include("../../bdd/connexion.php");
 ?>
<thead>
    <tr>
        <th>N°</th>
        <th>Reservation N°</th>
         <th>Num. Chambre</th>
        <th>Client(s)</th>
        <th>Date prévue d'entrée</th>     
        <th>Date prévue de sortie</th> 
        <th align="center">Actions</th>
    </tr>
</thead>
<tbody>
    <?php
    $i=1;
    /* Recuperation du paiement d'un client */
    $requete_reserv = $bdd->prepare("SELECT rc.idchambre,ch.num_ch,cl.id_client, rc.idreserv, cl.nom_client, re.num_reserv, re.type, re.date_res,re.date_occ,re.date_lib, re.dte_a, re.dte_s, rc.statut, rc.occupe 
                                    FROM t_client AS cl,t_chambre AS ch, t_reservation AS re, t_reserve_chambre AS rc 
                                    WHERE rc.idchambre=ch.id_ch
                                    AND cl.id_client=rc.id_client
                                    AND rc.idreserv=re.id_res 
                                    AND cl.id_hotel=:id_hotel 
                                    AND curdate()>=re.dte_a 
                                    AND curdate()<=re.dte_s 
                                    AND rc.statut='reserve'
                                    ORDER BY re.num_reserv DESC");
    $requete_reserv->BindParam(':id_hotel', $_SESSION['id_hotel']);
    $requete_reserv->execute();
    while ($donnees = $requete_reserv->fetch()) {
        $idchambre = $donnees['idchambre'];
        $num_ch = $donnees['num_ch'];
        $id_client = $donnees['id_client'];
        $nom_client = $donnees['nom_client'];
        $id_res = $donnees['idreserv'];
        $num_reserv = $donnees['num_reserv'];
        $date_res = $donnees['date_res'];
        $date_occ = $donnees['date_occ'];
        $date_lib = $donnees['date_lib'];
        $dte_a = $donnees['dte_a'];
        $dte_s = $donnees['dte_s'];

        $date_res1 = explode(' ', $date_res);
        $date_res_expl = $date_res1[0];

        $date_occ1 = explode('-', $date_occ);
        $date_occ1_Heure = explode(' ', $date_occ1[2]);

        $date_occ_expl = $date_occ1_Heure[0] . '/' . $date_occ1[1] . '/' . $date_occ1[0] . ' ' . $date_occ1_Heure[1];

        $date_lib1 = explode('-', $date_lib);
        $date_lib1_Heure = explode(' ', $date_lib1[2]);

        $date_lib_expl = $date_lib1_Heure[0] . '/' . $date_lib1[1] . '/' . $date_lib1[0] . ' ' . $date_lib1_Heure[1];

        $date_res1 = explode('-', $date_res);
        $date_res1_Heure = explode(' ', $date_res1[2]);

        $date_res_explode = $date_res1_Heure[0] . '/' . $date_res1[1] . '/' . $date_res1[0] . ' ' . $date_res1_Heure[1];
        ?>
            <?php
            //Récuperation seulement du date occ 
            $date_occ_test1 = explode(' ', $date_occ);
            $date_occ_test = $date_occ_test1[0];
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><a href="rec_detail_reservation_client.php?num_reserv=<?php echo $num_reserv; ?>" title="Voir le detail sur cette réservation"><?php echo $num_reserv; ?></a></td>
                <td><?php echo $num_ch; ?></td>
                <td><?php echo $nom_client; ?></td>
                <td><?php echo $date_occ_expl; ?></td>
                <td><?php echo $date_lib_expl; ?></td>
                <td>
                    <a id="btn_occup" data-chambre="<?php echo $idchambre; ?>" data-client="<?php echo $id_client; ?>" data-res="<?php echo $id_res;?>" data-toggle="modal" data-target=".myModal" href="#" title="Afficher le detail" class="btn btn-info btn-xs"><i class="fa fa-sign-in"></i> Occuper </a>
<!--                                             <a href="rec_ajout_occupation.php?idchambre=<?php echo $idchambre; ?>&num_reserv=<?php echo $num_reserv; ?>&id_client=<?php echo $id_client; ?>&nom_client=<?php echo $nom_client; ?>&id_res=<?php echo $id_res; ?>&date_res=<?php echo $date_res; ?>&date_occ=<?php echo $date_occ_expl; ?>&date_lib=<?php echo $date_lib_expl; ?>&dte_a=<?php echo $dte_a; ?>&dte_s=<?php echo $dte_s; ?>" title="Occuper" class="btn btn-warning btn-xs"><i class="fa fa-sign-in"></i> Occuperrr </a>
-->                                        </td>
            </tr>
    <?php
    $i++;
    }
    ?>
</tbody>