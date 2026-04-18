<?php
// Inclusion du fichier contenant la connexion à la base
require '../bdd/connexion.php';
include('Receptionniste.php');
?>
<?php include('head.php'); ?>
<?php include('menu_Rec.php'); ?>

<div id="page-wrapper" style="height:500px;">
    <div class="col-lg-12">
        <h3 class="page-header">Réclamations</h3>
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-list"></i> Liste de réclamations
            </div>
            <!-- /.panel-heading -->
            <!-- Div stratégique -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Chambre N°</th>
                                <th>Nombre de reclamations</th>
                                <th align="center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i=1;
                            /* Recuperation du paiement d'un client */
                            $requete_reserv = $bdd->prepare("SELECT ch.id_ch, ch.num_ch,COUNT(su.chambre_id) AS nbr_recl
                            FROM t_suggestion AS su, t_chambre AS ch 
                            WHERE su.chambre_id=ch.id_ch AND su.hotel_id=:id_hotel 
                            GROUP BY su.chambre_id 
                            ORDER BY ch.num_ch");
                            $requete_reserv->BindParam(':id_hotel', $_SESSION['id_hotel']);
                            $requete_reserv->execute();
                            while ($donnees = $requete_reserv->fetch()) {
                                $id_ch = $donnees['id_ch'];
                                $num_ch = $donnees['num_ch'];
                                $nbr_recl = $donnees['nbr_recl'];
                                ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><a href="reclamation_view_detail.php?id_ch=<?php echo $id_ch;?>&num_ch=<?php echo $num_ch;?>" title="Voir le detail"><?php echo $num_ch; ?></a></td>
                                        <td><?php echo $nbr_recl; ?></td>
                                        <td><a href="reclamation_view_detail.php?id_ch=<?php echo $id_ch; ?>&num_ch=<?php echo $num_ch;?>" title="Afficher le detail" class="btn btn-info btn-xs"><i class="fa fa-folder"></i> View Detail </a></td>
                                    </tr>
                            <?php
                            $i++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.panel-body -->

            </div>
            <!-- / Div stratégique -->
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<!-- jQuery -->
<script src="../datepicker/jquery.js"></script>
<script src="../datepicker/jquery.datetimepicker.js"></script>
<script>
    $('#datetimepicker6').datetimepicker();
    $('#datetimepickerOcc').datetimepicker();
    $('#datetimepickerLib').datetimepicker();
    $('#datetimepickerLib1').datetimepicker();
</script>

<script src="../js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>
<script src="../js/bootstrap-modal.js"></script>
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
        $('#dataTables-example').dataTable();
    });

</script>