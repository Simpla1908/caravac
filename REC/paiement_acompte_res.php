<?php
// Inclusion du fichier contenant la connexion à la base
include('Receptionniste.php');
?>
<?php include('head.php'); ?>
<?php include('menu_Rec.php'); ?>
<?php 
$_SESSION['p_debut']=date('d/m/Y');
$_SESSION['p_fin']=date('d/m/Y');
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Paiements</h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-list fa-fw"></i> Acomptes des réservations <span class="text-danger">opérationnelles</span>
                    <a href="paiement_cash.php" class="btn btn-primary btn-xs pull-right" title="retour" >
                        <i class="fa fa-arrow-left"></i> Retour
                    </a>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-condensed" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>N° Reservation</th>
                                    <th>Client</th>
                                    <th>Responsable</th>
                                    <th>Montant Total</th>
                                    <th class="text-success">Acompte</th>
                                    <th>Reste</th>
                                </tr>
                            </thead>
                            <tbody id="tb_contenu" class="table_occup_prev">
                                <?php include('datapaiement_acompte.php'); ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <!--Modal-->

    <!-- Modal -->
    <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h5 class="modal-title" id="myModalLabel"><strong>Filtrage factures clients logés</strong></h5>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="form">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-6 form-group">
                                    <label>Hébergement&nbsp;:</label>
                                    <select class="form-control" id="service" name="service" required>
                                        <option value="occupation">Occupation</option>
                                    </select>
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label>Type client&nbsp;:</label>
                                    <select class="form-control" id="type_cl" name="type_cl" required>
                                        <option value="tout" selected="selected">All</option>
                                        <option value="client occasionnel">Occasionnel</option>
                                        <option value="client partenaire">Partenaire</option>
                                    </select>
                                </div>
                               
                            </div>
                            <!-- /.col-lg-12 -->
                        </div>
                        <div class="row hidden">
                            <div class="col-lg-12">
                                <div class="col-lg-6 form-group">
                                    <label>Date d'entrée&nbsp;:</label>
                                    <input class="form-control" id="datedebut" name="datedebut" required="required" value="<?php echo date('d/m/Y'); ?>">
                                </div>
                                <!-- /.col-lg-6 -->
                                <div class="col-lg-6 form-group">
                                    <label>Date de sortie&nbsp;:</label>
                                    <input class="form-control" id="datefin" name="datefin" required="required" value="<?php echo date('d/m/Y'); ?>">
                                </div>
                                <!-- /.col-lg-6 -->
                            </div>
                            <!-- /.col-lg-12 -->
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary" id="btn_occup_prev">&nbsp;Valider</button>
                     <span class="btn btn-danger hidden" id="loader">
                    <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
                     </span>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="../datepicker/jquery.js"></script>
<script src="../datepicker/jquery.datetimepicker.js"></script>
<script>
    $('#datedebut').datetimepicker({format: 'd/m/Y'});
    $('#datefin').datetimepicker({format: 'd/m/Y'});
    
</script>

<script src="../js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>
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
      $('#dataTables-example').dataTable(
             {
                "ordering": false,
             }
          );
        $('#btn_occup_prev').click(function (e) {
            e.preventDefault();
            var bool = false;
            var datedebut = $('#datedebut').val();
            var datefin = $('#datefin').val();
            var donnees = $('#form').serialize();
            $.ajax({
                url: 'datapaiement.php',
                type: 'POST',
                data: donnees,
                beforeSend: function () {
                    $("#loader").removeClass('hidden');
                    $("#btn_occup_prev").addClass('hidden');
                },
                success: function (data) {
                    $('#tb_contenu').empty().append(data);
                    bool = true;
                }, complete: function () {
                    if (bool) {
                        $("#loader").addClass('hidden');
                        $("#btn_occup_prev").removeClass('hidden');
                    } else {
                        $("#loader").removeClass('hidden');
                    }
                }
            });

        });
    });

</script>

