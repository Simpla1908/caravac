<?php
// Inclusion du fichier contenant la connexion à la base

include('Receptionniste.php');
?>
<?php include('head.php'); ?>
<?php include('menu_Rec.php'); ?>
<?php
$_SESSION['p_debut'] = date('d/m/Y');
$_SESSION['p_fin'] = date('d/m/Y');
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header" id="titre">Hébergement</h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-user fa-fw"></i> Situation clients logés
                     <a class="btn btn-primary btn-xs pull-right"  href="impression/imprime_situation_client_loge.php"><i class="fa fa-print"></i> Imprimer</a>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-condensed" id="dataTables-example">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Date Occ.</th>
                                <th class="hidden">Respons.</th>
                                <th>Client</th>
                                <th>Accomp</th>
                                <th>Chambre</th>
                                <th>Tarif</th>
                                <th>Nuité(s)</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody id="tb_contenu" class="table_clientloges">
                            <?php include('dataclientsloges.php'); ?>
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
                    <h5 class="modal-title" id="myModalLabel"><strong>Filtrage de la liste hébergement</strong></h5>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="form">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-6 form-group">
                                    <label>Service&nbsp;:</label>
                                    <select class="form-control" id="service" name="service" required>
                                        <option value="hebergement">Hebergement</option>
                                    </select>
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label>Type client&nbsp;:</label>
                                    <select class="form-control" id="type_cl" name="type_cl" required>
                                        <option value="tout" selected="selected">tout</option>
                                        <option value="client occasionnel">occasionnel</option>
                                        <option value="client partenaire">partenaire</option>
                                    </select>
                                </div>

                            </div>
                            <!-- /.col-lg-12 -->
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-6 form-group">
                                    <label>Date d'entrée&nbsp;:</label>
                                    <input class="form-control" id="datedebut" name="datedebut" required="required"
                                           value="<?php echo date('d/m/Y'); ?>">
                                </div>
                                <!-- /.col-lg-6 -->
                                <div class="col-lg-6 form-group">
                                    <label>Date de sortie&nbsp;:</label>
                                    <input class="form-control" id="datefin" name="datefin" required="required"
                                           value="<?php echo date('d/m/Y'); ?>">
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
                <form>
                    <input type="hidden" name="id_trc" class="form-control"
                           id="id_trc">
                    <input type="hidden" name="client_id" class="form-control" id="client_id">
                    <input type="hidden" name="ch_id" class="form-control" id="ch_id">
                    <input type="hidden" name="res_id" class="form-control" id="res_id">
                </form>
            </div>
            <div class="modal-body" id="modal-body_data">
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

        $('#dataTables-example').dataTable();
        $('#btn_occup_prev').click(function (e) {
            e.preventDefault();
            var bool = false;
            var datedebut = $('#datedebut').val();
            var datefin = $('#datefin').val();
            var donnees = $('#form').serialize();
            $.ajax({
                url: 'dataclientsloges.php',
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
        $("#dataTables-example").on('click', '#tb_contenu tr .change_ch', function (e) {
            e.preventDefault();
            var id_trc = $(this).attr('id');
            var id_client = $(this).attr('id1');
            var id_ch = $(this).attr('id2');
            var id_res = $(this).attr('id3');
            var date_lib = $(this).attr('id4');
            $.ajax({
                url: 'Traitement/data_select_chamb.php?date_lib='+date_lib,
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
            var bool = false;
            var id_chx_new = $(this).attr('id1');
            var tarif = $(this).attr('datatarif');
            var monnaie = $(this).attr('datamonnaie');
            var id_reserv_chx = $('#id_trc').val();
            var id_client = $('#client_id').val();
            var id_chx_ex = $('#ch_id').val();
            var id_reserv = $('#res_id').val();
            var donnees = '';
            $.ajax({
                url: 'Traitement/changement_chambre_encours.php?id_chx_ex=' + id_chx_ex + "&id_client=" + id_client + "&id_chx_new=" + id_chx_new + "&id_reserv=" + id_reserv + "&id_reserv_chx=" + id_reserv_chx + "&tarif=" + tarif + "&monnaie=" + monnaie,
                type: 'POST',
                data: donnees,
                beforeSend: function () {
                    $("#loader").removeClass('hidden');
                    $(".selection_ch").addClass('hidden');
                },
                success: function (data) {
                    // alert(data);
                    //mise à jours données
                    var donnees = $('#form').serialize();
                    $.ajax({
                        url: 'dataclientsloges.php',
                        type: 'POST',
                        data: donnees,
                        success: function (data2) {
                            //alert(data2);
                            $('#myModal').modal('hide');
                            $('#tb_contenu').empty().append(data2);
                        }
                    });
                    bool = true;
                }, complete: function () {
                    if (bool) {
                        $("#loader").addClass('hidden');
                        $(".selection_ch").removeClass('hidden');
                    } else {
                        $("#loader").removeClass('hidden');
                    }
                }
            });
        });

    });

</script>

