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
            <h3 class="page-header" id="titre">Hébergement </h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-user fa-fw"></i>Clients attendus
                    <a class="btn btn-primary btn-xs pull-right"  href="impression/imprime_liste_clients_attendus.php" target="_blank"><i class="fa fa-print"></i> Imprimer</a>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-condensed" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>N° réservation</th>
                                    <th>Chambre</th>
                                    <th>Client</th>
                                    <th>Responsable</th>
                                    <th>Date d'arrivée</th>
                                    <th>Date de sortie</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="tb_contenu" class="table_occup_prev">
                                <?php include('dataoccupation_prevue.php'); ?>
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
<!-- Modal -->
<div class="modal fade myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Occupation</h4>
            </div>
            <div class="modal-body">
                <div id="msg" class="alert alert-danger alert-dismissable" style="display:none;">
                    <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
                    <span id="msg_alert">Veuillez saisir les valeurs correctes dans tous les champs!</span>
                </div>
                <form id="form_confirm_occup" action="Traitement_reservation/occupation.php" method="post">
                    <input type="hidden" name="idresch" id="idresch" value="">
                    <input type="hidden" name="id_res" id="id_res" value="">
                    <input type="hidden" name="id_chambre" id="id_chambre" value="">
                    <input type="hidden" name="id_client" id="id_client" value="0">
                    <input type="hidden" name="id_client1" id="id_client1" value="0">
                    <input type="hidden" name="nom_client1" id="nom_client1" value="">
                    <input type="hidden" name="id_client2" id="id_client2" value="0">
                    <input type="hidden" name="nom_client2" id="nom_client2" value="">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="radio" name="prs" id="seul" value="0" checked> Responsable
                                </div>
                                <div class="col-md-6">
                                    <input type="radio" name="prs" id="seul1"  value="1" data-toggle="modal" data-target=".bs-example-modal-lg-client"> Autre
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-red">
                                    <br>
                                    <input type="checkbox" name="accomp" id="accomp"  value="2" data-toggle="modal" data-target=".bs-example-modal-lg"> <font color="red">Accompagné(e)</font>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
        <!--                            <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Fermer</button>
        -->                            <button type="submit" class="btn btn-primary pull-right" id="confirm_occup"><i class="fa fa-check-circle"></i> Confirmer</button>
                                    <span class="btn btn-danger hidden pull-right" id="loader2">
                                    <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
                                    </span>
                                </div>
                            </div>
                        </div>    
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php include('modal_client.php') ?>
<?php include('modal_client_accomp.php') ?>
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
            var bool=false;
            var datedebut=$('#datedebut').val();
             var datefin=$('#datefin').val();
            var donnees = $('#form').serialize();
            $.ajax({
                url: 'dataoccupation_prevue.php',
                type: 'POST',
                data: donnees,
                beforeSend: function () {
                    $("#loader").removeClass('hidden');
                    $("#btn_occup_prev").addClass('hidden');
                },
                success: function (data) {
                    $("#titre").empty().html('Hébergement du '+ datedebut+' au '+datefin)
                     $('#tb_contenu').empty().append(data);
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
            $('#idresch').val($(this).attr("data-idresch"));

        });
        $('#confirm_occup').click(function (e) {
            e.preventDefault();
            var bool=false;
            var donnees = $('#form_confirm_occup').serialize();
            $.ajax({
                url: 'Traitement_reservation/occupation.php',
                type: 'POST',
                data: donnees,
                beforeSend: function () {
                    $("#loader2").removeClass('hidden');
                    $("#confirm_occup").addClass('hidden');
                },
                success: function (data) {
                    //mise à jours données occupation prevue
                    var donnees = $('#form').serialize();
                    //alert(data);
                    $.ajax({
                        url: 'dataoccupation_prevue.php',
                        type: 'POST',
                        data: donnees,
                        success: function (data2) {
                            //alert(data2);
                            $('#tb_contenu').empty().append(data2);
                            $(".myModal").modal('hide');                        }
                    });
                    bool=true;

                },complete: function () {
                    if (bool) {
                        $("#loader2").addClass('hidden');
                         $("#confirm_occup").removeClass('hidden');
                    } else {
                        $("#loader2").removeClass('hidden');
                    }
                }
            });
        });
        $('#valider_cli').click(function (e) {
            e.preventDefault();
            var sexe_client = $('#sexe_client_cli').val();
            var etat_civil_client = $('#etat_civil_client_cli').val();
            var donnees = $('#form_client_cli').serialize() + "&sexe=" + sexe_client + "&etat=" + etat_civil_client;
            //alert(donnees);
            $.ajax({
                url: 'Traitement_reservation/enreg_client_accomp.php',
                type: 'POST',
                data: donnees,
                success: function (data) {
                    if (data.message_succes == 'succes') {
                        $('#id_client1').val(data.id_client);
                        $('#nom_client1').val(data.nom_client);
                        $("#seul").replaceWith('<input type="radio" name="prs" id="seul" value="0">');
                        $("#seul1").replaceWith('<input type="radio" name="prs" id="seul1"  value="1" data-toggle="modal" data-target=".bs-example-modal-lg-client" checked>');
                        $(".bs-example-modal-lg-client").modal('hide');
                    } else if (data.message_vide == 'vide') {
                        $('#msg1').show().fadeOut(4000)
                            .addClass('alert-danger')
                            .removeClass('alert-success');
                        $('#msg_alert1').text('Veuilez remplir les champs vides!')

                    }

                }, dataType: 'json'
            });


        });
        $('#annuler_cli').click(function () {
            $("#seul").replaceWith('<input type="radio" name="prs" id="seul" value="0" checked>');
            $("#seul1").replaceWith('<input type="radio" name="prs" id="seul1"  value="1" data-toggle="modal" data-target=".bs-example-modal-lg-client">');
        });
        $('#valider_acc').click(function (e) {
            e.preventDefault();
            var sexe_client = $('#sexe_client_acc').val();
            var etat_civil_client = $('#etat_civil_client_acc').val();
            var donnees = $('#form_client_accomp').serialize() + "&sexe=" + sexe_client + "&etat=" + etat_civil_client;
            //alert(donnees);
            $.ajax({
                url: 'Traitement_reservation/enreg_client_accomp.php',
                type: 'POST',
                data: donnees,
                success: function (data) {
                    if (data.message_succes == 'succes') {
                        $('#id_client2').val(data.id_client);
                        $('#nom_client2').val(data.nom_client);
                        $("#accomp").replaceWith('<input type="checkbox" name="accomp" id="accomp"  value="2" data-toggle="modal" data-target=".bs-example-modal-lg" checked>');
                        $(".bs-example-modal-lg").modal('hide');
                    } else if (data.message_vide == 'vide') {
                        $('#msg1').show().fadeOut(4000)
                                .addClass('alert-danger')
                                .removeClass('alert-success');
                        $('#msg_alert1').text('Veuilez remplir les champs vides!')

                    }

                }, dataType: 'json'
            });


        });
        $('#annuler_acc').click(function () {
            $('#id_client2').val(0);
            $('#nom_client2').val('');
            $("#accomp").replaceWith('<input type="checkbox" name="accomp" id="accomp"  value="2" data-toggle="modal" data-target=".bs-example-modal-lg">');
        });
        $('#nom_client_acc').keyup(function () {

            var search = $(this).val();
            search = $.trim(search);

            if (search !== "") {
                $.ajax({
                    url: 'data.php',
                    type: 'POST',
                    dataType: 'html',
                    data: 'search=' + search,
                    success: function (data) {
                        $('#resultat ul').html(data).show();

                        $('.lien').click(function (e) {
                            e.preventDefault();
                            var lien = $(this).text();
                            $('#nom_client_acc').val(lien);
//                            alert(lien);
                            $.ajax({
                                url: 'data_show.php',
                                type: 'POST',
                                dataType: 'json',
                                data: 'lien=' + lien,
                                success: function (data) {
                                    $('#id_responsable_acc').val(data.id_respo);
                                    $('#id_client_acc').val(data.id_client);
                                    // $('#id_client2').val(data.id_client);

                                    from = data.date_naiss.split("-");
                                    f = from[2] + '/' + from[1] + '/' + from[0];

                                    $('#datetimepicker6_acc').val(f);
                                    $('#nationalite_client_acc').val(data.nationalite);
                                    $('#provenance_client_acc').val(data.provenance);
                                    $('#sexe_client_acc').val(data.sexe);
                                    $('#etat_civil_client_acc').val(data.etat_civil);
                                    $('#num_piece_identite_client_acc').val(data.piece);
                                    $('#num_passeport_client_acc').val(data.passeport);
                                    $('#adresse_provenance_client_acc').val(data.adresse);
                                    $('#telephone_client_acc').val(data.tel);
                                    $('#email_client_acc').val(data.email);
                                    $('#num_pers_contacter_client_acc').val(data.autres);
                                    //                                   $('#sexe_client option[value="Masculin"]').attr('selected','selected');

                                    // $('.disabled').attr('disabled','disabled');

                                    $('#resultat ul').hide();
                                }
                            });
                        });
                    }
                });

            } else {
                $('#resultat ul').hide();
                // $('.disabled').removeAttr('disabled','disabled');
                $('.disabled1').val(' ');
                $('#id_client_acc').val(0);
            }

        });

        $('#nom_client_cli').keyup(function () {

            var search = $(this).val();
            search = $.trim(search);

            if (search !== "") {
                $.ajax({
                    url: 'data.php',
                    type: 'POST',
                    dataType: 'html',
                    data: 'search=' + search,
                    success: function (data) {
                        $('#resultat ul').html(data).show();

                        $('.lien').click(function (e) {
                            e.preventDefault();
                            var lien = $(this).text();
                            $('#nom_client_cli').val(lien);
//                            alert(lien);
                            $.ajax({
                                url: 'data_show.php',
                                type: 'POST',
                                dataType: 'json',
                                data: 'lien=' + lien,
                                success: function (data) {
                                    $('#id_responsable_cli').val(data.id_respo);
                                    $('#id_client_cli').val(data.id_client);
                                    // $('#id_client2').val(data.id_client);

                                    from = data.date_naiss.split("-");
                                    f = from[2] + '/' + from[1] + '/' + from[0];

                                    $('#datetimepicker6_cli').val(f);
                                    $('#nationalite_client_cli').val(data.nationalite);
                                    $('#provenance_client_cli').val(data.provenance);
                                    $('#sexe_client_cli').val(data.sexe);
                                    $('#etat_civil_client_cli').val(data.etat_civil);
                                    $('#num_piece_identite_client_cli').val(data.piece);
                                    $('#num_passeport_client_cli').val(data.passeport);
                                    $('#adresse_provenance_client_cli').val(data.adresse);
                                    $('#telephone_client_cli').val(data.tel);
                                    $('#email_client_cli').val(data.email);
                                    $('#num_pers_contacter_client_cli').val(data.autres);
                                    //                                   $('#sexe_client option[value="Masculin"]').attr('selected','selected');

                                    // $('.disabled').attr('disabled','disabled');

                                    $('#resultat ul').hide();
                                }
                            });
                        });
                    }
                });

            } else {
                $('#resultat ul').hide();
                // $('.disabled').removeAttr('disabled','disabled');
                $('.disabled1').val(' ');
                $('#id_client_cli').val(0);
            }

        });


    });

</script>

