<?php
// Inclusion du fichier contenant la connexion à la base
require '../bdd/connexion.php';
include('Receptionniste.php');
?>
<?php include('head.php'); ?>
<?php include('menu_Rec.php'); ?>
<div id="page-wrapper">
    <div class="col-lg-12">
        <h3 class="page-header">Versement caisse</h3>
        <div class="panel panel-default">
            <div class="panel-heading">
                <!--                <h4>
                    Liste de réservations du jour (le <?php echo date('d/m/Y'); ?>)
                    <?php if (in_array('ILR',$_SESSION['actions']['code_actions'])){?>
                    <a class="btn btn-primary btn-sm pull-right"  href="impression/imprime_liste_reservation.php?reservation=encours" target="_blank"><i class="fa fa-print"></i> Imprimer</a>
                    <?php }?>
                    <?php if (in_array('ER',$_SESSION['actions']['code_actions'])) { ?>
                    <a class="btn btn-primary btn-sm pull-right"  href="rec_reservation_multiple.php?hebergement=1"><i class="fa fa-edit"></i> Effectuer une réservation</a>
                    <?php } ?>
                </h4>-->
                
                <div class="row">
                    <div id="total_chambre" class="col-lg-12">
                        <div class="col-md-9">
                            <span id="sous_titre">Liste de versements</span>
                        </div>
                        <div class="col-md-3">
                            <div class="btn-group  btn-group-sm">
                                <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#myModal1" title="Filtrer la liste" >
                                    <i class="fa fa-hourglass-half"></i> Filtrer
                                </a>
                                <?php if (in_array('ER',$_SESSION['actions']['code_actions'])) { ?>
                                    <!--                            <a href="rec_reservation_multiple.php?hebergement=1" class="btn btn-success" title="Editer une Réservation" >
                                                                    <i class="fa fa-edit"></i>
                                                                </a>-->
                                <?php } ?>
                                <a id="verserbtn" href="#" class="btn btn-primary" title="Imprimer la liste" data-toggle="modal" data-target="#myModal_versement">
                                    <i class="fa fa-money"></i> Verser
                                </a>
                                <?php if (in_array('ILR',$_SESSION['actions']['code_actions'])){?>
        <!--                            <a id="impression" href="#" class="btn btn-primary" title="Imprimer la liste">
                                        <i class="fa fa-print"></i> Imprimer
                                    </a>-->
                                <?php } ?>
                            </div>
                        </div> 
                    </div>
                </div>
                <input type="hidden" name="type_client" id="type_client" value="tout">
                <input type="hidden" name="service_heb" id="service_heb" value="reservation">
            </div>
            <!-- /.panel-heading -->


            <!-- Div stratégique -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Utilisateur</th>
                            <th>Date</th>
                            <th>Montant en USD</th>
                            <th>Montant en CDF</th>
                        </tr>
                        </thead>
                        <tbody id="tb_contenu">
                        <?php include('dataversement.php'); ?>
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

                            <div class="col-lg-12 form-group">
                                <label>Utilisateurs &nbsp;:</label>
                                <select class="form-control" id="user" name="user" required>
                                    <option value="0"selected="selected">Tout</option>
                                    <?php
                                    include("../REC/utilisateur/users_select.php");
                                    foreach ($users as $u):
                                        echo '<option value=' . $u->id_user . '>' . $u->nom_user. '</option>';
                                    endforeach;
                                    ?>
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

<?php
$libelles=getLibelleVersement($bdd,'heb',$_SESSION['id_hotel'],$_SESSION['id_user']);
include('./popup_versement.php');
//include('./func_versement.php');
?>
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
        function effacer() {

            $(':input', '#formversement').not(':button,:submit,:reset,:hidden,\n\
                               #user_id')
                .val(0)
                .removeAttr('checked')
                .removeAttr('selected');
        }

        $('#dataTables-example').dataTable(
            {
                "ordering":false,
            }
        );
        $('#user_id').change(function (e) {
            effacer();
            e.preventDefault();
            var bool = false;
            var donnees=$('#formversement').serialize();
            $.ajax({
                url: 'datamontant.php',
                type: 'POST',
                data: donnees,
                beforeSend: function () {
                    $("#loader_vers").removeClass('hidden');
                    $("#verser_montant").addClass('hidden');
                },
                success: function (data) {
                    $('#paie_id').val(data.paie_id);
                    $('#montant').val(data.montant_vers);
                    $('#montant_aff').val(data.montant_vers_aff);
                    $('#montant_tot_calc').val(data.montant_tot_calc);
                    bool=true;

                },complete: function () {
                    if (bool) {
                        $("#loader_vers").addClass('hidden');
                        $("#verser_montant").removeClass('hidden');
                    } else {
                        $("#loader_vers").removeClass('hidden');
                    }
                }, dataType: 'json'
            });
        });
        $('#verser_montant').click(function (e) {
            e.preventDefault();
            var bool = false;
			var libelle=$("#libelle option").text();
            $("#nomlibelle").val(libelle);
            var donnees=$('#formversement').serialize();
            $.ajax({
                url: './Traitement/versement.php',
                type: 'POST',
                data: donnees,
                beforeSend: function () {
                    $("#loader_vers").removeClass('hidden');
                    $("#verser_montant").addClass('hidden');
                },
                success: function (data) {
                    if (data.message == 'usernoselect') {
                        $('#msg').show().fadeOut(4000)
                            .addClass('alert-danger')
                            .removeClass('alert-success');
                        $('#msg_alert').text('Veuilez choisir un utilisateur!')
                    }else if(data.message == 'montantvide'){
                         $('#msg').show().fadeOut(4000)
                            .addClass('alert-danger')
                            .removeClass('alert-success');
                        $('#msg_alert').text('Veuilez entrer les montants!')
                    } 
                    else if (data.message == 'montantnocorrect') {
                        $('#msg').show().fadeOut(4000)
                            .addClass('alert-danger')
                            .removeClass('alert-success');
                        $('#msg_alert').text("Il n'est pas possible de verser cette somme")
                    } else if (data.message == 'OK') {
                        $('#msg').show().fadeOut(4000)
                            .addClass('alert-danger')
                            .removeClass('alert-success');
                        $('#msg_alert').text('Versement effectué avec succes!')
                        effacer();
                        $('#user_id option[value="0"]').prop('selected', true);

                        var donnees = '';
                        //alert(donnees);
                        $.ajax({
                            url: 'select_libelle_versement.php',
                            type: 'POST',
                            data: donnees,
                            success: function (data) {
                                //alert(data);
                                $('#libelle_verse').empty().append(data);
                            }
                        });
                        
                        $.ajax({
                            url: 'dataversement.php',
                            type: 'POST',
                            data: donnees,
                            success: function (data) {
                                //alert(data);
                                $('#tb_contenu').empty().append(data);
//                                $('#libelle_verse').load('./select_libelle_versement.php');
                            }
                        });
                        $("#myModal_versement").modal('hide');
                        window.open('impression/recu_repartition.php');
                        location.reload();
                    }
                    bool=true;
                },complete: function () {
                    if (bool) {
                        $("#loader_vers").addClass('hidden');
                        $("#verser_montant").removeClass('hidden');
                    } else {
                        $("#loader_vers").removeClass('hidden');
                    }
                }, dataType: 'json'
            });
        });
        $('#btn_vers').click(function (e) {
            e.preventDefault();
            var bool=false;
            var datedebut=$('#datedebut').val();
            var datefin=$('#datefin').val();
            var donnees = $('#form').serialize();
            //alert(donnees);
            $.ajax({
                url: 'dataversement.php',
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