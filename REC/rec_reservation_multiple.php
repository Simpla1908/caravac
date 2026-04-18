<?php include('Receptionniste.php'); ?>
<?php include('headerRec.php'); ?>
<?php include('menu_Rec.php'); ?>
<?php unset($_SESSION['panier']); ?>


<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">
                <?php
                if (isset($_GET['hebergement']) && ($_GET['hebergement'] == 1)) {

                    echo 'Réservation';
                    $res = 1;
                    $_SESSION['hebergement'] = 1;
                } else {
                    echo 'Occupation directe';
                    $res = 2;
                    $_SESSION['hebergement'] = 2;
                }
                ?>
            </h2>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <form id="form_reservation" action="Traitement_reservation/envoi_data_reservation.php" data-parsley-validate
          class="form-horizontal form-label-left">
        <input name="heberge" id="hebergement" type="hidden" value="<?php echo $res; ?>">

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-user"></i> Identité du Client
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                            <div class="form-group">
                                <br>
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Type <span
                                        class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="ajax-select"
                                            class="form-control col-md-7 col-xs-12 selectpicker with-ajax"
                                            data-live-search="true">

                                    </select>
                                </div>
                                <input type="hidden" value="1" id="partenaire" name="partenaire">
                                <input type="hidden" id="id_client" name="id_client" value="0">
                            </div>
                            </div>
                            
                            <div class="col-lg-6" id="contenaire">
                                <br><br>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Noms
                                        client <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="nom_client" autocomplete="off" id="nom_client"
                                               required="required" class="form-control col-md-7 col-xs-12">
                                        <div id="resultat">
                                            <ul>
                                                
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Sexe
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control col-md-7 col-xs-12 disabled" name="sexe_client"
                                                id="sexe_client" >
                                            <option value=""></option>
                                            <option value="Masculin">Masculin</option>
                                            <option value="Feminin">Feminin</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Date de
                                        Naiss</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input class="form-control col-md-7 col-xs-12 disabled" type="text"
                                               id="datetimepicker7" name="date_naiss_client">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Etat Civil
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control col-md-7 col-xs-12 disabled"
                                                name="etat_civil_client" id="etat_civil_client">
                                            <option value=""></option>
                                            <option value="Marie">Marie</option>
                                            <option value="Celibataire">Celibataire</option>
                                            <option value="Divorce">Divorce</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Nationalité
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="nationalite_client" name="nationalite_client"
                                               class="form-control col-md-7 col-xs-12 disabled" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Provenance
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="provenance_client" name="provenance_client"
                                               class="date-picker form-control col-md-7 col-xs-12 disabled" type="text">
                                    </div>
                                </div>
                            </div>
                            <!-- /.col-lg-6 (nested) -->
                            <div class="col-lg-6">
                                <br><br>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Pièce
                                        identité
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                       <!-- <input type="number" id="num_piece_identite_client"
                                               name="num_piece_identite_client" min="0"
                                               class="disabled form-control col-md-7 col-xs-12"
                                               style="margin:0px auto;width:300px;">-->
                                        <select class="form-control col-md-7 col-xs-12 disabled"
                                                name="num_piece_identite_client" id="num_piece_identite_client">
                                            <option value=""></option>
                                            <option value="Carte d'électeur">Carte d'électeur</option>
                                            <option value="Permis de conduire">Permis de conduire</option>
                                            <option value="Passport">Passport</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Numéro
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="number" id="num_passeport_client" name="num_passeport_client"
                                               min="0" class="disabled form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="middle-name"
                                           class="control-label col-md-3 col-sm-3 col-xs-12">Adresse </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="adresse_provenance_client" name="adresse_provenance_client"
                                               class="disabled form-control col-md-7 col-xs-12" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Téléphone
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="tel" id="telephone_client" name="telephone_client"
                                               class="disabled form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Email
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="email" id="email_client" name="email_client"
                                               class="disabled form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Autre Contact
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="tel" id="num_pers_contacter_client"
                                               name="num_pers_contacter_client"
                                               class="disabled form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                            </div>
                            <?php
                            if (isset($_GET['hebergement']) && ($_GET['hebergement'] == 2)) {
                                ?>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="checkbox col-md-6 col-sm-6 col-xs-12">
                                            <label>
                                                <input type="checkbox" id="accompagn_true" checked="checked" value=""
                                                       data-toggle="modal" data-target=".bs-example-modal-lg"
                                                       style="display:none">
                                                <input type="checkbox" id="accompagn_false" value="" data-toggle="modal"
                                                       data-target=".bs-example-modal-lg"> <b>Accompagné</b> <span
                                                    id="nom_client22"></span>
                                            </label>
                                        </div>
                                        <input type="hidden" id="id_client2" name="id_client2" value="0">
                                        <input type="hidden" id="nom_client2" name="nom_client2">
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <!-- /.row (nested) -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-calendar"></i>
                        <?php
                        if (isset($_GET['hebergement']) && $_GET['hebergement'] == 1) {
                            echo 'Détails de la Réservation';
                        } else {
                            echo 'Détails de l\'occupation';
                        }
                        ?>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <br/>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Date / Heure
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="date_res" id="datetimepicker6"
                                               value="<?php echo date('d/m/Y H:i:s'); ?>" required="required"
                                               class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Date prévue
                                        d'arrivée <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="date_arrive" id="datetimepickerOcc" required="required"
                                               class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Date prévue
                                        de sortie <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input name="date_sortie" id="datetimepickerLib"
                                               class="form-control col-md-7 col-xs-12" type="text">
                                    </div>
                                </div>
                                <div id="msg" class="alert alert-danger alert-dismissable" style="display:none;">
                                    <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
                                    <span id="msg_alert">Veuillez saisir les valeurs correctes dans tous les champs!</span>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <button name="suivant" id="suivant1" type="submit" class="btn btn-success"><i
                                                class=" fa fa-arrow-circle-right"></i> Suivant
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <!-- /.row (nested) -->
                        </div>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </form>
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<?php include 'modal_client_accomp.php'; ?>


<script src="../datepicker/jquery.js"></script>
<script src="../datepicker/jquery.datetimepicker.js"></script>
<script>
    $('#datetimepicker7').datetimepicker({format: 'd/m/Y'});
    $('#datetimepicker6_acc').datetimepicker({format: 'd/m/Y'});
    $('#datetimepicker6').datetimepicker();
    $('#datetimepickerOcc').datetimepicker();
    $('#datetimepickerLib').datetimepicker();
    $('#datetimepickerLib1').datetimepicker();
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
    });

