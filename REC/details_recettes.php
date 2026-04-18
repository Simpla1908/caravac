<?php
// Inclusion du fichier contenant la connexion à la base
require '../bdd/connexion.php';
include('Receptionniste.php');
if(isset($_GET['dte'])){
    $date=$_GET['dte'];
    $stringdate = trim($date);
    $tmp = explode("-",$stringdate);
    $date_iso =$tmp[2]."/".$tmp[1]."/".$tmp[0];
}else{
    header("location:recettes.php");
}
?>
<?php include('headerRec.php'); ?>
<?php include('menu_Rec.php'); ?>
<div id="page-wrapper">
    <div class="col-lg-12">
        <h2 class="page-header">Recette</h2>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div id="total_chambre" class="col-lg-12">
                        <div class="col-md-9">
                            <span id="sous_titre">Liste détails recettes du <?php echo $date_iso; ?></span>
                        </div> 
                    </div>
                </div>
            </div>
            <!-- /.panel-heading -->
            
            <!-- Div stratégique -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th>#</th>
                            <?php if (in_array('VTRCT', $_SESSION['actions']['code_actions'])) {?>
                             <th>Agent</th>
                            <?php }?>
                            <th>N° Facture</th>
                            <th>N° reçu</th>
                            <th>Client</th>
                            <th>Service</th>
                            <th>Montant</th>
                        </tr>
                        </thead>
                        <tbody id="tb_contenu">
                        <?php include('data_details_recette.php'); ?>
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


<!-- Modal -->
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h5 class="modal-title" id="myModalLabel">Filtrage liste </h5>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="form">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="col-lg-6 form-group">
                                <label>Période du&nbsp;:</label>
                                <input class="form-control" id="datedebut" name="datedebut" required="required" value="<?php echo date('d/m/Y'); ?>">
                            </div>
                            <!-- /.col-lg-6 -->
                            <div class="col-lg-6 form-group">
                                <label>au&nbsp;:</label>
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
                <button type="submit" class="btn btn-primary" id="btn_vers">&nbsp;Valider</button>
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
    $(document).ready(function() {
        $('#dataTables-example').dataTable(
            {
                "ordering":false,
            }
        );
        $('#btn_vers').click(function (e) {
            e.preventDefault();
            var bool=false;
            var datedebut=$('#datedebut').val();
            var datefin=$('#datefin').val();
            var donnees = $('#form').serialize();
            //alert(donnees);
            $.ajax({
                url: 'datarecette.php',
                type: 'POST',
                data: donnees,
                beforeSend: function () {
                    $("#loader").removeClass('hidden');
                    $("#btn_vers").addClass('hidden');
                },
                success: function (data) {
                 //   alert(data);
                    $('#tb_contenu').empty().append(data);
                    $('#p_debut').val(datedebut);
                    $('#p_fin').val(datefin);
                    $("#myModal1").modal('hide');
                    bool=true;

                },complete: function () {
                    if (bool) {
                        $("#loader").addClass('hidden');
                        $("#btn_vers").removeClass('hidden');
                    } else {
                        $("#loader").removeClass('hidden');
                    }
                }
            });

        });
    });

</script>