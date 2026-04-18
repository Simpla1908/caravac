<?php
// Inclusion du fichier contenant la connexion à la base

include('Receptionniste.php');
?>
<?php include('head.php'); ?>
<?php include('menu_Rec.php'); ?>
<?php
$_SESSION['p_debut'] = date('d/m/Y');
$_SESSION['p_fin'] = date('d/m/Y');
$_SESSION['type_cl'] = 'tout';
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Libérations</h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                    <div id="total_chambre" class="col-lg-12">
                        <div class="col-md-9">
                            Liste <span id="titre"></span>
                        </div>
                        <div class="col-md-3">
                            <div class="btn-group  btn-group-sm">
                                <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#myModal1"
                                    title="Filtrer la liste">
                                     <i class="fa fa-hourglass-half"></i> Filtrer
                                 </a>
                                <?php if (in_array('ER',$_SESSION['actions']['code_actions'])) { ?>
    <!--                            <a href="rec_reservation_multiple.php?hebergement=1" class="btn btn-success" title="Editer une Réservation" >
                                    <i class="fa fa-edit"></i> 
                                </a>-->
                                <?php } ?>

                                <?php if (in_array('ILR',$_SESSION['actions']['code_actions'])){?>
    <a id="impression" href="" class="btn btn-primary" title="Imprimer la liste">
                                    <i class="fa fa-print"></i> Imprimer
                                </a>
                                <?php } ?>
                            </div>
                        </div> 
                    </div>
                </div>
                    <input type="hidden" name="p_debut" id="p_debut" value="<?php echo $_SESSION['p_debut']; ?>">
                    <input type="hidden" name="p_fin" id="p_fin" value="<?php echo $_SESSION['p_fin']; ?>">
                    <input type="hidden" name="type_client" id="type_client" value="tout">
                    <input type="hidden" name="etat_print" id="etat_print" value="0">
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-condensed" id="dataTables-example">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Client</th>
                                <th>Responsable</th>
                                <th>Chambre</th>
                                <th>Date de sortie</th>
                                <th>Nuité(s)</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody id="tb_contenu" class="table_occup_prev">
                            <?php include('dataliberations.php'); ?>
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
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="myModal">
        <div class="modal-dialog modal-lge">
            <div class="modal-content">
                <div id="historique_lib" style="padding: 10px;">

                </div>

            </div>
        </div>
    </div>

    <!-- /.modal -->

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<!-- Modal -->
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
            var type_cl = $('#type_cl').val();
            var donnees = $('#form').serialize();
            $.ajax({
                url: 'dataliberations.php',
                type: 'POST',
                data: donnees,
                beforeSend: function () {
                    $("#loader").removeClass('hidden');
                    $("#btn_occup_prev").addClass('hidden');
                },
                success: function (data) {
                    $("#titre").empty().html('du ' + datedebut + ' au ' + datefin)
                    $('#tb_contenu').empty().append(data);
                    $('#type_client').val(type_cl);
                    $('#etat_print').val(1);
                    $("#myModal1").modal('hide');
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
        
        
        
        $('#impression').click(function (e) {
            e.preventDefault();
            
            var bool = false;
            var datedebut = $('#datedebut').val();
            var datefin = $('#datefin').val();
            var type_cl = $('#type_client').val();
            var etat_print = $('#etat_print').val();
            
//            alert(datedebut);
            
            window.open('impression/impression_liste_liberation.php?type_cl='+type_cl+'&datedebut='+ datedebut +'&datefin='+ datefin +'&etat_print='+ etat_print);
        });
        
        
        
        $(".table_occup_prev").on('click', '#btn_occup', function (event) {
            event.preventDefault();
            var idres_ch= $(this).attr("data-idresch");
            //alert(idres_ch);
            $.ajax({
                url: 'classeur_liberation.php?idres_ch='+idres_ch,
                type: 'POST',
                success: function (html) {
                   // alert(html);
                    $("#historique_lib").html(html);
                    $("#myModal").modal('show');
                }
            });

        });

     /*   $('#impression').click(function (e) {
            e.preventDefault();
            var datedebut = $('#p_debut').val();
            var datefin = $('#p_fin').val();
            var type_cl = $('#type_client').val();
            window.open('impression/imprime_liste_clients_attendus.php?datedebut=' + datedebut + "&datefin=" + datefin + "&type_cl=" + type_cl);
//         alert(type_cl);
        });*/


    });

</script>

