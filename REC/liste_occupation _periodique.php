<?php
// Inclusion du fichier contenant la connexion à la base
require '../bdd/connexion.php';
include('Gerant_local.php');
?>
<?php include('headerRec_popup.php'); ?>
<?php
include('menu_Rec.php');

/* calcul du nombre du jour */

function NbJours($dte_a, $dte_now) {

    $tDeb = explode("-", $dte_a);
    $tFin = explode("-", $dte_now);
    $diff = mktime(0, 0, 0, $tFin[1], $tFin[2], $tFin[0]) -
            mktime(0, 0, 0, $tDeb[1], $tDeb[2], $tDeb[0]);
    return(($diff / 86400) + 1);
}

/* Fin calcul du nombre du jour */
?>

<div id="page-wrapper" style="height:800px;">
    <div class="col-lg-12">
        <h3 class="page-header">Occupation</h3>
        <div class="panel panel-default">
            <!--Menu tabulation-->
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li class="dropdown"> <a  href="liste_occupation.php"> Occupation en cours <b class="caret"></b></a></li>
                <li class="dropdown active"> <a class="dropdown-toggle" data-toggle="dropdown" href="#">Occupation  périodique <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li style="padding:10px;">
                            <form action="liste_occupation _periodique.php" method="post" name="periode">
                                <fieldset>
                                    <div style="border:1px solid #dddddd; padding:10px;">
                                        <table width="300" border="0">
                                            <tr>
                                                <td width="120"> <label for="date">Date de debut&nbsp;:</label></td>
                                                <td width="5"></td>
                                                <td><input id="datetimepickerOcc"  type="date" class="form-control"  name="date_d" required >
                                                </td>
                                            </tr>
                                            <tr>
                                            <tr height="15">
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td> <label for="date">Date de fin&nbsp;:</label></td>
                                                <td width="5"></td>
                                                <td>
                                                    <input id="datetimepickerLib"  type="date" class="form-control"  name="date_f" required >
                                                </td>
                                            </tr>
                                            <tr height="15">
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td width="5"></td>
                                                <td align="left"> <button  name="sauvegarder" type="submit" class="btn btn-primary">Valider</button></td>
                                            </tr>
                                        </table>
                                    </div>
                                </fieldset>
                            </form>
                        </li>
                    </ul>
                </li>
                <li class="dropdown"> <a  href="liste_occupation_historique.php">Occupation  historique <b class="caret"></b></a></li>
            </ul>
            <!--/Menu tabulation-->

            <?php
            if (isset($_POST['sauvegarder'])) {
                $date_d = $_POST['date_d'];
                $date_f = $_POST['date_f'];
                $_SESSION['date_d'] = $date_d;
                $_SESSION['date_f'] = $date_f;

                $date_d1 = explode(' ', $date_d);
                $date_d_expl1 = explode('/', $date_d1[0]);

                $date_d_expl = $date_d_expl1[2] . '-' . $date_d_expl1[1] . '-' . $date_d_expl1[0];

                $date_f1 = explode(' ', $date_f);
                $date_f_expl1 = explode('/', $date_f1[0]);

                $date_f_expl = $date_f_expl1[2] . '-' . $date_f_expl1[1] . '-' . $date_f_expl1[0];
            }
            ?>

            <div class="panel-heading">
                <h4>
                    Liste des occupations du <?php echo $date_d1[0] . ' ' . 'au' . ' ' . $date_f1[0]; ?>
                    <?php if (in_array('ILO', $_SESSION['actions']['code_actions'])) { ?>
                    <a class="btn btn-primary btn-sm pull-right"  href="impression/imprime_liste_occupation_periodique.php?date_d=<?php echo $date_d; ?>&date_f=<?php echo $date_f; ?>" target="_blank"><i class="fa fa-print"></i> Imprimer</a>
                    <?php } ?>
                </h4>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <form method="post" action="gl_del_multi_chambre.php">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-condensed" id="dataTables-example">
                        <thead>
                            <tr>
                            <tr>
                                <th>N°</th>
                                <th>Client</th>
                                <th>Chambre </th>
                                <th>Date d'entrée </th> 
                                <th>Date prévue de sortie </th> 
                                <!--<th>Nbr jours</th>-->
                                <th>Type</th>
                                <th>Action</th>
                            </tr>
                            </tr>
                        </thead>
                        <tbody id="body_data_chg_ch">
                            <?php
                            $i = 1;


                            /* Recuperation du paiement d'un client */
                            $requete_reserv = $bdd->prepare("SELECT c.id,a.id_client,a.nom_client,b.id_res,b.num_reserv,b.type,d.id_ch,d.num_ch,b.dte_a,b.dte_s,b.statut_occ,b.statut_sorti,d.tarif_ch
                                                            FROM t_client AS a, t_reservation AS b, t_reserve_chambre AS c, t_chambre AS d
                                                            WHERE a.id_client=c.id_client
                                                            AND b.id_res=c.idreserv
                                                            AND c.idchambre= d.id_ch
                                                            AND b.id_hotel=:id_hotel
                                                            AND c.statut='occupe' ORDER BY a.nom_client");
                            $requete_reserv->BindParam(':id_hotel', $_SESSION['id_hotel']);
                            $requete_reserv->execute();
                            while ($donnees = $requete_reserv->fetch()) {
                                $id = $donnees['id'];
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
                                $tarif_ch = $donnees['tarif_ch'];
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
                                    if (($dte_a >= $date_d_expl) && ($dte_a <= $date_f_expl)) {
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
                                        <!--<td><?php // echo $nbre_jr; ?></td>-->
                                        <td>
                                            <?php
                                            if ($type == 'reservation') {
                                                echo '<span class="label label-info">Indirecte</span>';
                                            } else {
                                                echo '<span class="label label-warning">Directe</span>';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php if (in_array('CC',$_SESSION['actions']['code_actions'])){?>
                                                <a href="#" class="btn btn-primary btn-xs change_ch"
                                                   id='<?php echo $id; ?>' id1='<?php echo $id_client; ?>' id2='<?php echo $id_ch; ?>' id='<?php echo $id_ch; ?>'
                                                   id3='<?php echo $id_res; ?>' id4='<?php echo $tarif_ch; ?>'><i class="fa fa-bed"></i> Changer de chambre
                                                </a>
                                            <?php }?>
                                        </td>
                                    </tr>


                                        <?php
                                        $i++;
                                    }
                                    /* Fin de la Recuperation du paiement d'un client */
                                    ?>

                                    <?php
                                }
                                ?>
                            </tbody>
                        </table> 
                    </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"
                                    aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-bars"></i> Changement chambre
                            </h4>
                        </div>
                        <div class="modal-body" id="modal-body_data">
                            <?php
                            $requete_chambre = $bdd->prepare("SELECT * FROM t_chambre AS ch, categorie_chambre AS cat, niveau_chambre AS niv
                                WHERE ch.categorie=cat.id_cat_cha AND ch.niveau=niv.id_niv_cha AND id_ch NOT IN (SELECT c.id_ch
                                FROM t_reservation AS a, t_reserve_chambre AS b, t_chambre AS c
                                WHERE b.idreserv = a.id_res
                                AND b.idchambre = c.id_ch
                                AND b.statut !='libre'
                                AND c.id_hotel=:id_hotel) AND ch.id_hotel=:id_hotel");
                            $requete_chambre->BindParam(':id_hotel', $_SESSION['id_hotel']);
                            $requete_chambre->execute();
                            $chambres = $requete_chambre->fetchAll(PDO::FETCH_OBJ);
                            ?>
                            <div class="table-responsive" style="overflow:auto;height:300px;">
                                <table class="table table-striped table-bordered table-condensed"
                                       id="dataTables-example1">
                                    <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Chambre</th>
                                        <th>Tarif</th>
                                        <th>Categorie</th>
                                        <th>Niveau</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 1;
                                    foreach ($chambres as $ch): ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $ch->num_ch ?></td>
                                            <td><?php echo $ch->tarif_ch ?></td>
                                            <td><?php echo $ch->lib_cat_cha ?></td>
                                            <td><?php echo $ch->lib_niv_cha ?></td>
                                            <td>
                                                <input type="hidden" name="id_trc" class="form-control"
                                                       id="id_trc">
                                                <input type="hidden" name="client_id" class="form-control"
                                                       id="client_id">
                                                <input type="hidden" name="ch_id" class="form-control" id="ch_id">
                                                <input type="hidden" name="res_id" class="form-control" id="res_id">
                                                <a href="#" class="btn btn-danger btn-xs selection_ch"
                                                   id1='<?php echo $ch->id_ch ?>'><i class="fa fa-check"></i>
                                                    Selectionner </a></td>
                                        </tr>
                                        <?php $i++;endforeach; ?>
                                    </tbody>
                                </table>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>  <!-- /.row -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<script src="../datepicker/jquery.js"></script>
<script src="../datepicker/jquery.datetimepicker.js"></script>
<script>
    $('#datetimepicker6').datetimepicker();
    $('#datetimepickerOcc').datetimepicker();
    $('#datetimepickerLib').datetimepicker();
</script>
<!-- jQuery -->
<script src="../js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../js/plugins/metisMenu/metisMenu.min.js"></script>

<!-- DataTables JavaScript -->
<script src="../js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="../js/plugins/dataTables/dataTables.bootstrap.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../js/sb-admin-2.js"></script>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script type="text/javascript">
    $("#dataTables-example").on('click', '#body_data_chg_ch tr .change_ch', function (e) {
//$(".change_ch").click(function (e) {
        e.preventDefault();
        var id_trc = $(this).attr('id');
        var id_client = $(this).attr('id1');
        var id_ch = $(this).attr('id2');
        var id_res = $(this).attr('id3');
        var tarif_ch = $(this).attr('id4');
        //alert(id_trc);
        $.ajax({
            url: 'Traitement/data_select_chamb.php?tarif_ch='+tarif_ch,
            type: 'POST',
            success: function (data) {
                $('#modal-body_data').empty().append(data);
                $('#id_trc').val(id_trc);
                $('#client_id').val(id_client);
                $('#ch_id').val(id_ch);
                $('#res_id').val(id_res);
            }
        });
        $("#myModal").modal('show');

    });
    $("#modal-body_data").on('click', '#dataTables-example1 tr .selection_ch', function (e) {
        e.preventDefault();
        var id_ch_ezali = $(this).attr('id1');
        var id_trc = $('#id_trc').val();
        var id_client = $('#client_id').val();
        var id_ch_eye = $('#ch_id').val();
        var id_res_eye = $('#res_id').val();
        var donnees = " ";
        //     alert(id_trc);
//        alert(id_client);
//        alert(id_ch_eye);
        $.ajax({
            url: 'Traitement/changement_chambre_encours.php?id_ch_ezali=' + id_ch_ezali + "&id_client=" + id_client + "&id_ch_eye=" + id_ch_eye + "&id_res_eye=" + id_res_eye+ "&id_trc=" + id_trc,
            type: 'POST',
            data: donnees,
            success: function (data) {
                // alert(data);
                $('#body_data_chg_ch').empty().append(data);
            }
        });
        /*   $.ajax({
         url: 'Traitement/data_select_chamb.php',
         type: 'POST',
         data: donnees,
         success: function (data) {
         $('#modal-body_data').empty().append(data);
         //alert(data);

         }
         });*/
        $('#myModal').modal('hide');
        return false;
    });

</script>
<script>
    $(document).ready(function () {
        $('#dataTables-example').dataTable();
    });
</script>


</body>

</html>