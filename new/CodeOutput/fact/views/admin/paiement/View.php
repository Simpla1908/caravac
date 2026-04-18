<?php
/*
 * =======================================================================
 * FILE NAME:        View.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		paiement
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
?>
<?php AjaxSearchSuggest('' . H_ADMIN_MAIN . '&view=paiement&do=autosearch'); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">

            <div class="box-header with-border">
                <h3 class="box-title titrepg">Liste de paiement du <?php echo date('d/m/Y'); ?> au <?php echo date('d/m/Y'); ?></h3>
                <ul class="nav pull-right">

                    <!--<a href="<?php echo H_ADMIN; ?>&view=paiement&do=add" class="btn btn-primary btn-sm tip" title="<?php echo LANG_TIP_ADD; ?>"><i class="fa fa-money"></i> Payer</a>-->
                    <a class="btn btn-default btn-sm tip" title="Filtrer les paiements" data-toggle="modal" data-target="#modalfiltrerpaie"><i class="fa fa-sort"></i> Filtrer</a>

                    <a href="<?php echo H_ADMIN_MAIN; ?>&view=impression&do=prnt_liste_paiement" target="_blank" class="btn btn-default btn-sm tip btn_prnt_fpaiement3" title="<?php echo LANG_TIP_PRINT; ?>"><i class="fa fa-print"></i> <?php echo LANG_PRINT; ?></a>
                    <!--<a href="<?php echo H_ADMIN_MAIN; ?>&view=paiement&do=export&hexport=yes&etype=excel" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_EXCEL; ?>"><i class="fa fa-table"></i> <?php echo LANG_EXCEL; ?></a>-->
                    <!--<a href="<?php echo H_ADMIN_MAIN; ?>&view=paiement&do=export&hexport=yes&etype=word" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_WORD; ?>"><i class="fa fa-file-o"></i> <?php echo LANG_WORD; ?></a>-->
                    <!--<a href="<?php echo H_ADMIN; ?>&view=paiement&do=truncate" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_TRUNCATE; ?>" data-confirm="<?php echo LANG_DELETE_AUTH; ?>"><i class="fa fa-trash-o"></i> <?php echo LANG_TRUNCATE; ?></a>-->
                </ul>

            </div><!-- /.box-header -->
            <div class="box-body">

                <!--AUTO COMPLETE-->
                <div class="col-md-3 autosearch hidden">
                    <div class=" s-absolute">
                        <div class="input-group">
                            <input type="text" class="form-control input-sm styler" id="inputString" onkeyup="lookup(this.value);" placeholder="search" autocomplete="off">
                            <span class="input-group-btn">
                                <button class="btn btn-default btn-sm" type="button"><span class="fa fa-search"></span></button>
                            </span>
                        </div><!-- /input-group -->
                        <div id="suggestions"></div>
                    </div>
                </div>
                <!--/col-lg-3-->
                <!--/AUTO COMPLETE-->

                <table data-page="false" class="table table-bordered table-hover table-striped table-condensed t1 t2" data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE; ?>" data-page-previous-text="<?php echo LANG_PREVIOUS; ?>" data-page-next-text="<?php echo LANG_NEXT; ?>">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th data-hide="phone,tablet">Date</th>
                            <th data-hide="phone,tablet">N° Réçu</th>
                            <th data-hide="phone,tablet">N° Facture</th>
                            <th data-hide="phone,tablet">Client</th>
                            <th data-hide="phone,tablet">Mode</th>
                            <th data-hide="phone,tablet">Montant</th>
                            <th data-sort-ignore="true"><?php echo LANG_ACTIONS; ?></th>
                        </tr>
                    </thead>
                    <tbody id="majdataspaie">

                        <?php
                        //Mise en session pour impression
                        $_SESSION['rows_paiement'] = array();
                        $_SESSION['rows_paiement']['i'] = array();
                        $_SESSION['rows_paiement']['nom_client'] = array();
                        $_SESSION['rows_paiement']['num_fact'] = array();
                        $_SESSION['rows_paiement']['numero'] = array();
                        $_SESSION['rows_paiement']['dte'] = array();
                        $_SESSION['rows_paiement']['lib'] = array();
                        $_SESSION['rows_paiement']['montant'] = array();
                        //Fin mise en session
                        $i = 1;
                        foreach ($result as $rows) {
                            $montant = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $rows->taux, $rows->montant);

                        ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo dateAffiche($rows->dte); ?></td>
                                <td><?php echo $rows->numero; ?></td>
                                <td><?php echo $rows->num_fact; ?></td>
                                <td><?php echo $rows->nom_client; ?></td>
                                <td>
                                    <?php
                                    echo $rows->lib;
                                    ?>
                                </td>
                                <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $montant); ?></td>

                                <td class="table-actions">
                                    <div class="btn-group">
                                        <a class="btn btn-default btn-xs tip btn_pntrecu_histo" factureid="<?php echo $rows->id_fact; ?>" mode="<?php echo $rows->lib; ?>" dte="<?php echo $rows->dte; ?>" client="<?php echo $rows->nom_client; ?>" numfact="<?php echo $rows->num_fact; ?>" recu="<?php echo $rows->numero; ?>" montantusd="<?php echo $rows->montantusd; ?>" montantcdf="<?php echo $rows->montantcdf; ?>" title="<?php echo LANG_TIP_PRINT; ?>"><i class="fa fa-print"></i> <?php echo LANG_PRINT; ?></a>
                                    </div>
                                </td>
                            </tr>
                        <?php
                            //Mise en session pour impression
                            array_push($_SESSION['rows_paiement']['i'], $i);
                            array_push($_SESSION['rows_paiement']['nom_client'], $rows->nom_client);
                            array_push($_SESSION['rows_paiement']['num_fact'], $rows->num_fact);
                            array_push($_SESSION['rows_paiement']['numero'], $rows->numero);
                            array_push($_SESSION['rows_paiement']['dte'], dateAffiche($rows->dte));
                            array_push($_SESSION['rows_paiement']['lib'], $rows->lib);
                            array_push($_SESSION['rows_paiement']['montant'], afficheMontant($_SESSION['Paie_affiche'], $montant));
                            //Fin mise en session
                            $i++;
                        }
                        ?>

                    </tbody>
                    <tfoot id="majdataspaie1">
                        <tr>
                            <th colspan="6">Total Cash</th>
                            <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $cash); ?></td>
                        </tr>
                        <tr>
                            <th colspan="6">Total Credit</th>
                            <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $credit); ?></td>
                        </tr>
                        <tr>
                            <th colspan="6">Total Acompte</th>
                            <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $don); ?></td>
                        </tr>
                        <tr>
                            <th colspan="6">TOTAUX</th>
                            <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $cash + $credit + $don); ?></td>
                        </tr>
                    </tfoot>
                </table>
                <?php
                //Mise en session pour impression
                $_SESSION['datedebut_paiement'] = date('d/m/Y');
                $_SESSION['datefin_paiement'] = date('d/m/Y');
                $_SESSION['cash_paiement'] = afficheMontant($_SESSION['Paie_affiche'], $cash);
                $_SESSION['credit_paiement'] = afficheMontant($_SESSION['Paie_affiche'], $credit);
                $_SESSION['don_paiement'] = afficheMontant($_SESSION['Paie_affiche'], $don);

                //Fin mise en session
                ?>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->
<!-- Modal -->
<div class="modal fade" id="modalfiltrerpaie" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">

        <form class="form-inline" id="frmfiltrerpaie" name="frmfiltrerpaie">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Filtrer paiement</h4>
                </div>
                <div class="modal-body text-center">
                    <div class="output"></div>

                    <div class="form-group">
                        <label for="dte1">Du</label>
                        <input name="datedebut" id="datedebut" type="text" value="<?php echo date('d/m/Y'); ?>" class="form-control datepicker2">
                    </div>
                    <div class="form-group">
                        <label for="dte2">au</label>
                        <input name="datefin" id="datefin" type="text" value="<?php echo date('d/m/Y'); ?>" class="form-control datepicker2">
                    </div>
                </div>
                <div class="modal-footer">
                    <div id="msg_popup" class="text-danger text-left col-md-10" style="display:none;">
                        <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
                        <span id="msg_alert_popup">Veuillez saisir les valeurs correctes dans tous les champs!</span>
                    </div>
                    <button class="btn btn-danger pull-right col-md-2" id="btnfiltrerpaie"><i class="fa fa-plus-circle fa-fw"></i>&nbsp;Valider
                    </button>
                    <span class="btn btn-info hidden pull-right" id="loader">
                        <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
                    </span>
                </div>
            </div>
            <!-- /.modal-content -->
        </form>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->