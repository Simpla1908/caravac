<?php
// Inclusion du fichier contenant la connexion à la base
require '../bdd/connexion.php';
include('Receptionniste.php');
?>
<?php include('head.php'); ?>
<?php include('menu_Rec.php'); ?>
<?php 
$_SESSION['p_debut']=date('d/m/Y');
$_SESSION['p_fin']=date('d/m/Y');
?>

<div id="page-wrapper">
    <div class="col-lg-12">
        <h2 class="page-header">Hébergement
        <small class='hidden'> <span id="sous_titre1">Tout</span> <i class="fa fa-sort-desc"></i></small>
        </h2>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div id="total_chambre" class="col-lg-12">
                        <div class="col-md-9">
                            <span id="sous_titre">Réservation</span><span id="titre"> du <?php echo $_SESSION['p_debut'].' au '.$_SESSION['p_fin'] ; ?></span>
                        </div>
                        <div class="col-md-3">
                            <div class="btn-group  btn-group-sm">
                                <a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal1" title="Filtrer la liste" >
                                    <i class="fa fa-hourglass-half"></i> Filtrer
                                </a>
                                <?php if (in_array('ER',$_SESSION['actions']['code_actions'])) { ?>
    <!--                            <a href="rec_reservation_multiple.php?hebergement=1" class="btn btn-success" title="Editer une Réservation" >
                                    <i class="fa fa-edit"></i> 
                                </a>-->
                                <?php } ?>

                                <?php if (in_array('ILR',$_SESSION['actions']['code_actions'])){?>
                                <a id="impression" href="#" class="btn btn-primary btn-xs" title="Imprimer la liste">
                                    <i class="fa fa-print"></i> Imprimer
                                </a>
                                <?php } ?>
                            </div>
                        </div> 
                    </div>
                </div>
                    <input type="hidden" name="p_debut" id="p_debut" value="<?php echo $_SESSION['p_debut']; ?>">
                    <input type="hidden" name="p_fin" id="p_fin" value="<?php echo $_SESSION['p_fin'] ; ?>">
                    <input type="hidden" name="type_client" id="type_client" value="tout"> 
                    <input type="hidden" name="service_heb" id="service_heb" value="reservation"> 
            </div>
            <!-- /.panel-heading -->


            <!-- Div stratégique -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover table-condensed" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>N° Rés</th>
                                <th>Client</th>
                                <th>Responsable</th>
                                <th>Date</th>
                                <th>Arrivée </th>
                                <th>Sortie </th>
                                <th>Etat</th>           
                                <th align="center" >Actions</th>
                            </tr>
                        </thead>
                        <tbody id="tb_contenu" class="table_occup_prev">
                            <?php include('data_liste_reservation.php'); ?>
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
                                    <label>Services&nbsp;:</label>
                                    <select class="form-control" id="service" name="service" required>
                                        <option value="reservation">Réservation</option>
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
        $('#dataTables-example').dataTable();
        
        
        $('#btn_occup_prev').click(function (e) {
            e.preventDefault();
            var bool=false;
            var datedebut=$('#datedebut').val();
            var datefin=$('#datefin').val();
            var type_cl=$('#type_cl').val();
            var service=$('#service').val();
            var donnees = $('#form').serialize();
//            alert(donnees);
            $.ajax({
                url: 'data_liste_reservation.php',
                type: 'POST',
                data: donnees,
                beforeSend: function () {
                    $("#loader").removeClass('hidden');
                    $("#btn_occup_prev").addClass('hidden');
                },
                success: function (data) {
//                    alert(data);
                    $("#sous_titre1").empty().html(type_cl);
                    $("#sous_titre").empty().html(service);
                    $("#titre").empty().html(' du '+ datedebut+' au '+datefin);
                    $('#tb_contenu').empty().append(data);
                    $('#p_debut').val(datedebut);
                    $('#p_fin').val(datefin);
                    $('#type_client').val(type_cl);
                    $('#service_heb').val(service);
                    $("#myModal1").modal('hide');
                    bool=true;

                },complete: function () {
                    if (bool) {
                        $("#loader").addClass('hidden');
                         $("#btn_occup_prev").removeClass('hidden');
                    } else {
                        $("#loader").removeClass('hidden');
                    }
                }
            });

         });
        $(".table_occup_prev").on('click', '#btn_occup', function (event) {
            event.preventDefault();
            $('#id_res').val($(this).attr("data-res"));
            $('#id_client').val($(this).attr("data-client"));
            $('#id_chambre').val($(this).attr("data-chambre"));

        });
        
        $('#impression').click(function (e) {
         e.preventDefault();
         var datedebut = $('#p_debut').val();
         var datefin = $('#p_fin').val();
         var type_cl = $('#type_client').val();
         var service = $('#service_heb').val();
         window.open('impression/imprime_liste_hebergement.php?datedebut=' + datedebut + "&datefin=" + datefin + "&type_cl=" + type_cl + "&service=" + service);
//         alert(type_cl);
     });
        
    });
	
    </script>