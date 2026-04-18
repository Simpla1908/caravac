<?php
session_start();
include './bdd/connexion.php';
include('../REC/Amelioration/reglage/recuperer_valeurs_reglages.php');
include('../FUNCTION/hebergement.php');
include('../FUNCTION/restaurant.php');
include('../FUNCTION/stock.php');
$LIEN = 'main.php?';
$_SESSION['facture'] = array();
$_SESSION['facture']['id'] = array();
$_SESSION['facture']['num'] = array();
$_SESSION['facture']['client'] = array();
$_SESSION['facture']['vendeur'] = array();
$_SESSION['facture']['date'] = array();
$_SESSION['facture']['mode'] = array();
$_SESSION['facture']['mont_paye'] = array();
$_SESSION['facture']['mont_tot'] = array();

$_SESSION['facture1'] = array();
$_SESSION['facture1']['id'] = array();
$_SESSION['facture1']['num'] = array();
$_SESSION['facture1']['client'] = array();
$_SESSION['facture1']['vendeur'] = array();
$_SESSION['facture1']['date'] = array();
$_SESSION['facture1']['mode'] = array();
$_SESSION['facture1']['mont_paye'] = array();
$_SESSION['facture1']['mont_tot'] = array();

$_SESSION['facture2'] = array();
$_SESSION['facture2']['id'] = array();
$_SESSION['facture2']['num'] = array();
$_SESSION['facture2']['client'] = array();
$_SESSION['facture2']['vendeur'] = array();
$_SESSION['facture2']['date'] = array();
$_SESSION['facture2']['mode'] = array();
$_SESSION['facture2']['mont_paye'] = array();
$_SESSION['facture2']['mont_tot'] = array();

$_SESSION['facture3'] = array();
$_SESSION['facture3']['id'] = array();
$_SESSION['facture3']['num'] = array();
$_SESSION['facture3']['client'] = array();
$_SESSION['facture3']['vendeur'] = array();
$_SESSION['facture3']['date'] = array();
$_SESSION['facture3']['mode'] = array();
$_SESSION['facture3']['mont_paye'] = array();
$_SESSION['facture3']['mont_tot'] = array();
$modes = ListMode($bdd);
$sous_sites = ListPosResto($_SESSION['id_hotel'], $bdd);

$_SESSION['cuisson'] = array();
$_SESSION['cuisson']['id'] = array();
$_SESSION['cuisson']['nom'] = array();
$_SESSION['cuisson']['etat'] = array();
$caisse = 0;
if (isset($_GET['caisse'])) {
    $caisse = 1;
}
?>

<!DOCTYPE html>
<html>

<head>
    <?php
    include './impot_css.php';
    ?>
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->