</script>
<script type="text/javascript" src="js/bootstrap3-typeahead.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        //Initialisation Client occasionnel par defaut 
        $('#partenaire').val(1);
        function effacer() {

            $(':input', '#form_reservation').not(':button,:submit,:reset,:hidden,#datetimepicker6,#id_client,#id_client2,#accompagn_true,#accompagn_false')
                .val('')
                .removeAttr('checked')
                .removeAttr('selected');
        }

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
                        $('#nom_client22').text(': ' + data.nom_client);
                        $('#accompagn_true').show();
                        $('#accompagn_false').hide();
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
            $('#nom_client22').text(':');
            $('#accompagn_false').show();
            $('#accompagn_true').hide();
        });
        $('#ajax-select').change(function () {
            effacer();
            var client = $('.selectpicker option:selected').val();
            $('#partenaire').val(client);
        });
        $('#nom_client').keyup(function () {

            var search = $(this).val();
            var partenaire = $('#partenaire').val();
            search = $.trim(search);

            if (search !== "") {
                $.ajax({
                    url: 'data.php',
                    type: 'POST',
                    dataType: 'html',
                    data: 'search=' + search + "&partenaire=" + partenaire,
                    success: function (data) {
                        $('#resultat ul').html(data).show();

                        $('.lien').click(function (e) {
                            e.preventDefault();
                            var lien = $(this).text();
                            $('#nom_client').val(lien);
                            //  alert(lien);
                            $.ajax({
                                url: 'data_show.php',
                                type: 'POST',
                                dataType: 'json',
                                data: 'lien=' + lien,
                                success: function (data) {
                                    $('#id_client').val(data.id_client);
                                    from = data.date_naiss.split("-");
                                    f = from[2] + '/' + from[1] + '/' + from[0];

                                    $('#datetimepicker7').val(f);
                                    $('#nationalite_client').val(data.nationalite);
                                    $('#provenance_client').val(data.provenance);
                                    $('#sexe_client').val(data.sexe);
                                    $('#etat_civil_client').val(data.etat_civil);
                                    $('#num_piece_identite_client').val(data.piece);
                                    $('#num_passeport_client').val(data.passeport);
                                    $('#adresse_provenance_client').val(data.adresse);
                                    $('#telephone_client').val(data.tel);
                                    $('#email_client').val(data.email);
                                    $('#num_pers_contacter_client').val(data.autres);
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
                $('.disabled').val(' ');
                $('#id_client').val(0);
            }

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

    });
</script>

<script type="text/javascript" src="js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="js/ajax-bootstrap-select.js"></script>
<script>
    var options = {
        ajax: {
            url: 'ajax.php',
            type: 'POST',
            dataType: 'json',
            // Use "{{{q}}}" as a placeholder and Ajax Bootstrap Select will
            // automatically replace it with the value of the search query.
            data: {
                q: '{{{q}}}'
            }
        },
        locale: {
            emptyTitle: 'Client occasionnel'
        },
        log: 3,
        preprocessData: function (data) {
            var i, l = data.length, array = [];
            if (l) {
                for (i = 0; i < l; i++) {
                    array.push($.extend(true, data[i], {
                        text: data[i].Name,
                        value: data[i].Email,
                        data: {
//                            subtext: data[i].Email
                        }
                    }));
                }
            }
            // You must always return a valid array when processing data. The
            // data argument passed is a clone and cannot be modified directly.
            return array;
        }
    };

    $('.selectpicker').selectpicker().filter('.with-ajax').ajaxSelectPicker(options);
    $('select').trigger('change');
</script>


<!-- Authentification -->
<!--<script src="../js_auth/jquery.js"></script>-->
<script src="../Authentification/control_userAjax.js"></script>
<!-- Reservation -->
<script src="Traitement_reservation/verification_reservation.js"></script>
<script src="Traitement_reservation/script_paie.js"></script>

<?php // include('rec_footer.php'); ?>
