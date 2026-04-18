<?php
if (!isset($_SESSION)) {
    session_start();
}
require '../bdd/connexion.php';
require '../FUNCTION/hebergement.php';
    
    $requete = $bdd->prepare
        ("
        SELECT c.id,a.id_res,a.num_reserv,c.idchambre,d.num_ch,b.id_client,e.nom_client,c.date_occ,c.date_lib,f.entreprise AS nom_respo
        FROM t_reservation AS a, t_facture AS b, t_reserve_chambre AS c,t_chambre AS d,t_client AS e,t_responsable AS f
        WHERE a.id_res=b.id_res AND b.id_fact=c.idfact AND b.id_client=e.id_client AND e.id_respo=f.id_respo
              AND c.idchambre=d.id_ch AND c.statut='reserve' AND a.id_hotel=:id_hotel ORDER BY c.date_occ
       ");
    $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
    $requete->execute();


$result = $requete->fetchAll(PDO::FETCH_OBJ);
?>
<?php
$i = 1;
$today=date('Y-m-d');
foreach ($result as $r) {
    $id= $r->id;
    $id_client = $r->id_client;
    $idchambre = $r->idchambre;
    $id_res = $r->id_res;
    $date_occ=$r->date_occ;
    $date_lib=$r->date_lib;
    ?>
    <tr class="odd gradeX">
        <td><?php echo $i ?></td>
        <td><?php echo $r->num_reserv ?></td>
        <td><?php echo $r->num_ch ?></td>
        <td><?php echo $r->nom_client ?></td>
        <td><?php echo $r->nom_respo ?></td>
        <td><?php echo dateAffiche($date_occ) ?></td>
        <td><?php echo dateAffiche($date_lib) ?></td>
        <td>
            <?php if($today>=$date_occ && $today <= $date_lib){ ?>
                <a id="btn_occup" data-chambre="<?php echo $idchambre; ?>"
                   data-client="<?php echo $id_client; ?>" data-res="<?php echo $id_res; ?>" data-idresch="<?php echo $id; ?>"
                   data-toggle="modal" data-target=".myModal" href="#" title="Afficher le detail"
                   class="btn btn-info btn-xs"><i class="fa fa-sign-in"></i> Occuper
                </a>
           <?php } ?>
        </td>
    </tr>
    <?php
    $i++;
}
?>