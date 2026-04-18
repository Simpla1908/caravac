<?php include('head.php'); ?>
<?php include('menu_Rec.php'); 
?>

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="page-header">Hébergement</h2>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <?php 
                include('./Traitement_reservation/datadetails_hebergement.php'); 
                
                $Nombres_jours = NbJours($date_arrive, $date_sortie);
                $nb_jrs = $Nombres_jours;
                $nbre_jr = $nb_jrs;
                ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-calendar"></i> Détails <?php echo ucfirst($type_res) ?>
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="row invoice-info">
                                    <div class="col-sm-4 invoice-col">
                                        <address>
                                            <strong><?php echo ucwords($nom_client) ?></strong><br>
                                            Type: <?php echo $type_cl ?><br>
                                            Responsable: <?php echo $responsable ?><br>
                                            Adresse: <?php echo $adresse ?><br>
                                            Provenance: <?php echo $provenance ?><br>
                                            Tél: <?php echo $phone ?><br>
                                            Email: <?php echo $email ?>
                                        </address>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 invoice-col">
                                        <address>
                                            <strong><?php echo ucfirst($type_res) ?> N° <?php echo $num_reserv ?></strong><br>
                                            Date: <?php echo dateAffiche($date_res) ?><br>
                                            Date d'arrivée: <?php echo dateAffiche($date_arrive) ?><br>
                                            Date de sortie: <?php echo dateAffiche($date_sortie) ?><br>
                                            Nombre de nuité: <?php echo $nbre_jr ?>
                                            <font color="#FF0000" class='hidden'> Soit <?php echo $nbre_jr ?> Jour(s)</font>
                                        </address>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 invoice-col hidden">
                                        <b><?php echo ucfirst($type_res) ?> N° <?php echo $num_reserv ?></b><br>
                                        <br>
                                        <b class="hidden">Type:</b> <?php echo $type_res ?><br>
                                        <b class='hidden'>Statut:</b> 
                                        <small class="label label-warning hidden"> 
                                            <?php 
                                           if($etat_res=='operationnel'){
                                                $etat_res='reservé';
                                            }elseif($etat_res=='execute'){
                                              $etat_res='occupé';
                                            } 
                                            echo $etat_res;
                                            ?>
                                        </small>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                                
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h5 class="page-header"><i class="fa fa-bed"></i> Liste des chambres</h5>
                                    </div>
                                    <div class="col-xs-12 table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>N°</th>
                                                    <th>Chambre</th>
                                                    <th>Tarif</th>
                                                    <th  class='hidden'>Montant</th>
                                                    <th class='hidden'>Statut</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody  id="tb_contenu" class="table_occup_prev">
                                                 <?php include('datadetailsreservation.php'); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h5 class="page-header"><i class="fa fa-money"></i> Aperçu paiement</h5>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="well well-sm text-center">
                                            <h4>Montant total :</h4>
                                            <h2><?php echo afficheMontant($m_affiche,$montant_total) ?></h2>
                                        </div>
                                    </div>
                                    <!-- /.col-lg-4 -->
                                    <div class="col-lg-4">
                                        <div class="well well-sm text-center">
                                            <h4>Montant payé :</h4>
                                            <h2 class="text-success"><?php echo afficheMontant($m_affiche,$montant_paye) ?></h2>
                                        </div>
                                    </div>
                                    <!-- /.col-lg-4 -->
                                    <div class="col-lg-4">
                                        <div class="well well-sm text-center">
                                            <h4>Mode de paiement : </h4>
                                            <h2 class="text-danger"><?php echo strtoupper($mode_paiement) ?></h2>
                                        </div>
                                    </div>
                                    <!-- /.col-lg-4 -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
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
        <script src="../js/jquery.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="../js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="../js/plugins/metisMenu/metisMenu.min.js"></script>

        <!-- DataTables JavaScript -->
<!--        <script src="../js/plugins/dataTables/jquery.dataTables.js"></script>
        <script src="../js/plugins/dataTables/dataTables.bootstrap.js"></script>-->

        <!-- Custom Theme JavaScript -->
        <script src="../js/sb-admin-2.js"></script>
        <!-- Page-Level Demo Scripts - Tables - Use for reference -->
        <script>
            $(document).ready(function () {
        
//        $('#dataTables-example').dataTable();
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
            var id_res= $('#id_res').val();
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
                    $.ajax({
                        url: 'datadetailsreservation.php?id_res1='+id_res,
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

    </body>

</html>