<body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">
        <?php include './impot_header3.php'; ?>
        <?php
        //            include('./POP-UP/action.php');
        ?>
        <div class="content-wrapper" id="blc_main">
            <div class="container" id="blc_main2">
                <?php include('./controllers/main2.php'); ?>
            </div>

            <div id="ModalUpdateDepense" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><strong>Depense </strong></h5>
                        </div>
                        <div class="modal-body">
                            <form role="form" action="#" method="post" id="FormDepense">

                                <input type="hidden" name="depense_id" id="depense_id" value="">
                                <div class="box-body">
                                    <div class="alert alert-danger alert-dismissible fade in hidden" role="alert" id="div_bkg_depense">
                                        <span id="sp_bkg_depense"></span>
                                    </div>
                                    <div class="row">

                                        <div class="col-lg-12">
                                            <div class="col-lg-12 form-group">
                                                <label>Libelle</label>
                                                <select name="libelle_id" class="form-control" style="width: 100%;" id="libelle_id">
                                                    <?php
                                                    $site_id = $_SESSION['id_hotel'];
                                                    $libelles = SelectLibelleDepense($site_id, $bdd);
                                                    foreach ($libelles as $l) {
                                                        $id = $l->id;
                                                        $designation = $l->designation;
                                                    ?>
                                                        <option value="<?php echo $id ?>"><?php echo $designation ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-lg-12 form-group cachebtn">
                                                <label>Description </label>
                                                <div class="form-group">
                                                    <textarea class="form-control mt" rows="1" id="motif" name="motif"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 form-group cachebtn hidden">
                                                <label>Date </label>
                                                <div class="form-group">
                                                    <input type="text" id="dte_dep" name="dte_dep" class="form-control text-left" value="<?php echo date('d/m/Y') ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-12 form-group cachebtn">
                                                <label>Montant <?php echo getsymbole_local(); ?> </label>
                                                <div class="input-group input-group">
                                                    <input type="text" id="montantcdf_depense" name="depcdf" class="form-control text-left mt " value="" onFocus="highlightActive(this);
                                                activeinput = this">
                                                    <span class="input-group-addon"><?php echo getsymbole_local(); ?></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 form-group cachebtn">
                                                <label>Montant <?php echo getsymbole_devise(); ?></label>
                                                <div class="input-group input-group">
                                                    <input type="text" id="montantusd_depense" name="depusd" class="form-control text-left mt" value="" onFocus="highlightActive(this);
                                                activeinput = this">
                                                    <span class="input-group-addon"><?php echo getsymbole_devise(); ?></span>
                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <!--                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" id="add_libelledep_btn">Valider</button>-->
                            <button type="button" class="btn btn-default btn_modal btn-lg" data-dismiss="modal">ANNULER</button>
                            <button type="button" class="btn btn-primary btn_modal btn-lg" id="btn_vld_depense_update">VALIDER</button>
                        </div>

                    </div>
                </div>
            </div>






            <!--Modal de paiement-->
            <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h5 class="modal-title" id="myModalLabel"><strong>Paiement : <span class="montant_fact"></span> soit <span class="mont_equivalent"></span></strong></h5>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger alert-dismissible fade in hidden" role="alert" id="div_message">
                                <span id="message"></span>
                            </div>
                            <form action="#" method="post" id="form" class="f_modal_paiement">
                                <input type="hidden" name="justification" id="justification" value="">
                                <input type="hidden" name="id_fact" id="id_fact" value="">
                                <input type="hidden" name="resch_id" id="resch_id" value="">
                                <input type="hidden" id="totrendu" name="totrendu" value="0">
                                <input type="hidden" name="montant_tot" id="montant_tot" value="">
                                <input type="hidden" name="lib_mode" id="lib_mode" value="Cash">
                                <div class="col-lg-12 form-group">
                                    <label>Mode de paiement</label>
                                    <select name="modepaiement" class="form-control select2" style="width: 100%;" id="mode">
                                        <?php
                                        foreach ($modes as $d) {
                                            if ($d->lib != 'Credit' && $d->lib != 'Don') {
                                        ?>
                                                <option value="<?php echo $d->id_mode_regl ?>"><?php echo $d->lib ?></option>
                                        <?php }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-lg-12 form-group cachebtn">
                                    <label>Montant <?php echo getsymbole_local(); ?> </label>
                                    <div class="input-group">
                                        <input type="text" id="montantcdf" name="montantcdf" class="form-control text-right montant mp22" value="">
                                        <span class="input-group-addon"><?php echo getsymbole_local(); ?></span>
                                    </div>
                                </div>
                                <div class="col-lg-12 form-group cachebtn">
                                    <label>Montant <?php echo getsymbole_devise(); ?></label>
                                    <div class="input-group">
                                        <input type="text" id="montantusd" name="montantusd" class="form-control text-right montant mp22" value="">
                                        <span class="input-group-addon"><?php echo getsymbole_devise(); ?></span>
                                    </div>
                                </div>
                                <div class="col-lg-12 form-group blrendu hidden">
                                    <div class="col-lg-6 form-group cachebtn">
                                        <label>Rendu <?php echo getsymbole_local(); ?> </label>
                                        <div class="input-group">
                                            <input type="text" id="rendu_cdf" name="rendu_cdf" class="form-control text-right rd11" value="0">
                                            <span class="input-group-addon"><?php echo getsymbole_local(); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 form-group cachebtn">
                                        <label>Rendu <?php echo getsymbole_devise(); ?> </label>
                                        <div class="input-group">
                                            <input type="text" id="rendu_usd" name="rendu_usd" class="form-control  text-right rd22 " value="0">
                                            <span class="input-group-addon"><?php echo getsymbole_devise(); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <br> <br> <br> <br> <br> <br><br> <br> <br> <br>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn_modal" data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary btn_modal" id="btn_vld_paiecredit2">Valider</button>
                            <button type="submit" class="btn btn-primary btn_modal" id="btn_vld_paiecredit3" style="display:none;">Valider</button>
                            <span class="btn btn-danger loader hidden">
                                <i class="fa fa-refresh fa-spin fa-1x"></i> exécution en cours, patientez!
                            </span>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.container -->




            <!--Modal de paiement fusion-->
            <div class="modal fade" id="myModalFusion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h5 class="modal-title" id="myModalLabelFusion"><strong>Paiement : <span class="montant_fact_f"></span> soit <span class="mont_equivalent_f"></span></strong></h5>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger alert-dismissible fade in hidden" role="alert" id="div_messageFusion">
                                <span id="message_f"></span>
                            </div>
                            <form action="#" method="post" id="form" class="f_modal_paiementFusion">
                                <input type="hidden" name="justification_f" id="justification_f" value="">
                                <input type="hidden" name="id_fact_f" id="id_fact_f" value="">
                                <input type="hidden" name="resch_id_f" id="resch_id_f" value="">
                                <input type="hidden" id="totrendu_f" name="totrendu_f" value="0">
                                <input type="hidden" name="montant_tot_f" id="montant_tot_f" value="">
                                <input type="hidden" name="montant_tot_f_usd" id="montant_tot_f_usd" value="8">

                                <input type="hidden" name="lib_mode_f" id="lib_mode_f" value="Cash">
                                <div class="col-lg-12 form-group">
                                    <label>Mode de paiement</label>
                                    <select name="modepaiement_f" class="form-control select2" style="width: 100%;" id="mode">
                                        <?php
                                        foreach ($modes as $d) {
                                            if ($d->lib != 'Credit' && $d->lib != 'Don') {
                                        ?>
                                                <option value="<?php echo $d->id_mode_regl ?>"><?php echo $d->lib ?></option>
                                        <?php }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-lg-12 form-group cachebtn">
                                    <label>Montant <?php echo getsymbole_local(); ?> </label>
                                    <div class="input-group">
                                        <input type="text" id="montantcdf_f" name="montantcdf_f" class="form-control text-right montant mp22" value="">
                                        <span class="input-group-addon"><?php echo getsymbole_local(); ?></span>
                                    </div>
                                </div>
                                <div class="col-lg-12 form-group cachebtn">
                                    <label>Montant <?php echo getsymbole_devise(); ?></label>
                                    <div class="input-group">
                                        <input type="text" id="montantusd_f" name="montantusd_f" class="form-control text-right montant mp22" value="">
                                        <span class="input-group-addon"><?php echo getsymbole_devise(); ?></span>
                                    </div>
                                </div>
                                <div class="col-lg-12 form-group blrendu hidden">
                                    <div class="col-lg-6 form-group cachebtn">
                                        <label>Rendu <?php echo getsymbole_local(); ?> </label>
                                        <div class="input-group">
                                            <input type="text" id="rendu_cdf_f" name="rendu_cdf_f" class="form-control text-right rd11" value="0">
                                            <span class="input-group-addon"><?php echo getsymbole_local(); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 form-group cachebtn">
                                        <label>Rendu <?php echo getsymbole_devise(); ?> </label>
                                        <div class="input-group">
                                            <input type="text" id="rendu_usd_f" name="rendu_usd_f" class="form-control  text-right rd22 " value="0">
                                            <span class="input-group-addon"><?php echo getsymbole_devise(); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <br> <br> <br> <br> <br> <br><br> <br> <br> <br>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn_modal" data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary btn_modal" id="btn_vld_paieFusion">Valider</button>
                            <span class="btn btn-danger loader hidden">
                                <i class="fa fa-refresh fa-spin fa-1x"></i> exécution en cours, patientez!
                            </span>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.container -->


            <div class="modal fade" id="myModalPaiementGlobal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h5 class="modal-title" id="myModalLabel"><strong>Paiement : <span class="montant_fact"></span> soit <span class="mont_equivalent"></span></strong></h5>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger alert-dismissible fade in hidden" role="alert" id="div_message_global">
                                <span id="message_global"></span>
                            </div>
                            <form action="#" method="post" id="form" class="f_modal_paiement_global">
                                <input type="hidden" id="totrendu" name="totrendu" value="0">
                                <input type="hidden" name="montant_tot" id="montant_tot_solde" value="">
                                <input type="hidden" name="client_id" id="client_id_extrait" value="">
                                <input type="hidden" name="name_customer" id="name_customer" value="">
                                <input type="hidden" name="lib_mode" id="lib_mode" value="Cash">
                                <input type="hidden" name="txoperation" id="txoperation" value="<?php echo $_SESSION['taux_resto'] ?>">
                                <div class="col-lg-12 form-group">
                                    <label>Mode de paiement</label>
                                    <select name="modepaiement" class="form-control select2" style="width: 100%;" id="mode">
                                        <?php
                                        foreach ($modes as $d) {
                                            if ($d->lib != 'Credit' && $d->lib != 'Don') {
                                        ?>
                                                <option value="<?php echo $d->id_mode_regl ?>"><?php echo $d->lib ?></option>
                                        <?php }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-lg-12 form-group cachebtn">
                                    <label>Montant <?php echo getsymbole_local(); ?> </label>
                                    <div class="input-group">
                                        <input type="text" id="montantcdf" name="montantcdf" class="form-control text-right montant mp22" value="">
                                        <span class="input-group-addon"><?php echo getsymbole_local(); ?></span>
                                    </div>
                                </div>
                                <div class="col-lg-12 form-group cachebtn">
                                    <label>Montant <?php echo getsymbole_devise(); ?></label>
                                    <div class="input-group">
                                        <input type="text" id="montantusd" name="montantusd" class="form-control text-right montant mp22" value="">
                                        <span class="input-group-addon"><?php echo getsymbole_devise(); ?></span>
                                    </div>
                                </div>
                                <div class="col-lg-12 form-group blrendu hidden">
                                    <div class="col-lg-6 form-group cachebtn">
                                        <label>Rendu <?php echo getsymbole_local(); ?> </label>
                                        <div class="input-group">
                                            <input type="text" id="rendu_cdf" name="rendu_cdf" class="form-control text-right rd11" value="0">
                                            <span class="input-group-addon"><?php echo getsymbole_local(); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 form-group cachebtn">
                                        <label>Rendu <?php echo getsymbole_devise(); ?> </label>
                                        <div class="input-group">
                                            <input type="text" id="rendu_usd" name="rendu_usd" class="form-control  text-right rd22 " value="0">
                                            <span class="input-group-addon"><?php echo getsymbole_devise(); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <br> <br> <br> <br> <br> <br><br> <br> <br> <br>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn_modal" data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary btn_modal" id="btn_vld_paiecredit3">Valider</button>
                            <span class="btn btn-danger loader hidden">
                                <i class="fa fa-refresh fa-spin fa-1x"></i> exécution en cours, patientez!
                            </span>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        </div>
        <!-- /.content-wrapper -->
    </div>
    <!-- jQuery 2.2.3 -->
    <!--<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>-->
    <script src="datepicker/jquery.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- page script -->
    <!--<script type="text/javascript" src="daterangepicker/jquery.min.js"></script>-->
    <script type="text/javascript" src="daterangepicker/moment-with-langs.min.js"></script>
    <script type="text/javascript" src="daterangepicker/daterangepicker.js"></script>
    <script type="text/javascript" src="js/resto.js"></script>
    <script type="text/javascript" src="js/scripts.js"></script>
    <script type="text/javascript" src="../js/paiement.js"></script>
    <script>
        moment.lang('fr');

        var pickerLocale = {
            applyLabel: 'OK',
            cancelLabel: 'Annuler',
            fromLabel: 'Entre',
            toLabel: 'et',
            customRangeLabel: 'Periode personnalisee',
            daysOfWeek: moment().lang()._weekdaysMin,
            monthNames: moment().lang()._months,
            firstDay: 0
        };

        var pickerRanges = {
            'Aujourd\'hui': [moment(), moment()],
            'Hier': [moment().subtract('days', 1), moment().subtract('days', 1)],
            '5 jours precedents': [moment().subtract('days', 4), moment().subtract('days', 1)],
            'Ce mois': [moment().startOf('month'), moment().endOf('month')],
            'Mois précedent': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
        };
        $(function() {
            $(".example1").DataTable();
            $(".tblsousfam").DataTable();
            $(".tblfam").DataTable();
            $(".tblplat").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
            $('#periode').daterangepicker({
                showDropdowns: false,
                ranges: pickerRanges,
                format: 'DD/MM/YYYY',
                separator: ' - ',
                locale: pickerLocale
            });
            $('#periode_heure').daterangepicker({
                startDate: moment().subtract('days', 1),
                endDate: moment(),
                showDropdowns: false,
                showWeekNumbers: true,
                timePicker: true,
                timePickerIncrement: 1,
                timePicker12Hour: false,
                ranges: pickerRanges,
                format: 'DD/MM/YYYY hh:mm',
                separator: ' - ',
                locale: pickerLocale
            });
            $('#date_simple').daterangepicker({
                startDate: moment(),
                format: 'DD/MM/YYYY',
                singleDatePicker: true,
                locale: pickerLocale
            });
        });

        $(function() {
            var url_def = './controllers/main2.php?';
            var url_def2 = 'main.php?';

            function effacer() {
                $(':input', '#formversement').not(':button,:submit,:reset,:hidden,\n\
                                       #user_id')
                    .val(0)
                    .removeAttr('checked')
                    .removeAttr('selected');
            }
            $("#blc_main").on('click', '#btn_regler_credit', function(e) {
                e.preventDefault();
                $('#div_message').addClass('hidden');
                var type_client = $("#type_client").val();
                if (type_client == 'occasionnel' || type_client == 'table') {
                    $('option[value="3"]').hide();
                } else {
                    $('option[value="3"]').show();
                }
                $('.montant_fact').text($('#montant_fact').val());
                $('.mont_equivalent').text($('#mont_equivalent').val());
                $('#montant_tot').val($('.montant_tot').val());
                $('#id_fact').val($('.id_fact').val());
                $('#resch_id').val($('.resch_id').val());
                $("#myModal3").modal('show');
                return false;
            });
            $("#blc_main").on('click', '#btn_regler_credit_line', function(e) {
                e.preventDefault();
                var idfact = $(this).attr("fact");
                $('#div_message').addClass('hidden');
                var type_client = $("#type_client").val();
                if (type_client == 'occasionnel' || type_client == 'table') {
                    $('option[value="3"]').hide();
                } else {
                    $('option[value="3"]').show();
                }
                $('.montant_fact').text($('#montant_fact' + idfact).val());
                $('.mont_equivalent').text($('#mont_equivalent' + idfact).val());
                $('#montant_tot').val($('.montant_tot' + idfact).val());
                $('#id_fact').val(idfact);
                $('#resch_id').val($('.resch_id' + idfact).val());
                $("#myModal3").modal('show');
                return false;
            });
            $("#blc_main").on('click', '#btn_vld_paiecredit', function(e) {
                e.preventDefault();
                //alert('2');
                var bool = false;
                var donnees = $('.f_modal_paiement').serialize();
                var urlpg = './controllers/main2.php?p=facture&d=regler5&ajx=1';
                $.ajax({
                    url: urlpg,
                    type: 'POST',
                    data: donnees,
                    beforeSend: function() {
                        $(".btn_modal").addClass('hidden');
                        $(".loader").removeClass('hidden');
                    },
                    success: function(data) {
                        //  alert(data);
                        if (data.succes) {
                            var id_fact = data.id_fact;
                            window.open('./impression/examples/rec.php');
                            $.ajax({
                                url: './controllers/main2.php?p=facture&d=details&ajx=1&id=' + id_fact,
                                type: 'POST',
                                success: function(html) {
                                    $("#blc_main2").empty().append(html);
                                    $(".montant").val('');
                                    $("#myModal3").modal('hide');
                                }
                            });
                        } else {
                            $('#message').text(data.message);
                            $('#div_message').removeClass('hidden').show().fadeOut(4000);
                        }
                        bool = true;
                    },
                    complete: function() {
                        if (bool) {
                            $(".loader").addClass('hidden');
                            $(".btn_modal").removeClass('hidden');
                        } else {
                            $(".loader").removeClass('hidden');
                        }
                    },
                    dataType: 'json'
                });
                return false;
            });
            $("#blc_main").on('click', '#btn_vld_paiecredit2', function(e) {
                e.preventDefault();
                //alert('2');
                var bool = false;
                var donnees = $('.f_modal_paiement').serialize();
                var urlpg = './controllers/main2.php?p=facture&d=regler5&ajx=1';
                $.ajax({
                    url: urlpg,
                    type: 'POST',
                    data: donnees,
                    beforeSend: function() {
                        $(".btn_modal").addClass('hidden');
                        $(".loader").removeClass('hidden');
                    },
                    success: function(data) {
                        //  alert(data);
                        if (data.succes) {
                            var id_fact = data.id_fact;
                            var datafrmfltr = $('.filter_frm').serialize();
                            var sousresto_id = $("#sousresto_id").val();
                            var nomclient = $('#idclient option:selected').text();
                            urlpg = './controllers/main2.php?p=facture&d=listeajx&ajx=1&credit=1&nomclient=' + nomclient + '& ss = ' + sousresto_id;
                            window.open('./impression/examples/rec.php');
                            $.ajax({
                                url: urlpg,
                                type: 'POST',
                                data: datafrmfltr,
                                success: function(data) {
                                    $("#alldatafact").empty().append(data);
                                    $(".example1").DataTable();
                                    $(".montant").val('');
                                    $("#myModal3").modal('hide');
                                }
                            });
                        } else {
                            $('#message').text(data.message);
                            $('#div_message').removeClass('hidden').show().fadeOut(4000);
                        }
                        bool = true;
                    },
                    complete: function() {
                        if (bool) {
                            $(".loader").addClass('hidden');
                            $(".btn_modal").removeClass('hidden');
                        } else {
                            $(".loader").removeClass('hidden');
                        }
                    },
                    dataType: 'json'
                });
                return false;
            });
            $("#blc_main").on('click', '#viewfact_btn', function(e) {
                e.preventDefault();
                var bool = false;
                var donnees = $('.filter_frm').serialize();
                var sousresto_id = $("#sousresto_id").val();
                var nomclient = $('#idclient option:selected').text();
                var urlpg = './controllers/main2.php?p=facture&d=listeajx&ajx=1&nomclient=' + nomclient + '& ss = ' + sousresto_id;
                $.ajax({
                    url: urlpg,
                    type: 'POST',
                    data: donnees,
                    beforeSend: function() {
                        $(".btn_modal").addClass('hidden');
                        $(".loader").removeClass('hidden');
                    },
                    success: function(data) {
                        $("#alldatafact").empty().append(data);
                        $(".example1").DataTable();
                        bool = true;
                    },
                    complete: function() {
                        if (bool) {
                            $(".loader").addClass('hidden');
                            $(".btn_modal").removeClass('hidden');
                        } else {
                            $(".loader").removeClass('hidden');
                        }
                    }
                    //                        ,dataType:'json'
                });
                return false;
            });


            $("#blc_main").on('click', '#verser_montant', function(e) {
                e.preventDefault();
                var bool = false;
                var donnees = $('#formversement').serialize();
                $.ajax({
                    url: './Traitement/versement.php',
                    type: 'POST',
                    data: donnees,
                    beforeSend: function() {
                        $(".loader").removeClass('hidden');
                        $("#verser_montant").addClass('hidden');
                    },
                    success: function(data) {
                        //                            alert(data);
                        if (data.message == 'usernoselect' || data.message == 'montantvide') {
                            $('#msg').show().fadeOut(4000)
                                .addClass('alert-danger')
                                .removeClass('alert-success');
                            $('#msg_alert').text('Veuilez remplir les champs vides!')
                        } else if (data.message == 'montantnocorrectcdf') {
                            $('#msg').show().fadeOut(4000)
                                .addClass('alert-danger')
                                .removeClass('alert-success');
                            $('#msg_alert').text("Le montant en CDF doit etre inferieur ou egal à " + data.mont);
                        } else if (data.message == 'montantnocorrectusd') {
                            $('#msg').show().fadeOut(4000)
                                .addClass('alert-danger')
                                .removeClass('alert-success');
                            $('#msg_alert').text("Le montant en USD doit etre inferieur ou egal à " + data.mont);
                        } else if (data.message == 'OK') {
                            $('#msg').show().fadeOut(4000)
                                .addClass('alert-danger')
                                .removeClass('alert-success');
                            $('#msg_alert').text('Versement effectué avec succes!')
                            effacer();
                            var donnees = '';
                            var urlpg = url_def + 'p=versement&d=listeajx&ajx=1';
                            $.ajax({
                                url: urlpg,
                                type: 'POST',
                                data: donnees,
                                success: function(data) {
                                    $('#alldatafact').empty().append(data);
                                    $(".example1").DataTable();
                                }
                            });
                            $("#myModal_versement").modal('hide');
                            window.open('./impression/examples/recu_repartition.php');
                        }
                        bool = true;
                    },
                    complete: function() {
                        if (bool) {
                            $(".loader").addClass('hidden');
                            $("#verser_montant").removeClass('hidden');
                        } else {
                            $(".loader").removeClass('hidden');
                        }
                    },
                    dataType: 'json'
                });
            });
            //versement js
            $("#blc_main").on('click', '#btn_vers', function(e) {
                e.preventDefault();
                var bool = false;
                var donnees = $('.filter_frm').serialize();
                var urlpg = url_def + 'p=versement&d=listeajx&ajx=1';
                $.ajax({
                    url: urlpg,
                    type: 'POST',
                    data: donnees,
                    beforeSend: function() {
                        $(".loader").removeClass('hidden');
                        $(".btn_vers").addClass('hidden');
                    },
                    success: function(data) {
                        $('#alldatafact').empty().append(data);
                        $(".example1").DataTable();
                        bool = true;
                    },
                    complete: function() {
                        if (bool) {
                            $(".loader").addClass('hidden');
                            $(".btn_vers").removeClass('hidden');
                        } else {
                            $(".loader").removeClass('hidden');
                        }
                    }
                });
            });
            //Plat js

            $("#ingred_id").change(onSelectChangeUnity);

            function onSelectChangeUnity() {
                var ingred_id = $("#ingred_id").val();
                var prix_ingred = $('#ingred_id option:selected').attr('pa');
                $.ajax({
                    url: 'Traitement/select_unite_ingred.php',
                    async: true,
                    type: 'POST',
                    data: "ingred_id=" + ingred_id,
                    global: false,
                    cache: false,
                    success: function(html) {
                        $("#unite_ingred").empty().append(html);
                        $('#prix_ingred').val(prix_ingred);

                    }
                });
            }
            $("#accomp_id").change(onSelectChangeUnity2);

            function onSelectChangeUnity2() {
                var accomp_id = $("#accomp_id").val();
                $.ajax({
                    url: 'Traitement/select_unite_ingred.php',
                    async: true,
                    type: 'POST',
                    data: "ingred_id=" + accomp_id,
                    global: false,
                    cache: false,
                    success: function(html) {
                        $("#unite_accomp").empty().append(html);
                    }
                });
            }
            $("#add_ingred").click(function() {
                var selected = $("#ingred_id option:selected");
                var ingred_id = selected.val();
                var ingred_name = selected.text();
                var utite = $("#unite_ingred").val();
                var qte = $("#qte_ingred").val();
                var prix = $("#prix_ingred").val();

                $.ajax({
                    url: 'Traitement/tableau_fiche_tech.php',
                    async: true,
                    type: 'POST',
                    data: "ingred_id=" + ingred_id + "&ingred_name=" + ingred_name + "&utite=" + utite + "&qte=" + qte + "&prix=" + prix,
                    global: false,
                    cache: false,
                    success: function(data) {
                        $("#fiche_technique").empty().html(data);
                        //                            $("#myModaladdFch").modal('hide');
                        //                            $("#qte_ingred").val('');
                    }
                });
            });
            $("#btn_accomp").click(function() {
                var selected = $("#accomp_id option:selected");
                var accomp_id = selected.val();
                var accomp_name = selected.text();
                var unite_accomp = $("#unite_accomp").val();
                var qte_accomp = $("#qte_accomp").val();
                $.ajax({
                    url: 'Traitement/tableau_accompagnement.php',
                    async: true,
                    type: 'POST',
                    data: "accomp_id=" + accomp_id + "&accomp_name=" + accomp_name + "&unite_accomp=" + unite_accomp + "&qte_accomp=" + qte_accomp,
                    global: false,
                    cache: false,
                    success: function(data) {
                        $("#accompagnement").empty().html(data);

                    }
                });
            });
            $('#btn_supp').click(function(e) {
                var donnees = '';
                var ingred_id;
                var supprimer = 'OK';
                $('.ch_ingred:checked').each(function(i) {
                    ingred_id = $(this).val();
                    $.ajax({
                        url: 'Traitement/tableau_fiche_tech.php?ingred_id=' + ingred_id + "&supprimer=" + supprimer,
                        type: 'POST',
                        data: donnees,
                        success: function(data) {
                            $("#fiche_technique").empty().html(data);
                        }
                    });

                });
                return false;
            });
            $('#btn_suppACC').click(function(e) {
                var donnees = '';
                var accomp_id;
                var supprimer = 'OK';
                $('.ch_accomp:checked').each(function(i) {
                    accomp_id = $(this).val();
                    $.ajax({
                        url: 'Traitement/tableau_accompagnement.php?accomp_id=' + accomp_id + "&supprimer=" + supprimer,
                        type: 'POST',
                        data: donnees,
                        success: function(data) {
                            // alert(data);
                            $("#accompagnement").empty().html(data);
                        }
                    });

                });
                return false;
            });
            $("#fiche_technique").on('mouseout', '.qte_prod', function() {
                var donnees = '';
                var ingred_id = $(this).attr('id');
                var qte_produit = $(this).val();
                var modifier = 'OK';
                $.ajax({
                    url: 'Traitement/tableau_fiche_tech.php?ingred_id=' + ingred_id + "&modifier=" + modifier + "&qte_produit=" + qte_produit,
                    type: 'POST',
                    data: donnees,
                    success: function(data) {
                        $("#fiche_technique").empty().html(data);
                    }
                });
                return false;
            });
            $("#accompagnement").on('mouseout', '.qte_prodACC', function() {
                var donnees = '';
                var accomp_id = $(this).attr('id');
                var qte_produit = $(this).val();
                var modifier = 'OK';
                $.ajax({
                    url: 'Traitement/tableau_accompagnement.php?accomp_id=' + accomp_id + "&modifier=" + modifier + "&qte_produit=" + qte_produit,
                    type: 'POST',
                    data: donnees,
                    success: function(data) {
                        //   alert(data);
                        $("#accompagnement").empty().html(data);
                    }
                });
                return false;
            });
            var k = 1;
            $('#save_sous_famille').click(function(e) {
                e.preventDefault();
                var donnees = $('#form_sfam').serialize();
                var bool = false;
                $.ajax({
                    url: 'Traitement/sous_famille_insertion.php',
                    type: 'POST',
                    data: donnees,
                    beforeSend: function() {
                        $("#loader_sfam").removeClass('hidden');
                        $("#save_sous_famille").addClass('hidden');
                    },
                    success: function(data) {
                        bool = true;
                        if (data.message_succes == 'succes') {
                            $('#designation_sfam').val(' ');
                            $('#famille_sfam_id').val(' ');
                            $('#msg2').show().fadeOut(4000)
                                .addClass('alert-success')
                                .removeClass('alert-danger');
                            $('#msg_alert2').text("L'enrégistrement s'est effectué avec succès!");
                            var urlpg = url_def + 'p=plat&d=majsfam&ajx=1&ss=' + data.id_sousresto;
                            $.ajax({
                                url: urlpg,
                                type: 'POST',
                                success: function(html) {
                                    $("#view_sousfamille").empty().append(html);
                                    $(".example1").DataTable();
                                }
                            });

                        } else if (data.message_erreur == 'erreur') {
                            $('#msg2').show()
                                .addClass('alert-danger')
                                .removeClass('alert-success');
                            $('#msg_alert2').text("Cette designation " + data.des_value + " de la sous famille existe déjà")
                        } else if (data.message_vide == 'vide') {
                            $('#msg2').show().fadeOut(4000)
                                .addClass('alert-danger')
                                .removeClass('alert-success');
                            $('#msg_alert2').text('Veuilez remplir les champs vides!')

                        }

                    },
                    complete: function() {
                        if (bool) {
                            $("#loader_sfam").addClass('hidden');
                            $("#save_sous_famille").removeClass('hidden');
                        } else {
                            $("#loader_sfam").removeClass('hidden');
                            $("#save_sous_famille").addClass('hidden');
                        }
                    },
                    dataType: 'json'
                });

            });
            $('#save_fam').click(function(e) {
                e.preventDefault();
                var donnees = $('#formfam').serialize();
                var bool;
                $.ajax({
                    url: './Traitement/famille_insertion.php',
                    type: 'POST',
                    data: donnees,
                    beforeSend: function() {
                        $("#loader_fam").removeClass('hidden');
                        $("#save_fam").addClass('hidden');
                    },
                    success: function(data) {
                        bool = true;
                        if (data.message_succes == 'succes') {
                            $('#designation').val(' ');
                            $('#msg1').show().fadeOut(4000)
                                .addClass('alert-success')
                                .removeClass('alert-danger');
                            $('#msg_alert1').text("L'enrégistrement s'est effectué avec succès!");
                            var pos_id = data.pos_id;
                            var urlpg = url_def + 'p=plat&d=majfam&ajx=1&ss=' + pos_id;
                            $.ajax({
                                url: urlpg,
                                type: 'POST',
                                success: function(html) {
                                    $("#view_famille").empty().append(html);
                                    $(".tblfam").DataTable();
                                }
                            });
                        } else if (data.message_erreur == 'erreur') {
                            $('#msg1').show()
                                .addClass('alert-danger')
                                .removeClass('alert-success');
                            $('#msg_alert1').text("Cette famille existe déjà!")
                        } else if (data.message_vide == 'vide') {
                            $('#msg1').show().fadeOut(4000)
                                .addClass('alert-danger')
                                .removeClass('alert-success');
                            $('#msg_alert1').text('Veuilez remplir les champs vides!')

                        }

                    },
                    complete: function() {
                        if (bool) {
                            $("#loader_fam").addClass('hidden');
                            $("#save_fam").removeClass('hidden');
                        } else {
                            $("#loader_fam").removeClass('hidden');
                            $("#save_fam").addClass('hidden');
                        }
                    },
                    dataType: 'json'
                });
                $('#famille_id').empty();
                $('#famille_sfam_id').empty();
                $.ajax({
                    url: './Traitement/famille_combo.php',
                    dataType: 'json',
                    success: function(json) {
                        $.each(json, function(index, value) {
                            $('#famille_id').append('<option value="' + index + '">' + value + '</option>');
                        });
                    }
                });
            });
            $("#famille_id").change(onSelectChange);

            function onSelectChange() {
                var idfamille = $("#famille_id").val();
                $.ajax({
                    url: 'Traitement/requete_s_famille.php',
                    async: true,
                    type: 'POST',
                    data: "idfamille=" + idfamille,
                    global: false,
                    cache: false,
                    success: function(html) {
                        $("#s_famille_id").empty().append(html);
                    }
                });
            }


            $('#form_insert_plat').unbind('submit').bind('submit', function() {
                var form = $(this);
                var formData = new FormData($(this)[0]);
                var bool = false;
                var pos_id = $('#pos_id').val();

                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: formData,
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    async: false,
                    beforeSend: function() {
                        $(".loader").removeClass('hidden');
                        $("#save_produit").addClass('hidden');
                    },
                    success: function(data) {
                        bool = true;
                        //alert(data);
                        if (data.message_succes == 'succes') {
                            $('#msg').show().fadeOut(4000)
                                .addClass('alert-success')
                                .removeClass('alert-danger');
                            $('#msg_alert').text("L'enrégistrement s'est effectué avec succès!");
                            $("#code").val(' ');
                            $("#libelle").val(' ');
                            $(".prix_vente_site").val(' ');
                            $("#fiche_technique").empty();
                            var urlpg = url_def + 'p=plat&d=majplat&ajx=1&ss=' + pos_id;
                            $.ajax({
                                url: urlpg,
                                type: 'POST',
                                success: function(html) {
                                    $("#view_plat").empty().append(html);
                                    $(".tblplat").DataTable();
                                }
                            });

                        } else if (data.message_erreur == 'erreur') {
                            $('#msg').show()
                                .addClass('alert-danger')
                                .removeClass('alert-success');
                            $('#msg_alert').text("Le code ou la désignation du produit saisi existe déjà")
                        } else if (data.message_vide == 'vide') {
                            $('#msg').show().fadeOut(4000)
                                .addClass('alert-danger')
                                .removeClass('alert-success');
                            $('#msg_alert').text('Veuilez remplir les champs vides!')

                        } else if (data.message_prix == 'nocorrect') {
                            $('#msg').show().fadeOut(4000)
                                .addClass('alert-danger')
                                .removeClass('alert-success');
                            $('#msg_alert').text("Le prix de vente n'est pas correct!")

                        }

                    },
                    complete: function() {
                        if (bool) {
                            $(".loader").addClass('hidden');
                            $("#save_produit").removeClass('hidden');
                        } else {
                            $(".loader").removeClass('hidden');
                            $("#save_produit").addClass('hidden');
                        }
                    }
                });

                return false;
            });


            $('#form_update_plat').unbind('submit').bind('submit', function() {
                var form = $(this);
                var formData = new FormData($(this)[0]);

                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: formData,
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    async: false,
                    beforeSend: function() {
                        $("#loader").removeClass('hidden');
                        $("#update_produit").addClass('hidden');
                    },
                    success: function(data) {
                        bool = true;
                        if (data.message_succes == 'succes') {
                            $("#famille_id").val(' ');
                            $("#s_famille_id").val(' ');
                            $("#code").val(' ');
                            $("#unite").val(' ');
                            $("#libelle").val(' ');
                            $(".prix_vente_site").val(' ');
                            $("#fiche_technique").empty();
                            $('#msg').show().fadeOut(6000)
                                .addClass('alert-success')
                                .removeClass('alert-danger');
                            $('#msg_alert').text("La mise a jour s'est effectué avec succès! Patientez...");
                            window.location.href = url_def2 + "p=plat&d=liste&ss=" + data.id_sousresto;
                        } else if (data.message_erreur == 'erreur') {
                            $('#msg').show()
                                .addClass('alert-danger')
                                .removeClass('alert-success');
                            $('#msg_alert').text("Ce code " + data.code_value + " du produit saisi existe déjà")
                        } else if (data.message_vide == 'vide') {
                            $('#msg').show().fadeOut(6000)
                                .addClass('alert-danger')
                                .removeClass('alert-success');
                            $('#msg_alert').text('Veuilez remplir les champs vides!')

                        } else if (data.message_prix == 'nocorrect') {
                            $('#msg').show().fadeOut(4000)
                                .addClass('alert-danger')
                                .removeClass('alert-success');
                            $('#msg_alert').text("Le prix de vente n'est pas correct!")

                        }

                    },
                    complete: function() {
                        if (bool) {
                            $("#loader").addClass('hidden');
                            $("#update_produit").removeClass('hidden');
                        } else {
                            $("#loader").removeClass('hidden');
                            $("#update_produit").addClass('hidden');
                        }
                    }
                });

                return false;
            });

            $('#update_famille').click(function(e) {
                e.preventDefault();
                var donnees = $('#formfamEdit').serialize();
                var bool = false;
                $.ajax({
                    url: 'Traitement/fam_modifier.php',
                    type: 'POST',
                    data: donnees,
                    beforeSend: function() {
                        $("#loader_fam").removeClass('hidden');
                        $("#update_famille").addClass('hidden');
                    },
                    success: function(data) {
                        bool = true;
                        if (data.message_succes == 'succes') {
                            $('#designation').val(' ');
                            $('#msg1').show().fadeOut(6000)
                                .addClass('alert-success')
                                .removeClass('alert-danger');
                            $('#msg_alert1').text("La mise a jour s'est effectué avec succès! Patientez...");
                            window.location.href = url_def2 + "p=plat&d=liste&ss=" + data.id_sousresto;
                        } else if (data.message_erreur == 'erreur') {
                            $('#msg1').show()
                                .addClass('alert-danger')
                                .removeClass('alert-success');
                            $('#msg_alert1').text("Cette designation " + data.des_value + " de la famille existe déjà")
                        } else if (data.message_vide == 'vide') {
                            $('#msg1').show().fadeOut(6000)
                                .addClass('alert-danger')
                                .removeClass('alert-success');
                            $('#msg_alert1').text('Veuilez remplir les champs vides!')
                        }

                    },
                    complete: function() {
                        if (bool) {
                            $("#loader_fam").addClass('hidden');
                            $("#update_famille").removeClass('hidden');
                        } else {
                            $("#loader_fam").removeClass('hidden');
                            $("#update_famille").addClass('hidden');
                        }
                    },
                    dataType: 'json'
                });
            });
            $('#update_s_famille').click(function(e) {
                e.preventDefault();
                var donnees = $('#form_sfam').serialize();
                var bool = false;
                $.ajax({
                    url: 'Traitement/s_fam_modifier.php',
                    type: 'POST',
                    data: donnees,
                    beforeSend: function() {
                        $("#loader_sfam").removeClass('hidden');
                        $("#update_s_famille").addClass('hidden');
                    },
                    success: function(data) {
                        bool = true;
                        if (data.message_succes == 'succes') {
                            $('#designation').val(' ');
                            $('#famille_id').val(' ');
                            $('#msg2').show().fadeOut(8000)
                                .addClass('alert-success')
                                .removeClass('alert-danger');
                            $('#msg_alert2').text("La mise a jour s'est effectué avec succès! Patientez...");
                            window.location.href = url_def2 + "p=plat&d=liste&ss=" + data.id_sousresto;
                        } else if (data.message_erreur == 'erreur') {
                            $('#msg2').show()
                                .addClass('alert-danger')
                                .removeClass('alert-success');
                            $('#msg_alert2').text("Cette designation " + data.des_value + " de la sous famille existe déjà")
                        } else if (data.message_vide == 'vide') {
                            $('#msg2').show().fadeOut(8000)
                                .addClass('alert-danger')
                                .removeClass('alert-success');
                            $('#msg_alert2').text('Veuilez remplir les champs vides!')
                        }
                    },
                    complete: function() {
                        if (bool) {
                            $("#loader_sfam").addClass('hidden');
                            $("#update_s_famille").removeClass('hidden');
                        } else {
                            $("#loader_sfam").removeClass('hidden');
                            $("#update_s_famille").addClass('hidden');
                        }
                    },
                    dataType: 'json'
                });

            });
            $("#blc_main").on('click', '.del_art', function(e) {
                e.preventDefault();
                var id = $(this).attr('id');
                var p = $(this).attr('p');
                var d = $(this).attr('d');
                var ss = $(this).attr('ss');
                var maj = $(this).attr('maj');
                var view = $(this).attr('view');
                var tbl = $(this).attr('tbl');
                $("#id_art").val(id);
                $("#p").val(p);
                $("#d").val(d);
                $("#ss").val(ss);
                $("#maj").val(maj);
                $("#view").val(view);
                $("#tbl").val(tbl);
            });
            $("#blc_main").on('click', '.btn_delete', function(e) {
                e.preventDefault();
                var bool = false;
                var id = $("#id_art").val();
                var p = $("#p").val();
                var d = $("#d").val();
                var ss = $("#ss").val();
                var maj = $("#maj").val();
                var view = $("#view").val();
                var tbl = $("#tbl").val();
                var donnees = '';
                var urlpg = url_def + 'p=' + p + '&d=' + d + '&ajx=1&ss=' + ss + '&id=' + id;
                $.ajax({
                    url: urlpg,
                    type: 'POST',
                    data: donnees,
                    beforeSend: function() {
                        $("#loader").removeClass('hidden');
                        $(".btdl").addClass('hidden');
                    },
                    success: function(data) {
                        bool = true;
                        if (data.s) {
                            var urlpg = url_def + 'p=' + p + '&d=' + maj + '&ajx=1&ss=' + ss;
                            $.ajax({
                                url: urlpg,
                                type: 'POST',
                                success: function(html) {
                                    $(view).empty().append(html);
                                    $(tbl).DataTable();
                                }
                            });
                            $("#myModalSupp").modal('hide');

                        }
                    },
                    complete: function() {
                        if (bool) {
                            $("#loader").addClass('hidden');
                            $(".btdl").removeClass('hidden');
                        } else {
                            $("#loader").removeClass('hidden');
                            $(".btdl").addClass('hidden');
                        }
                    },
                    dataType: 'json'
                });
            });
            $("#blc_main").on('click', '.btn_reprint_recu', function(e) {
                e.preventDefault();
                var bool = false;
                var donnees = '';
                var id = $(this).attr('id');
                var urlpg = url_def + 'p=facture&d=recu&ajx=1&id=' + id;
                $.ajax({
                    url: urlpg,
                    type: 'POST',
                    data: donnees,
                    success: function(data) {
                        window.open('./impression/examples/rec.php');
                    }
                });
            });
            $("#blc_main").on('click', '.btn_extcpte', function(e) {
                e.preventDefault();
                var bool = false;
                var donnees = '';
                var id = $(this).attr('id');
                var urlpg = url_def + 'p=facture&d=extcpte&ajx=1&id=' + id;
                $.ajax({
                    url: urlpg,
                    type: 'POST',
                    data: donnees,
                    success: function(data) {
                        window.open('./impression/examples/extcpte.php');
                    }
                });
            });

            $('.quantite_change').keyup(function(e) {
                e.preventDefault();
                var id = $(this).attr("validate");
                var qte2 = $("#qteR" + id).val();
                var qte1 = $("#qteE" + id).val();
                var dif = qte1 - qte2;
                $("#ecrat" + id).text(dif);
            });
            $('#appro_validate').click(function(e) {
                e.preventDefault();
                var bool = false;
                var donnees = $('#form').serialize();
                var url = 'Traitement/appro_validation.php';
                var datacontent = '#navigationcontent';
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: donnees,
                    beforeSend: function() {
                        $("#loader").removeClass('hidden');
                        $("#appro_validate").addClass('hidden');
                    },
                    success: function(data) {
                        $(datacontent).empty().append(data);
                        //alert(data);
                        bool = true;
                        if (data.message_erreur == 'yes') {
                            $('#msg_grp').empty().append('Veuillez entrer les valeurs correctes!').show().fadeOut(4000);
                        } else if (data.message_erreur == 'no') {
                            location.href = 'pages_actions.php?page=fiche';
                            // $('#msg_grp').empty().append('Approbation effectuée avec succes').show().fadeOut(10000);
                        }

                    },
                    complete: function() {
                        if (bool) {
                            $("#loader").addClass('hidden');
                            $("#appro_validate").removeClass('hidden');
                        } else {
                            $("#loader").removeClass('hidden');
                        }
                    },
                    dataType: 'json'
                });

            });
            //fdc js
            $("#blc_main").on('click', '#filtrer_fdc', function(e) {
                e.preventDefault();
                var bool = false;
                var donnees = $('.filter_frm').serialize();
                var urlpg = url_def + 'p=fdc&d=listeajx&ajx=1';
                $.ajax({
                    url: urlpg,
                    type: 'POST',
                    data: donnees,
                    beforeSend: function() {
                        $(".loader").removeClass('hidden');
                        $(".filtrer_fdc").addClass('hidden');
                    },
                    success: function(data) {
                        //alert(data);
                        $('#alldata').empty().append(data);
                        $(".example1").DataTable();
                        bool = true;
                    },
                    complete: function() {
                        if (bool) {
                            $(".loader").addClass('hidden');
                            $(".filtrer_fdc").removeClass('hidden');
                        } else {
                            $(".loader").removeClass('hidden');
                        }
                    }
                });
            });
            $("#blc_main").on('click', '.modifierfdc', function(e) {
                e.preventDefault();
                var id = $(this).attr('idfdc');
                $('.txtfdc' + id).hide();
                $('.inputfdc' + id).show();
                $('.modifierfdc' + id).hide();
                $('.validerfdc' + id).show();

            });
            $("#blc_main").on('click', '.validerfdc', function(e) {
                e.preventDefault();
                var id = $(this).attr('id');
                var montusd = $('#montant_usd' + id).val();
                var montcdf = $('#montant_cdf' + id).val();
                var motif = $('#fdcmotif' + id).val();
                var periode = $('#periode').val();

                $.ajax({
                    url: 'Traitement/maj_fondcaisse.php',
                    type: 'POST',
                    data: "id=" + id + "&montusd=" + montusd + "&montcdf=" + montcdf + "&periode=" + periode + "&motif=" + motif,
                    success: function(data) {
                        if (data.message == 'succes') {
                            $('#fondusd' + id).empty().append(data.fondusdaff);
                            $('#fondcdf' + id).empty().append(data.fondcdfaff);
                            $('#totusd').empty().append(data.tfond_usd);
                            $('#totcdf').empty().append(data.tfond_cdf);
                            $('#montant_usd' + id).val(data.fondusd);
                            $('#montant_cdf' + id).val(data.fondcdf);
                            $('#motif' + id).html(data.motif);
                            $('.txtfdc' + id).show();
                            $('.inputfdc' + id).hide();
                            $('.modifierfdc' + id).show();
                            $('.validerfdc' + id).hide();
                            $('#msgcl').show().fadeOut(4000)
                                .addClass('alert-success')
                                .removeClass('alert-danger');
                            $('#msgcl_alert').text("Modification effectuée avrec succès!")
                        } else if (data.message == 'vide') {
                            $('#msgcl').show().fadeOut(4000)
                                .addClass('alert-danger')
                                .removeClass('alert-success');
                            $('#msgcl_alert').text('Valeurs incorrectes!')

                        }

                    },
                    dataType: 'json'
                });


            });
            $("#blc_main").on('click', '.modal_versement', function(e) {
                e.preventDefault();
                var donnees = '';
                var method = 'POST';
                var url = './Traitement/dataspopup.php';
                $.ajax({
                    url: url,
                    type: method,
                    data: donnees,
                    success: function(data) {
                        $('#myModal_versement').html(data);
                        $("#myModal_versement").modal('show');

                    }

                });
            });

            $("#blc_main").on('click', '.composant_plat', function(e) {
                e.preventDefault();
                var genre = $(this).attr('genre');
                if (genre == 'FCH') {
                    $('#addFCH').show();
                    $('#addACC').hide();
                    $('#addcuis').hide();
                    $('#addsauc').hide();
                } else if (genre == 'CUISS') {
                    $('#addcuis').show();
                    $('#addACC').hide();
                    $('#addFCH').hide();
                    $('#addsauc').hide();
                } else if (genre == 'SAUC') {
                    $('#addsauc').show();
                    $('#addACC').hide();
                    $('#addFCH').hide();
                    $('#addcuis').hide();
                } else {
                    $('#addACC').show();
                    $('#addFCH').hide();
                    $('#addsauc').hide();
                    $('#addcuis').hide();
                }

            });
            $("#alldatafact").on('click', '#add_libelledep_btn', function(e) {
                var donnees = $('.pers_frm').serialize();
                var urlpg = url_def + 'p=depense&d=addlibelle&ajx=1';
                var method = 'POST';
                $.ajax({
                    url: urlpg,
                    type: method,
                    data: donnees,
                    success: function(data) {
                        if (data.s) {
                            $("#notifpers").show()
                                .removeClass('hidden callout-danger')
                                .addClass('callout-success')
                                .html(data.message);
                            $("#notifpers").fadeOut(4000);
                            $(".npers").val('');

                        } else {
                            $("#notifpers").show().removeClass('hidden callout-success')
                                .addClass('callout-danger')
                                .html(data.message);
                            $("#notifpers").fadeOut(4000);
                        }
                    }
                    //                    , dataType: 'json'
                });
            });
            $("#blc_main").on('click', '.annulerfusionbtn', function(e) {
                e.preventDefault();
                var bool = false;
                var donnees = $('.filter_frm').serialize();
                var sousresto_id = $("#sousresto_id").val();
                var id = $(this).attr('id');
                var urlpg = './controllers/main2.php?p=facture&d=annulerfusion&ajx=1&ss=' + sousresto_id + '&id=' + id;
                $.ajax({
                    url: urlpg,
                    type: 'POST',
                    data: donnees,
                    beforeSend: function() {
                        $(".btn_modal").addClass('hidden');
                        $(".loader").removeClass('hidden');
                    },
                    success: function(data) {
                        $("#alldatafact").empty().append(data);
                        $(".example1").DataTable();
                        bool = true;
                    },
                    complete: function() {
                        if (bool) {
                            $(".loader").addClass('hidden');
                            $(".btn_modal").removeClass('hidden');
                        } else {
                            $(".loader").removeClass('hidden');
                        }
                    }
                    //                        ,dataType:'json'
                });
                return false;
            });
            $(".BtnPaieFusion").click(function(e) {
                e.preventDefault();
                var id_fact = $(this).attr('id_fact');
                var montant_tot = $(this).attr('montant_tot');
                var montant_tot_aff = $(this).attr('montant_tot_aff');
                var mont_tot_eq = $(this).attr('mont_tot_eq');
                var mont_tot_eq_aff = $(this).attr('mont_tot_eq_aff');
                $(".montant_fact_f").empty().append(montant_tot_aff);
                $(".mont_equivalent_f").empty().append(mont_tot_eq_aff);
                $("#montant_tot_f").val(mont_tot_eq);
                $("#montant_tot_f_usd").val(montant_tot);
                $("#id_fact_f").val(id_fact);
                $("#myModalFusion").modal('show');
                return false;
            });
            $("#blc_main").on('click', '#btn_extrait', function(e) {
                e.preventDefault();
                var donnees = $('#frm_extrait_compte').serialize();
                var method = 'POST';
                var nomclient = $('#idclient option:selected').text();
                var url = './controllers/main2.php?p=extrait&d=verifextrait&ajx=1';
                $.ajax({
                    url: url,
                    type: method,
                    data: donnees,
                    success: function(data) {
                        // alert(data);
                        if (data.s) {
                            url = './controllers/main2.php?p=extrait&d=listeajx&ajx=1&nomclient=' + nomclient;
                            $.ajax({
                                url: url,
                                type: method,
                                data: donnees,
                                success: function(data) {
                                    $('#datasextrait').empty().append(data);
                                }
                            });
                        } else {
                            $('#alertextrait2').text(data.message);
                            $('#alertextrait1').removeClass('hidden').show().fadeOut(4000);
                        }
                    },
                    dataType: 'json'
                });
            });
            $("#blc_main").on('click', '.btn_prnt_extrcompte', function(e) {
                e.preventDefault();
                var id = $(this).attr("id");
                var d1 = $(this).attr("d1");
                var d2 = $(this).attr("d2");
                var n = $(this).attr("n");
                var url = './impression/examples/extraitcompte.php?id=' + id + '&d1=' + d1 + '&d2=' + d2 + '&n=' + n;
                window.open(url);
            });
            $("#blc_main").on('click', '.btn_prnt_extrcompte_all', function(e) {
                e.preventDefault();
                var d1 = $(this).attr("d1");
                var d2 = $(this).attr("d2");
                var url = './impression/examples/extraitcompteall.php?d1=' + d1 + '&d2=' + d2;
                window.open(url);
            });
            $("#blc_main").on('click', '#btn_vld_paieFusion', function(e) {
                e.preventDefault();
                //                    alert('Vanes');
                var bool = false;
                var donnees = $('.f_modal_paiementFusion').serialize();
                var urlpg = './controllers/main2.php?p=facture&d=reglerfusion&ajx=1';
                $.ajax({
                    url: urlpg,
                    type: 'POST',
                    data: donnees,
                    beforeSend: function() {
                        $(".btn_modal_f").addClass('hidden');
                        $(".loader_f").removeClass('hidden');
                    },
                    success: function(data) {
                        //                           alert(data);
                        if (data.succes) {
                            $("#myModalFusion").modal('hide');
                            var bool = false;
                            var donnees = $('.filter_frm').serialize();
                            var sousresto_id = $("#sousresto_id").val();
                            var urlpg = './controllers/main2.php?p=facture&d=listeajx&ajx=1&ss=' + sousresto_id;
                            $.ajax({
                                url: urlpg,
                                type: 'POST',
                                data: donnees,
                                beforeSend: function() {
                                    $(".btn_modal").addClass('hidden');
                                    $(".loader").removeClass('hidden');
                                },
                                success: function(data) {
                                    $("#alldatafact").empty().append(data);
                                    $(".example1").DataTable();
                                    bool = true;
                                },
                                complete: function() {
                                    if (bool) {
                                        $(".loader").addClass('hidden');
                                        $(".btn_modal").removeClass('hidden');
                                    } else {
                                        $(".loader").removeClass('hidden');
                                    }
                                }
                            });

                        } else {
                            $('#message_f').text(data.message);
                            $('#div_messageFusion').removeClass('hidden').show().fadeOut(4000);
                        }
                        bool = true;
                    },
                    complete: function() {
                        if (bool) {
                            $(".loader_f").addClass('hidden');
                            $(".btn_modal_f").removeClass('hidden');
                        } else {
                            $(".loader_f").removeClass('hidden');
                        }
                    },
                    dataType: 'json'
                });
                return false;
            });
            $("#fich_sfamid").change(onSelectChangefchtech);

            function onSelectChangefchtech() {
                var fich_sfamid = $("#fich_sfamid").val();
                var urlpg = url_def + 'p=plat&d=majviewfiche&ajx=1&fich_sfamid=' + fich_sfamid;
                $.ajax({
                    url: urlpg,
                    type: 'POST',
                    success: function(data) {
                        $("#view_fiche_technic").empty().append(data);
                    }
                });


            }
            $("#blc_main").on('click', '#print_fich_tech', function(e) {
                e.preventDefault();
                var fich_sfamid = $("#fich_sfamid").val();
                var url = './impression/examples/fiches_techniques.php?fich_sfamid=' + fich_sfamid;
                window.open(url);
            });

            function deconnexionAuto() {
                setTimeout(function() {
                    $.ajax({
                        url: 'Traitement/autologout.php',
                        type: 'GET',
                        success: function(data) {
                            if (data.bool) {
                                window.location.href = '../Authentification/logout.php ';

                            }
                        },
                        dataType: 'json'
                    });
                    deconnexionAuto();
                }, 1800000);
            }
            deconnexionAuto();
            $("#blc_main").on('click', '#btn_rppvente', function(e) {
                e.preventDefault();
                var bool = false;
                var donnees = $('.filter_frm').serialize();
                var urlpg = './controllers/main2.php?p=rapport&d=venteajx&ajx=1';
                $("#vspdte").text($("#periode").val());
                $.ajax({
                    url: urlpg,
                    type: 'POST',
                    data: donnees,
                    beforeSend: function() {
                        $("#btn_rppvente").addClass('hidden');
                        $(".loader").removeClass('hidden');
                    },
                    success: function(data) {
                        $("#alldatafact").empty().append(data);
                        bool = true;
                    },
                    complete: function() {
                        if (bool) {
                            $(".loader").addClass('hidden');
                            $("#btn_rppvente").removeClass('hidden');
                        } else {
                            $(".loader").removeClass('hidden');
                        }
                    }
                    //                        ,dataType:'json'
                });
                return false;
            });

            //SAVE DETAILS PLATS

            $('#save_cuisson').click(function(e) {
                e.preventDefault();
                var donnees = $('#formcuisson').serialize();
                var etat = $('#etat_detplat').val();
                var bool;
                $.ajax({
                    url: './Traitement/cuisson_insert.php',
                    type: 'POST',
                    data: donnees,
                    beforeSend: function() {
                        $("#loader_cuisson").removeClass('hidden');
                        $("#save_cuisson").addClass('hidden');
                    },
                    success: function(data) {
                        bool = true;
                        if (data.message_succes == 'succes') {
                            $('#designation').val(' ');
                            $('#msg1').show().fadeOut(4000)
                                .addClass('alert-success')
                                .removeClass('alert-danger');
                            $('#msg_alert_cuisson').text("L'enrégistrement s'est effectué avec succès!");
                            var pos_id = data.pos_id;
                            var urlpg = url_def + 'p=plat&d=majcuisson&ajx=1&ss=' + pos_id + 'etat=' + etat;
                            $.ajax({
                                url: urlpg,
                                type: 'POST',
                                success: function(html) {
                                    $("#view_cuisson").empty().append(html);
                                    $(".tblcuisson").DataTable();
                                }
                            });
                        } else if (data.message_erreur == 'erreur') {
                            $('#msg145').show()
                                .addClass('alert-danger')
                                .removeClass('alert-success');
                            $('#msg_alert_cuisson').text("Cette famille existe déjà!")
                        } else if (data.message_vide == 'vide') {
                            $('#msg145').show().fadeOut(4000)
                                .addClass('alert-danger')
                                .removeClass('alert-success');
                            $('#msg_alert_cuisson').text('Veuilez remplir les champs vides!')

                        }

                    },
                    complete: function() {
                        if (bool) {
                            $("#loader_cuisson").addClass('hidden');
                            $("#save_cuisson").removeClass('hidden');
                        } else {
                            $("#loader_cuisson").removeClass('hidden');
                            $("#save_cuisson").addClass('hidden');
                        }
                    },
                    dataType: 'json'
                });

            });

            $('#save_sauce').click(function(e) {
                e.preventDefault();
                var donnees = $('#formsauce').serialize();
                var etat = $('#etat_detplat2').val();
                var bool;
                $.ajax({
                    url: './Traitement/cuisson_insert2.php',
                    type: 'POST',
                    data: donnees,
                    beforeSend: function() {
                        $("#loader_sauce").removeClass('hidden');
                        $("#save_sauce").addClass('hidden');
                    },
                    success: function(data) {
                        bool = true;
                        if (data.message_succes == 'succes') {
                            $('#designation').val(' ');
                            $('#msg1').show().fadeOut(4000)
                                .addClass('alert-success')
                                .removeClass('alert-danger');
                            $('#msg_alert_sauce').text("L'enregistrement s'est effectue avec succes!");
                            var pos_id = data.pos_id;
                            var urlpg = url_def + 'p=plat&d=majsauce&ajx=1&ss=' + pos_id + 'etat=' + etat;
                            $.ajax({
                                url: urlpg,
                                type: 'POST',
                                success: function(html) {
                                    $("#view_sauce").empty().append(html);
                                    $(".tblsauce").DataTable();
                                }
                            });
                        } else if (data.message_erreur == 'erreur') {
                            $('#msg1454').show()
                                .addClass('alert-danger')
                                .removeClass('alert-success');
                            $('#msg_alert_sauce').text("Cette famille existe dejà!")
                        } else if (data.message_vide == 'vide') {
                            $('#msg1454').show().fadeOut(4000)
                                .addClass('alert-danger')
                                .removeClass('alert-success');
                            $('#msg_alert_sauce').text('Veuilez remplir les champs vides!')

                        }

                    },
                    complete: function() {
                        if (bool) {
                            $("#loader_sauce").addClass('hidden');
                            $("#save_sauce").removeClass('hidden');
                        } else {
                            $("#loader_sauce").removeClass('hidden');
                            $("#save_sauce").addClass('hidden');
                        }
                    },
                    dataType: 'json'
                });

            });

            $("#btn_cuisson").click(function() {
                var selected = $("#cuisson_id option:selected");
                var accomp_id = selected.val();
                var accomp_name = selected.text();
                var unite_accomp = 0;
                $.ajax({
                    url: 'Traitement/tableau_cuisson.php',
                    async: true,
                    type: 'POST',
                    data: "accomp_id=" + accomp_id + "&accomp_name=" + accomp_name + "&unite_accomp=" + unite_accomp,
                    global: false,
                    cache: false,
                    success: function(data) {
                        $("#cuisson").empty().html(data);

                    }
                });
            });

            $('#btn_suppCUISSON').click(function(e) {
                var donnees = '';
                var accomp_id;
                var supprimer = 'OK';
                $('.ch_cuisson:checked').each(function(i) {
                    accomp_id = $(this).val();
                    $.ajax({
                        url: 'Traitement/tableau_cuisson.php?accomp_id=' + accomp_id + "&supprimer=" + supprimer,
                        type: 'POST',
                        data: donnees,
                        success: function(data) {
                            // alert(data);
                            $("#cuisson").empty().html(data);
                        }
                    });

                });
                return false;
            });

            $("#btn_sauce").click(function() {
                var selected = $("#sauce_id option:selected");
                var accomp_id = selected.val();
                var accomp_name = selected.text();
                var unite_accomp = 1;
                $.ajax({
                    url: 'Traitement/tableau_sauce.php',
                    async: true,
                    type: 'POST',
                    data: "accomp_id=" + accomp_id + "&accomp_name=" + accomp_name + "&unite_accomp=" + unite_accomp,
                    global: false,
                    cache: false,
                    success: function(data) {
                        $("#sauce").empty().html(data);

                    }
                });
            });

            $('#btn_suppSAUCE').click(function(e) {
                var donnees = '';
                var accomp_id;
                var supprimer = 'OK';
                $('.ch_sauce:checked').each(function(i) {
                    accomp_id = $(this).val();
                    $.ajax({
                        url: 'Traitement/tableau_sauce.php?accomp_id=' + accomp_id + "&supprimer=" + supprimer,
                        type: 'POST',
                        data: donnees,
                        success: function(data) {
                            $("#sauce").empty().html(data);
                        }
                    });

                });
                return false;
            });

            $("#alldatafact").on('click', '.mobilemoney', function() {
                var donnees = $('.filter_frm').serialize();
                var urlpg = './controllers/main2.php?p=facture&d=modepaieajx&ajx=1';
                $.ajax({
                    url: urlpg,
                    type: 'POST',
                    data: donnees,
                    success: function(data) {
                        $("#tab_mobile_money").empty().append(data);
                        $(".tbmobile").DataTable();

                    }
                });
            });


            $("#blc_main").on('click', '.btn_regler_extrait_line', function(e) {
                e.preventDefault();
                var solde = $(this).attr("solde");
                var idclient = $(this).attr("idclient");
                var client = $(this).attr("client");
                var taux = $('#txoperation').val();
                var montequivalent = solde * taux;
                $('.montant_fact').text(solde);
                $('.mont_equivalent').text(montequivalent);
                $('#montant_tot_solde').val(solde);
                $('#client_id_extrait').val(idclient);
                $('#name_customer').val(client);

                $("#myModalPaiementGlobal").modal('show');
                return false;
            });

            $("#blc_main").on('click', '#btn_vld_paiecredit3', function(e) {
                e.preventDefault();
                var donnees = $('.f_modal_paiement_global').serialize();
                var urlpg = './controllers/main2.php?p=facture&d=regler6&ajx=1';
                var bool = false;

                $.ajax({
                    url: urlpg,
                    type: 'POST',
                    data: donnees,
                    beforeSend: function() {
                        $(".btn_modal").addClass('hidden');
                        $(".loader").removeClass('hidden');
                    },
                    success: function(data) {
                        if (data.succes) {

                            window.open('./impression/examples/recuglobal.php');
                            var sousresto_id = data.posid;
                            urlpg2 = './controllers/main2.php?p=facture&d=liste2&ajx=1&ss=123';
                            $.ajax({
                                url: urlpg2,
                                type: 'GET',
                                success: function(html) {
                                    $("#datasextrait").empty().append(html);
                                    $("#myModalPaiementGlobal").modal('hide');
                                    $(".montant").val('');
                                    $(".example1").DataTable();
                                }
                            });
                        } else {
                            $('#message_global').text(data.message);
                            $('#div_message_global').removeClass('hidden').show().fadeOut(4000);
                        }
                        bool = true;
                    },
                    complete: function() {
                        if (bool) {
                            $(".loader").addClass('hidden');
                            $(".btn_modal").removeClass('hidden');
                        } else {
                            $(".loader").removeClass('hidden');
                        }
                    },
                    dataType: 'json'
                });

                return false;
            });

            $("#blc_main").on('click', '.btn_prnt_extrcompte2', function(e) {
                e.preventDefault();
                var id = $(this).attr("id");
                var n = $(this).attr("n");
                var url = './impression/examples/extraitcompte2.php?id=' + id + '&n=' + n;
                window.open(url);
            });

            $("#blc_main").on('click', '#btn_rapport_versement', function(e) {
                e.preventDefault();
                var bool = false;
                var donnees = $('.filter_frm').serialize();
                var sousresto_id = $("#sousresto_id").val();
                var periode = $("#periode").val();
                var urlpg = './controllers/main2.php?p=versement&d=details2ajx&ajx=1&ss=' + sousresto_id;
                $.ajax({
                    url: urlpg,
                    type: 'POST',
                    data: donnees,
                    beforeSend: function() {
                        $(".btn_modal").addClass('hidden');
                        $(".loader").removeClass('hidden');
                    },
                    success: function(data) {
                        $("#speriode_versement").html(periode);
                        $("#bcqdetails2").empty().append(data);
                        bool = true;
                    },
                    complete: function() {
                        if (bool) {
                            $(".loader").addClass('hidden');
                            $(".btn_modal").removeClass('hidden');
                        } else {
                            $(".loader").removeClass('hidden');
                        }
                    }
                });
                return false;
            });

            $("#blc_main").on('click', '#btn_paiement_groupe', function(e) {
                e.preventDefault();
                var bool = false;
                var donnees = $('.filter_frm').serialize();
                var periode = $("#periode").val();
                var urlpg = url_def + 'p=facture&d=listpayajx&ajx=1';
                $.ajax({
                    url: urlpg,
                    type: 'POST',
                    data: donnees,
                    beforeSend: function() {
                        $(".loader").removeClass('hidden');
                        $(".btn_vers").addClass('hidden');
                    },
                    success: function(data) {
                        $("#speriode_versement").html(periode);
                        $('#alldatafact').empty().append(data);
                        $(".example1").DataTable();
                        bool = true;
                    },
                    complete: function() {
                        if (bool) {
                            $(".loader").addClass('hidden');
                            $(".btn_vers").removeClass('hidden');
                        } else {
                            $(".loader").removeClass('hidden');
                        }
                    }
                });
            });

            $("#blc_main").on('click', '#btn_rapport_etatcaisse', function(e) {
                e.preventDefault();
                var bool = false;
                var donnees = $('.filter_frm').serialize();
                var sousresto_id = $("#sousresto_id").val();
                var periode = $("#periode").val();
                var urlpg = './controllers/main2.php?p=versement&d=etatcaisseajx&ajx=1&ss=' + sousresto_id;
                $.ajax({
                    url: urlpg,
                    type: 'POST',
                    data: donnees,
                    beforeSend: function() {
                        $(".btn_modal").addClass('hidden');
                        $(".loader").removeClass('hidden');
                    },
                    success: function(data) {
                        $("#speriode_versement").html(periode);
                        $("#bcqdetails2").empty().append(data);
                        bool = true;
                    },
                    complete: function() {
                        if (bool) {
                            $(".loader").addClass('hidden');
                            $(".btn_modal").removeClass('hidden');
                        } else {
                            $(".loader").removeClass('hidden');
                        }
                    }
                });
                return false;
            });
            $("#blc_main").on('click', '.btndisplaypopupdep', function(e) {
                e.preventDefault();
                var id = $(this).attr("id");
                var lib = $(this).attr("lib");
                var des = $(this).attr("des");
                var usd = $(this).attr("usd");
                var cdf = $(this).attr("cdf");
                $('#depense_id').val(id);
                $('#motif').val(des);
                $('#montantcdf_depense').val(cdf);
                $('#montantusd_depense').val(usd);
                $('#libelle_id option:contains("' + lib + '")').attr('selected', true);
                $("#ModalUpdateDepense").modal('show');
                return false;
            });
            $("#blc_main").on('click', '#btn_vld_depense_update', function(e) {
                e.preventDefault();
                var url_def = './controllers/main2.php?';
                var donnees = $('#FormDepense').serialize();
                var urlpg = url_def + 'p=depense&d=updatedepense&ajx=1';
                var method = 'POST';
                $.ajax({
                    url: urlpg,
                    type: method,
                    data: donnees,
                    success: function(data) {
                        // alert(data);
                        if (data.s) {
                            $('.mt').val('');
                            $("#ModalUpdateDepense").modal('hide');
                            window.open('impression/examples/depensebon.php?id=' + data.depense_id);
                            window.location.href = 'main.php?p=depense&d=liste&ss=123';

                        } else {
                            $('#sp_bkg').text(data.message);
                            $('#div_bkg').removeClass('hidden').addClass('alert-danger').show().fadeOut(4000);
                        }
                    },
                    dataType: 'json'
                });
            });
            $("#blc_main").on('click', '.btndeldep', function(e) {
                e.preventDefault();
                var url_def = './controllers/main2.php?';
                var donnees = '';
                var id = $(this).attr("id");
                var urlpg = url_def + 'p=depense&d=deldepense&ajx=1&depense_id=' + id;
                var method = 'POST';
                $.ajax({
                    url: urlpg,
                    type: method,
                    data: donnees,
                    success: function(data) {
                        // alert(data);
                        if (data.s) {
                            window.location.href = 'main.php?p=depense&d=liste&ss=123';
                        } else {
                            $('#sp_bkg').text(data.message);
                            $('#div_bkg').removeClass('hidden').addClass('alert-danger').show().fadeOut(4000);
                        }
                    },
                    dataType: 'json'
                });
            });
            $("#blc_main").on('click', '.btndelfdc', function(e) {
                e.preventDefault();
                var url_def = './controllers/main2.php?';
                var donnees = '';
                var id = $(this).attr("id");
                var urlpg = url_def + 'p=fdc&d=delfdc&ajx=1&fdc_id=' + id;
                var method = 'POST';
                $.ajax({
                    url: urlpg,
                    type: method,
                    data: donnees,
                    success: function(data) {
                        // alert(data);
                        if (data.s) {
                            window.location.href = 'main.php?p=fdc&d=liste&ss=123';
                        } else {
                            $('#sp_bkg').text(data.message);
                            $('#div_bkg').removeClass('hidden').addClass('alert-danger').show().fadeOut(4000);
                        }
                    },
                    dataType: 'json'
                });
            });
        });
    </script>
</body>

</html>