<?php include('Receptionniste.php'); ?>
<?php include('head.php'); ?>
<?php include('menu_Rec.php'); ?>
<?php include('../FUNCTION/checkdates.php'); ?>
<?php include('../FUNCTION/hebergement.php'); ?>
<?php require '_header.php'; ?>
<?php include_once './Amelioration/reglage/recuperer_valeurs_reglages.php'; ?>
<?php
$hebergement = 0;
$remise1 = 0;

if (isset($_GET['hebergement']) && isset($_GET['remise'])) {
    $hebergement = $_GET['hebergement'];
    $remise1 = $_GET['remise'];
    if ($hebergement == 1) {
        $hebergement = 1;
    } else {
        $hebergement = 2;
    }
}

?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">
                <?php
                if (isset($_GET['hebergement']) && ($_GET['hebergement'] == 1)) {
                    echo 'Réservation';
                    $res = 1;
                } else {
                    echo 'Occupation';
                    $res = 2;
                }
                ?>
            </h2>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-file-text-o"></i> Aperçu facture
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            <br>
                            Client:
                            <address>
                                <strong><?php echo ucfirst($_SESSION['nom_client']); ?></strong><br>
                                Type client:<br>
                                <?php echo ucfirst($_SESSION['type_cl']); ?>
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <br>
                            <address>
                                <strong>Détails</strong><br>
                                Date prévue d'arrivée: <?php echo $_SESSION['date_arrive']; ?><br>
                                Date prévue de sortie: <?php echo $_SESSION['date_sorti']; ?><br>
                                <font color="#FF0000">Soit <?php echo $_SESSION['nbre_jr']; ?> Jour(s)</font>
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <span class="">Date: <?php echo $_SESSION['date_res']; ?> </span><br>
                        </div>
                        <!-- /.col -->
                        <br><br>
                    </div>
                    <!-- /.row -->

                    <!-- Table row -->
                    <div class="row" id="panier">
                        <div class="col-xs-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Chambre</th>
                                    <th>Tarif</th>
                                    <th>Durée</th>
                                    <th>Sous-Total</th>
                                    <!--<th>Action</th>-->
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $nbArticles = count($_SESSION['panier']['id']);
                                $j = 1;
                                $som = 0;
                                for ($i = 0; $i <= $nbArticles - 1; $i++) {
                                    $tarif_ch = $_SESSION['panier']['prix'][$i];
                                    $monnaie = $_SESSION['panier']['monnaie'][$i];
                                    $num_ch= $_SESSION['panier']['nom'][$i];
                                    $id_ch=$_SESSION['panier']['id'][$i];
                                    ?>
                                    <tr>
                                        <td><?php echo $j ?></td>
                                        <td><?php echo $num_ch ?></td>
                                        <td><?php echo afficheMontant($m_affiche,$tarif_ch) ?></td>
                                        <td><?php echo $_SESSION['nbre_jr']; ?> jour(s)</td>
                                        <td><?php echo afficheMontant($m_affiche,$tarif_ch* $_SESSION['nbre_jr']) ?></td>
                                        <input type="hidden" name="id" value="<?php echo $id_ch ?>"/>
                                    </tr>
                                    <?php
                                    $j++;
                                    $som += $tarif_ch;
                                }
                                ?>
                                </tbody>
                                <!--                          <tfoot>
                              <tr>
                                <th><?php echo count($_SESSION['panier']) ?></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                              </tr>
                          </tfoot>-->
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-xs-3">

                        </div>
                        <!-- /.col -->
                        <div class="col-xs-9">
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th style="width:50%">HT:</th>
                                        <td>
                                            <?php
                                            $_SESSION['total'] = $som * $_SESSION['nbre_jr'];
                                             $total=total($_SESSION['total'],$tva,$remise1);
                                             $mont_ht=  ht($total,$tva,$remise1);
                                            echo afficheMontant($m_affiche,$mont_ht);
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Rémise (<?php echo $remise1 ?>%)</th>
                                        <td>
                                            <?php
                                              $montant_rem=remise($_SESSION['total'],$tva,$remise1);
                                              $_SESSION['montant_rem']=$montant_rem;
                                            echo afficheMontant($m_affiche,$montant_rem );
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>T.V.A (<?php echo $tva ?>%)</th>
                                        <td>
                                            <?php
                                            $montant_tva =tva($total,$tva,$remise1);
                                            $_SESSION['montant_tva']=$montant_tva;
                                            echo afficheMontant($m_affiche,$montant_tva );
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>TTC:</th>
                                        <td>
                                            <?php
                                             $montant_tot=ttc($mont_ht,$montant_tva,$montant_rem);
                                             $_SESSION['ttc']=$montant_tot;
                                            echo afficheMontant($m_affiche,$montant_tot );
                                            $montant_tot1=montant_equivalent($m_affiche, $tauxdollar,$montant_tot);
                                            echo ' Soit ' . $montant_tot1 ;
                                            ?>
                                            <input type="hidden" name="montant_tot" id="montant_tot" value="<?php echo $montant_tot; ?>">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->



                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel-default -->
            <form  method="post" action="Traitement_reservation/enreg_paiement.php"
                          id="form" class="form-horizontal form-label-left">
                <fieldset>
                    <!--les champs cachés-->
                            <input name="hebergement" id="hebergement" type="hidden"
                                   value="<?php echo $hebergement; ?>">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default" id='paie_res'>
                                <div class="panel-heading">
                                    <i class="fa fa-money"></i>
                                    Paiement <b>( nuité :<?php
                                        $montant_nuite = $_SESSION['montant_nuite'];
                                        $total=total($montant_nuite,$tva,$remise1);
                                        $montant_rem=remise($montant_nuite,$tva,$remise1);
                                        $montant_tva =tva($total,$tva,$remise1);
                                        $mont_ht=  ht($total,$tva,$remise1);
                                        $montant_nuite=ttc($mont_ht,$montant_tva,$montant_rem);
                                        $_SESSION['montant_nuite']=$montant_nuite;
                                        echo ' ' . afficheMontant($m_affiche,$montant_nuite ) . ' Soit ' . montant_equivalent($m_affiche, $tauxdollar, $montant_nuite);
                                        ?>)</b>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <br/>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Mode paiement
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="hidden" name="libele_mode" id="libele_mode" value="Cash">
                                                    <select name="mode" id="mode" class="form-control col-md-7 col-xs-12">
                                                        <?php
                                                        include '../bdd/connexion_mysql.php';
                                                        if ($_SESSION['type_cl'] == 'client occasionnel') {
                                                            $result = mysql_query("SELECT * FROM  t_mode_reglement WHERE id_mode_regl<>3 ORDER BY lib") or die(mysql_error());
                                                        } else {
                                                            $result = mysql_query("SELECT * FROM  t_mode_reglement ORDER BY lib") or die(mysql_error());
                                                        }
                                                        while ($row = mysql_fetch_array($result)) {
                                                            echo '<option value="' . $row['id_mode_regl'] . '">' . $row['lib'] . '</option>';
                                                        }
                                                        mysql_free_result($result);
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group div_montant">
                                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Montant <span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <div class="input-group">
                                                        <input type="number" name="montantusd" min="0"
                                                               placeholder="Montant" id="montantusd"
                                                               class="form-control col-md-7 col-xs-12">
                                                        <span class="input-group-addon"><?php echo getsymbole_devise(); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group div_montant">
                                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <div class="input-group">
                                                        <input type="number" name="montantcdf" min="0"
                                                               placeholder="Montant" id="montantcdf"
                                                               class="form-control col-md-7 col-xs-12">
                                                        <span class="input-group-addon"><?php echo getsymbole_local(); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group" id="remise" style="display:none">
                                                <div class="col-md-7 col-sm-7 col-xs-12">
                                                    <input type="hidden" name="remise" id="rem" value="<?php echo $remise1; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group" id="majoration" style="display:block">
                                                <!--                                        <label class="control-label col-md-3" for="remise">Majoration
                                                                                        </label>-->
                                                <div class="col-md-7 col-sm-7 col-xs-12" style=" display: none">
                                                    <!--                                            <input type="number" name="majoration" data-validate-minmax="10,100" placeholder="Majoration" id="majoration" class="form-control col-md-7 col-xs-12">-->
                                                    <?php include('./Amelioration/reglage/recuperer_valeurs_reglages.php'); ?>
                                                    <select name="majoration" id="majorat"
                                                            class="form-control col-md-7 col-xs-12">
                                                        <option value="0">0%</option>
                                                        <option value="<?php echo $majoration; ?>"><?php echo $majoration; ?>%
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group" id="lb_justif" style="display:none">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Justification <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <textarea name="justif" id="justif" class="form-control"
                                                              data-parsley-trigger="keyup" data-parsley-minlength="5"
                                                              data-parsley-maxlength="100"
                                                              data-parsley-minlength-message="Veuillez saisir plus de 5 caracteres"
                                                              data-parsley-validation-threshold="5"></textarea>
                                                </div>
                                            </div>
                                            <br>
                                            <div id="msg" class="alert alert-danger alert-dismissable" style="display:none">
                                                <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
                                                <span id="msg_alert">Veuillez saisir les valeurs correctes dans tous les champs!</span>
                                            </div>
                                            <div class="ln_solid"></div>
                                            <div class="row" >
                                                <div class="col-lg-12">
                                                    <div class="box-footer">

                                                        <?php if ($hebergement == 1) { ?>
                                                            <a id="precedent" class="btn btn-default"
                                                               href="rec_reservation_client_chambre_paiement.php?hebergement=1&rem=<?php echo $remise1; ?>">
                                                                <i class="fa fa-angle-double-left"></i> Précedent</a>
                                                            <a id="prec_paie" class="btn btn-default"
                                                               href="rec_reservation_multiple.php?hebergement=1&rem=<?php echo $remise1; ?>"
                                                               style="display:none;">
                                                                <i class="fa fa-angle-double-left"></i> Précedent</a>
                                                        <?php } ?>
                                                        <?php if ($hebergement == 2) { ?>
                                                            <a id="precedent" class="btn btn-primary"
                                                               href="rec_reservation_client_chambre_paiement.php?hebergement=2&rem=<?php echo $remise1; ?>">
                                                                <i class="fa fa-angle-double-left"></i> Précedent</a>
                                                            <a id="prec_paie" class="btn btn-primary"
                                                               href="rec_reservation_multiple.php?hebergement=2&rem=<?php echo $remise1; ?>"
                                                               style="display:none;">
                                                                <i class="fa fa-angle-double-left"></i> Précedent</a>
                                                        <?php } ?>
                                                        <button name="sauvegarder" id="save_reservation"
                                                                type="submit" class="btn btn-primary pull-right">
                                                            <i class="fa fa-check"></i> Valider 
                                                        </button>
                                                        <span class="btn btn-danger hidden pull-right" id="loader">
                                                            <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
                                                        </span>
                                                        <a style="display:none;" class="btn btn-success pull-right" id="go_heb" href="rec_reservation_multiple.php?hebergement=<?php echo $hebergement; ?>" >Continuer</a>
                                                    </div>
                                                    <!-- /.box-footer -->
                                                </div>
                                            </div>
                                            <!-- /.row -->
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
                </fieldset>
            </form>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<!--<script src="../Authentification/jquery-1.9.1.min.js"></script>
<script src="../Authentification/insertion_ajax.js"></script>-->
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
        var selected = $("#mode option:selected").text();
        $("#libele_mode").val(selected);
        if (selected == 'Credit') {
            $(".div_montant").addClass('hidden');
            $("#lb_justif").hide();
             $("#montantusd").val(0);
             $("#montantcdf").val(0);
        } else if (selected == 'Cash') {
            $("#lb_justif").hide();
            $(".div_montant").removeClass('hidden');
        } else if (selected == 'Don') {
            $(".div_montant").removeClass('hidden');
            $("#lb_justif").show();
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
        var selected = $("#monnaie option:selected").text();
        $("#libele_monnaie").val(selected);
//$("#lb_montant").hide();
        $("#div_montant").hide();
//$("#montant").hide();
//$("#montantUSD").hide();
//$("#montantFC").hide();

        if (selected != ' ') {
            if (selected == 'USD') {
                $("#div_montant").show();
            } else if (selected == 'CDF') {
                $("#div_montant").show();
            }
            /* else if (selected == 'USD&CDF') {
             $("#lb_montantUSD").show();
             $("#lb_montantFC").show();
             }*/
        }


    }

</script>
<?php // include('rec_footer.php'); ?>
