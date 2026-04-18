<?php
// Inclusion du fichier contenant la connexion à la base
require './Amelioration/bdd/connexion .php';
include('Receptionniste.php');
include('headerRec.php');
include('menu_Rec.php');
?>
<div id="page-wrapper">
    <div class="col-lg-12">
        <h3 class="page-header">Situation clients</h3>
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-user"></i> Clients Partenaire
            </div>
            <div class="panel-body">

                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover table-condensed dataTables-example"
                           id="dataTables-example1">
                        <thead>
                        <tr>
                            <th>N°</th>
                            <th>Partenaire</th>
                            <th>Chambre(s)</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i = 1;
                        /* Recuperation du paiement d'un client */
                        $requete_part = $bdd->prepare("SELECT pa.id_respo,pa.entreprise,COUNT(rc.idchambre) AS nbrch 
                        FROM t_reserve_chambre AS rc,t_responsable pa,t_client As cl
                        WHERE rc.id_client=cl.id_client 
                        AND cl.id_respo=pa.id_respo  
                        AND cl.id_hotel=:id_hotel
                        AND pa.id_respo<>1
                        GROUP BY pa.id_respo");
                        /* Fin Recuperation */
                        $requete_part->BindParam(':id_hotel', $_SESSION['id_hotel']);
                        $requete_part->execute();
                        while ($donnees = $requete_part->fetch()) {
                            $id_respo = $donnees['id_respo'];
                            $entreprise = $donnees['entreprise'];
                            $nbrch = $donnees['nbrch'];
                            ?>
                            <tr class="gradeX">
                                <td><?php echo $i; ?></td>
                                <td><?php echo $entreprise; ?></td>
                                <td><?php echo $nbrch; ?></td>
                                <td class="center">
                                    <a href="rec_situation_clients_loges.php?cli=par&part=<?php echo $id_respo; ?>"
                                       title="Afficher le detail" class="btn btn-info btn-xs"><i class="fa fa-list"></i>
                                        Détails </a>
                                </td>
                            </tr>
                            <?php
                            $i++;
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!--/.panel-default-->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->


<!-- modals -->
<?php include('./modal_paiement_credit.php') ?>


<!-- jQuery -->
<script src="datepicker/jquery.js"></script>
<script src="datepicker/jquery.datetimepicker.js"></script>
<script>
    $('.date_d').datetimepicker();
    $('.date_f').datetimepicker();
</script>

<script src="../js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>
<!--<script src="../js/bootstrap-modal.js"></script>-->
<script src="../js/bootstrap-datepicker.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../js/plugins/metisMenu/metisMenu.min.js"></script>

<!-- DataTables JavaScript -->
<script src="../js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="../js/plugins/dataTables/dataTables.bootstrap.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../js/sb-admin-2.js"></script>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
    $(document).ready(function () {
//        alert('gghh');
        $(".div_caisse_histo").load('./Amelioration/caisse/caisse_global_histo.php');
        $(".div_caisse").load('./Amelioration/caisse/paiecash_clientoccasionnel_encours.php?id_hotel=0');
        $('.dataTables-example').dataTable();
        $("#btn_valider_encours").click(function (e) {
            e.preventDefault();
            var donnees = " ";
            var id_hotel = $('#id_hotel').val();
//                    alert(id_hotel);
            $.ajax({
                url: './Amelioration/caisse/caisse_global.php?id_hotel=' + id_hotel,
                type: 'POST',
                data: donnees,
                success: function (html) {
                    $(".div_caisse").empty().append(html);
//                              alert(html);

                }
            });
        });
        $("#btn_valider_perio").click(function (e) {
            e.preventDefault();
            var donnees = " ";
            var id_hotel = $('#id_hotel_p').val();
            var date_d = $('#date_d').val();
            var date_f = $('#date_f').val();
//                    alert(date_d+date_f);
            $.ajax({
                url: './Amelioration/caisse/caisse_global_perio.php?id_hotel=' + id_hotel + "&date_d=" + date_d + "&date_f=" + date_f,
                type: 'POST',
                data: donnees,
                success: function (html) {
                    $(".div_caisse_perio").empty().append(html);
//                              alert(html);

                }
            });
        });
        $("#btn_valider_histo").click(function (e) {
            e.preventDefault();
            var donnees = " ";
            var id_hotel = $('#id_hotel_h').val();
            $.ajax({
                url: './Amelioration/caisse/caisse_global_histo.php?id_hotel=' + id_hotel,
                type: 'POST',
                data: donnees,
                success: function (html) {
                    $(".div_caisse_histo").empty().append(html);
//                              alert(html);

                }
            });
        });


    });

</script>

