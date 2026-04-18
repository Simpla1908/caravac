<?php include('Receptionniste.php'); ?>
<?php include('head.php'); ?>
<?php include('menu_Rec.php'); ?>
<?php include('../FUNCTION/checkdates.php'); ?>
<?php include('../FUNCTION/hebergement.php'); ?>
<?php require '_header.php'; ?>
<?php include_once './Amelioration/reglage/recuperer_valeurs_reglages.php'; ?>
<?php
if (isset($_GET['id'])) {
    $panier->del($_GET['id']);
}
$ids = array_keys($_SESSION['panier']);
$hebergement = 0;
$remise1 = 0;
if (empty($ids)) {
    $chambre = array();
} else {
    $req = $bd->prepare('SELECT id_ch, num_ch, tarif_ch,monnaie FROM t_chambre WHERE id_ch in (' . implode(',', $ids) . ')');
    $req->execute();
    $chambre = $req->fetchAll(PDO::FETCH_OBJ);
}
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
<div id="page-wrapper" style=" height:auto;">
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
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    $som = 0;
                                    foreach ($chambre as $d):
                                        // Affichage selon monnaie d'affichage définie
                                        if ($d->monnaie == $m_affiche) {
                                            $tarif_ch = $d->tarif_ch;
                                        } else {
                                            if ($d->monnaie = 'USD' && $m_affiche == 'CDF') {
                                                $tarif_ch = round($d->tarif_ch * $tauxdollar, 2);
                                            } else {
                                                $tarif_ch = round($d->tarif_ch * 1 / $tauxdollar, 2);
                                            }
                                        }
                                        ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo 'Ch ' . $d->num_ch ?></td>
                                            <td><?php echo $tarif_ch . ' ' . $m_affiche ?></td>
                                            <td><?php echo $_SESSION['nbre_jr']; ?> jour(s)</td>
                                            <td><?php echo $tarif_ch * $_SESSION['nbre_jr'] . ' ' . $m_affiche ?></td>
                                    <input type="hidden" name="id" value="<?php echo $d->id_ch ?>"/>
                                    <td>
                                        <a title="Supprimer" href="rec_reservation_paiement.php?id=<?php echo $d->id_ch ?>&hebergement=<?php echo $hebergement; ?>#panier">
                                            <i class="fa fa-trash"></i> 
                                        </a>
                                    </td>
                                    </tr>
                                    <?php
                                    $i++;
                                    $som += $tarif_ch;
                                endforeach;
                                ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-xs-3"></div>
                        <!-- /.col -->
                        <div class="col-xs-9">
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th style="width:50%">Sous-total:</th>
                                        <td>
                                            <?php
                                            $_SESSION['total'] = $som * $_SESSION['nbre_jr'];
                                            echo $_SESSION['total'] . ' ' . $m_affiche;
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Rémise (<?php echo $remise1 ?>%)</th>
                                        <td>
                                            <?php
                                            $montant_rem = ($remise1 * $_SESSION['total']) / 100;
                                            echo $montant_rem . ' ' . $m_affiche;
                                            ?> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>T.V.A (<?php echo $tva ?>%)</th>
                                        <td>
                                            <?php
                                            $montant_tva = ($tva * $_SESSION['total']) / 100;
                                            echo $montant_tva . ' ' . $m_affiche;
                                            ?> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Total:</th>
                                        <td>
                                            <?php
                                            $montant_tot = ($_SESSION['total'] - $montant_rem) + $montant_tva;
                                            echo $montant_tot . ' ' . $m_affiche;
                                            if ($m_affiche == 'USD') {
                                                echo ' Soit ' . $montant_tot * $tauxdollar . ' CDF';
                                            } else {
                                                echo ' Soit ' . $montant_tot / $tauxdollar . ' USD';
                                            }
                                            ?>
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
            <form role="form" method="post" action="Traitement_reservation/enreg_paiement.php"
                  id="form" class="form-horizontal form-label-left">
                <fieldset>
                    <!--les champs cachés-->
                    <input name="heberge" id="hebergement" type="hidden" value="<?php echo $hebergement; ?>">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-money"></i>
                                    Paiement <b>( nuité :<?php
                                        $montant_nuite = $_SESSION['montant_nuite'];
                                        $remise = $remise1;
                                        $montant_remise = ($montant_nuite * $remise) / 100;
                                        $montant_nuite = $montant_nuite - $montant_remise;
                                        $montant_tva = ($montant_nuite * $tva) / 100;
                                        $montant_nuite = $montant_nuite + $montant_tva;
                                        echo ' ' . $montant_nuite . ' ' . $m_affiche . ' Soit ' . montant_equivalent($m_affiche, $tauxdollar, $montant_nuite);
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
                                                    <input type="hidden" name="libele_mode" id="libele_mode">
                                                    <select name="mode" id="mode" class="form-control col-md-7 col-xs-12">
                                                        <option value="0">Sélectionner un mode</option>
                                                        <?php
                                                        include '../bdd/connexion_mysql.php';
                                                        if ($_SESSION['type_cl'] == 'client occasionnel') {
                                                            $result = mysql_query("SELECT * FROM  t_mode_reglement WHERE id_mode_regl<>3") or die(mysql_error());
                                                        } else {
                                                            $result = mysql_query("SELECT * FROM  t_mode_reglement") or die(mysql_error());
                                                        }
                                                        while ($row = mysql_fetch_array($result)) {
                                                            echo '<option value="' . $row['id_mode_regl'] . '">' . $row['lib'] . '</option>';
                                                        }
                                                        mysql_free_result($result);
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group" id="div_montant" style="display:none">
                                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Montant <span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <div class="input-group">
                                                        <input type="number" name="montant" min="0"
                                                               placeholder="Montant" id="montant" 
                                                               class="form-control col-md-7 col-xs-12">
                                                        <span class="input-group-addon"><?php echo $m_affiche; ?></span>
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
                                                    <textarea name="justif" id="justif" required class="form-control"
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
                                                        <span class="btn btn-danger hidden" id="loader">
                                                            <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
                                                        </span>
                                                        <a style="display:none;" class="btn btn-success" id="go_heb" href="rec_reservation_multiple.php?hebergement=<?php echo $hebergement; ?>" >Continuer</a>
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
            $("#div_montant").hide();
            $("#lb_justif").hide();
             $("#montant").val(0);
        } else if (selected == 'Cash') {
            $("#lb_justif").hide();
            $("#div_montant").show();
        } else if (selected == 'Don') {
            $("#div_montant").hide();
            $("#lb_justif").show();
            $("#montant").val($("#montant_tot").val());
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
