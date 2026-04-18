<?php
require '../bdd/connexion.php';
include('Receptionniste.php'); ?>
<?php include('headerRec.php'); ?>
<?php
include('menu_Rec.php');
include './Amelioration/reglage/recuperer_valeurs_reglages.php';
if (isset($_GET['id_res']) && isset($_GET['id_client']) && isset($_GET['num_reserv']) && isset($_GET['nom_client']) && isset($_GET['id_ch']) && isset($_GET['num_ch'])&& isset($_GET['fact']) && isset($_GET['mont_remboursable'])) {
    $id_res = $_GET['id_res'];
    $fact= $_GET['fact'];
    $id_client = $_GET['id_client'];
    $num_ch = $_GET['num_ch'];
    $id_ch = $_GET['id_ch'];
    $num_reserv = $_GET['num_reserv'];
    $nom_client = $_GET['nom_client'];
    $mont_remboursable = $_GET['mont_remboursable'];
   $dtes = $_GET['dtes'];
}
?>


<div id="page-wrapper">
    <!--<br>
<h1><b><center>--><?php //echo strtoupper($_SESSION['nom_hotel']);    ?><!--</center></b></h1>-->
    <div class="row">
        <div class="col-lg-12">
            <section id="spinner">
                <h2 class="page-header">Libération</h2>

                <div class="alert alert-success" style="display: none" id='alert_lib'>
                    <ul class="fa-ul">
                        <li>
                            <i class="fa fa-info-circle fa-lg fa-li"></i> L'opération reussie avec succès
                            <a href="#" class="alert-link">la chambre a été libérer</a>.
                        </li>
                    </ul>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>
                            La libération d'une chambre
                        </h4>
                    </div>
                    <div class="panel-body">
                        <BR>
                        <form role="form" method="post" action="Traitement_propre/liberation_traitement.php"
                              class="form-horizontal form-label-left">
                            <input id="m_aff" name="m_aff" type="hidden" value="<?php echo $m_affiche; ?>">
                            <input id="fact" name="fact" type="hidden" value="<?php echo $fact; ?>">
                            <input id="num_res" name="num_res" type="hidden" value="<?php echo $id_res; ?>">
                            <input id="id_client" name="id_client" type="hidden" value="<?php echo $id_client; ?>">
                            <input id="id_ch" name="id_ch" type="hidden" value="<?php echo $id_ch; ?>">
                            <div class="form-group">
                                <label class="control-label col-md-3" for="client">Client <span
                                        class="required">*</span>
                                </label>
                                <div class="col-md-7">
                                    <input type="text" id="client" value="<?php echo $nom_client; ?>"
                                           disabled="disabled" required class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3" for="Chambre">Chambre <span
                                        class="required">*</span>
                                </label>
                                <div class="col-md-7">
                                    <input type="text" id="chambre" value="<?php echo $num_ch; ?>" required
                                           disabled="disabled" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <?php
                            if ($mont_remboursable < 0) {
                                ?>
                                <div class="form-group">
                                    <label class="control-label col-md-3" for="mont_remboursable">Remboursement<?php echo '  '.$m_affiche;?>

                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-7">
                                        <input type="text" value="<?php echo abs($mont_remboursable); ?>" required
                                               disabled="disabled" class="form-control col-md-7 col-xs-12">
                                        <input type="hidden" id="mont_remboursable" name="mont_remboursable"
                                               value="<?php echo $mont_remboursable; ?>"
                                               class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3" for="montUSD">Montant USD <span
                                            class="required">*</span>
                                    </label>
                                    <div class="col-md-7">
                                        <input type="text" id="montUSD" name="montantUSD"
                                               class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3" for="montFC">Montant FC <span
                                            class="required">*</span>
                                    </label>
                                    <div class="col-md-7">
                                        <input type="text" id="montFC" name="montantFC"
                                               class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                            <div class="form-group">
                         <!--       <label class="control-label col-md-3" for="Date_libération">Date de libération <span
                                        class="required">*</span>
                                </label>-->
                                <div class="col-md-7">
                                    <input type="hidden" id="datetimepicker6" name="date_lib"
                                           value="<?php echo $dtes; ?>" required
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                    <button type="submit" class="btn btn-primary" id="valider_liberation"
                                            name="valider"><i class=" fa fa-check"></i> Valider
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
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
<script src="../datepicker/jquery.js"></script>
<script src="../datepicker/jquery.datetimepicker.js"></script>
<script>
    $('#datetimepicker6').datetimepicker();
    $('#datetimepickerOcc').datetimepicker();
    $('#datetimepickerLib').datetimepicker();
    $('#datetimepickerLib1').datetimepicker();
</script>

<script src="../js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>
<script src="../js/bootstrap-modal.js"></script>
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
<!-- Authentification -->
<!--<script src="../js_auth/jquery.js"></script>-->
<script src="../Authentification/control_userAjax.js"></script>
<!-- Reservation -->
<script src="Traitement_reservation/verification_reservation.js"></script>
<script src="Traitement_reservation/script_paie.js"></script>

<script type="text/javascript">


    $("#mode").change(onSelectChange);

    function onSelectChange() {
        var selected = $("#mode option:selected");
        $("#lb_justif").hide();
        $("#justif").hide();
        if (selected.val() != 0) {
            if (selected.val() == 1) {
                $("#lb_justif").show();
                $("#justif").show();
            } else {
                $("#lb_justif").hide();
                $("#justif").hide();
            }
        }


    }


    $("#dollar").on('click', function () {
        $('input[name="dollard"]:checked').val();
        /*$("#montantusd").show();*/
        alert($('input[name="dollard"]:checked').val());
    });

</script>


<script type="text/javascript">

    <!--Vérification des monaies-->

    $("#monnaie").change(onSelectChange);

    function onSelectChange() {
        var selected = $("#monnaie option:selected");
        $("#lb_montant").hide();
        $("#lb_montantUSD").hide();
        $("#lb_montantFC").hide();

        $("#montant").hide();
        $("#montantUSD").hide();
        $("#montantFC").hide();

        if (selected.val() != 0) {
            if (selected.val() == 1 || selected.val() == 2) {
                $("#lb_montant").show();
                $("#montant").show();
            } else {
                $("#lb_montant").hide();
                $("#montant").hide();
            }

            if (selected.val() == 3) {
                $("#lb_montantUSD").show();
                $("#montantUSD").show();
                $("#lb_montantFC").show();
                $("#montantFC").show();
            } else {
                $("#lb_montantUSD").hide();
                $("#montantUSD").hide();
                $("#lb_montantFC").hide();
                $("#montantFC").hide();
            }
        }


    }

</script>
<?php // include('rec_footer.php'); ?>
