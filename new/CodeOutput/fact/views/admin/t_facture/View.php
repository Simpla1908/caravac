<?php
/*
 * =======================================================================
 * FILE NAME:        View.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		t_facture
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
?>
<?php // AjaxSearchSuggest(''.H_ADMIN_MAIN.'&view=t_facture&do=autosearch'); 
?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo $libellefact . ' du ' ?> <span id="spdebut"><?php echo date('d/m/Y'); ?></span> au <span id="spfin"><?php echo date('d/m/Y'); ?></span> </h3>
                <ul class="nav pull-right">
                    <a href="<?php echo H_ADMIN; ?>&view=t_facture&do=add&f=<?php echo $f; ?>" class="btn btn-primary btn-sm tip" title="<?php echo LANG_TIP_ADD; ?>"><i class="fa fa-plus"></i> <?php echo LANG_ADD; ?></a>
                    <a class="btn btn-default btn-sm tip" title="Filtrer les paiements" data-toggle="modal" data-target="#modalfiltrerpaie"><i class="fa fa-sort"></i> Filtrer</a>
                    <!--<a href="#" id="impressionliste_fact" target="_blank" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_PRINT; ?>"><i class="fa fa-print"></i> <?php echo LANG_PRINT; ?></a>-->
                    <!--<a href="<?php echo H_ADMIN_MAIN; ?>&view=t_facture&do=export&hexport=yes&etype=excel" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_EXCEL; ?>"><i class="fa fa-table"></i> <?php echo LANG_EXCEL; ?></a>-->
                    <!--<a href="<?php echo H_ADMIN_MAIN; ?>&view=t_facture&do=export&hexport=yes&etype=word" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_WORD; ?>"><i class="fa fa-file-o"></i> <?php echo LANG_WORD; ?></a>-->
                    <!--<a href="<?php echo H_ADMIN; ?>&view=t_facture&do=truncate" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_TRUNCATE; ?>" data-confirm="<?php echo LANG_DELETE_AUTH; ?>"><i class="fa fa-trash-o"></i> <?php echo LANG_TRUNCATE; ?></a>-->
                </ul>

            </div><!-- /.box-header -->
            <div class="box-body">
                <?php if ($f == 1) { ?>
                    <!-- Custom Tabs -->
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <!--<li><a href="#tab_0" data-toggle="tab">All</a></li>-->
                            <li class="active"><a href="#tab_1" data-toggle="tab" class="tabfact" id="Cash">Factures cash</a></li>
                            <li><a href="#tab_2" data-toggle="tab" class="tabfact" id="Acompte">Factures acompte</a></li>
                            <li><a href="#tab_3" data-toggle="tab" class="tabfact" id="Crédit">Factures crédit</a></li>
                            <input type="hidden" id="modef" value="Cash" />
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                <a href="main.php?pg=admin&view=impression&do=prnt_listfact&mode=Cash" target="_blank" class="btn btn-default btn-sm tip pull-right" title="<?php echo LANG_TIP_PRINT; ?>"><i class="fa fa-print"></i> <?php echo LANG_PRINT; ?></a><br><br>
                                <table data-page="false" class="table table-bordered table-hover table-striped table-condensed t1 t2" data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE; ?>" data-page-previous-text="<?php echo LANG_PREVIOUS; ?>" data-page-next-text="<?php echo LANG_NEXT; ?>">
                                    <thead>
                                        <tr>
                                            <th>Numero</th>
                                            <th data-hide="phone,tablet">Edition</th>
                                            <th data-hide="phone,tablet">Echéance</th>
                                            <th data-hide="phone,tablet">Client</th>
                                            <th data-hide="phone,tablet">Montant total</th>
                                            <th data-hide="phone,tablet">Montant payé</th>
                                            <th data-hide="phone,tablet">Solde</th>
                                            <th data-sort-ignore="true"><?php echo LANG_ACTIONS; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody id="lignetab">
                                        <?php include(APP_FOLDER . '/views/admin/t_facture/datalignesfact.php'); ?>
                                    </tbody>
                                    <tfoot id="majdataspaie1">
                                        <tr>
                                            <th colspan="4">TOTAL</th>
                                            <th><?php echo afficheMontant($_SESSION['Paie_affiche'], $montant_tot); ?></th>
                                            <th><?php echo afficheMontant($_SESSION['Paie_affiche'], $montant_paie); ?></th>
                                            <th><?php echo afficheMontant($_SESSION['Paie_affiche'], $soldetot); ?></th>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                    <?php
                                    //Mise en session pour impression
                                    $_SESSION['datedebut_fact'] = date('d/m/Y');
                                    $_SESSION['datefin_fact'] = date('d/m/Y');
                                    $_SESSION['cashmontant_tot'] = afficheMontant($_SESSION['Paie_affiche'], $montant_tot);
                                    $_SESSION['cashmontant_paie'] = afficheMontant($_SESSION['Paie_affiche'], $montant_paie);
                                    $_SESSION['cashsoldetot'] = afficheMontant($_SESSION['Paie_affiche'], $soldetot);
                                    //Fin mise en session
                                    ?>
                                </table>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_2">
                                <a href="main.php?pg=admin&view=impression&do=prnt_listfact&mode=Acompte" target="_blank" class="btn btn-default btn-sm tip pull-right" title="<?php echo LANG_TIP_PRINT; ?>"><i class="fa fa-print"></i> <?php echo LANG_PRINT; ?></a><br><br>
                                <table data-page="false" class="table table-bordered table-hover table-striped table-condensed t1 t2" data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE; ?>" data-page-previous-text="<?php echo LANG_PREVIOUS; ?>" data-page-next-text="<?php echo LANG_NEXT; ?>">
                                    <thead>
                                        <tr>
                                            <th>Numero</th>
                                            <th data-hide="phone,tablet">Edition</th>
                                            <th data-hide="phone,tablet">Echéance</th>
                                            <th data-hide="phone,tablet">Client</th>
                                            <th data-hide="phone,tablet">Montant total</th>
                                            <th data-hide="phone,tablet">Montant payé</th>
                                            <th data-hide="phone,tablet">Solde</th>
                                            <th data-sort-ignore="true"><?php echo LANG_ACTIONS; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody id="lignetab2">
                                        <?php include(APP_FOLDER . '/views/admin/t_facture/datalignesfactacompte.php'); ?>
                                    </tbody>
                                    <tfoot id="majdataspaie1">
                                        <tr>
                                            <th colspan="4">TOTAL</th>
                                            <th><?php echo afficheMontant($_SESSION['Paie_affiche'], $montant_tot); ?></th>
                                            <th><?php echo afficheMontant($_SESSION['Paie_affiche'], $montant_paie); ?></th>
                                            <th><?php echo afficheMontant($_SESSION['Paie_affiche'], $soldetot); ?></th>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                    <?php
                                    //Mise en session pour impression
                                    $_SESSION['datedebut_fact'] = date('d/m/Y');
                                    $_SESSION['datefin_fact'] = date('d/m/Y');
                                    $_SESSION['acomptemontant_tot'] = afficheMontant($_SESSION['Paie_affiche'], $montant_tot);
                                    $_SESSION['acomptemontant_paie'] = afficheMontant($_SESSION['Paie_affiche'], $montant_paie);
                                    $_SESSION['acomptesoldetot'] = afficheMontant($_SESSION['Paie_affiche'], $soldetot);
                                    //Fin mise en session
                                    ?>
                                </table>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_3">
                                <a href="main.php?pg=admin&view=impression&do=prnt_listfact&mode=Crédit" target="_blank" class="btn btn-default btn-sm tip pull-right" title="<?php echo LANG_TIP_PRINT; ?>"><i class="fa fa-print"></i> <?php echo LANG_PRINT; ?></a><br><br>
                                <table data-page="false" class="table table-bordered table-hover table-striped table-condensed t1 t2" data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE; ?>" data-page-previous-text="<?php echo LANG_PREVIOUS; ?>" data-page-next-text="<?php echo LANG_NEXT; ?>">
                                    <thead>
                                        <tr>
                                            <th>Numero</th>
                                            <th data-hide="phone,tablet">Edition</th>
                                            <th data-hide="phone,tablet">Echéance</th>
                                            <th data-hide="phone,tablet">Client</th>
                                            <th data-hide="phone,tablet">Montant total</th>
                                            <th data-hide="phone,tablet">Montant payé</th>
                                            <th data-hide="phone,tablet">Solde</th>
                                            <th data-sort-ignore="true"><?php echo LANG_ACTIONS; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody id="lignetab1">
                                        <?php include(APP_FOLDER . '/views/admin/t_facture/datalignesfactacredit.php'); ?>
                                    </tbody>
                                    <tfoot id="majdataspaie1">
                                        <tr>
                                            <th colspan="4">TOTAL</th>
                                            <th><?php echo afficheMontant($_SESSION['Paie_affiche'], $montant_tot); ?></th>
                                            <th><?php echo afficheMontant($_SESSION['Paie_affiche'], $montant_paie); ?></th>
                                            <th><?php echo afficheMontant($_SESSION['Paie_affiche'], $soldetot); ?></th>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                    <?php
                                    //Mise en session pour impression
                                    $_SESSION['datedebut_fact'] = date('d/m/Y');
                                    $_SESSION['datefin_fact'] = date('d/m/Y');
                                    $_SESSION['creditmontant_tot'] = afficheMontant($_SESSION['Paie_affiche'], $montant_tot);
                                    $_SESSION['creditmontant_paie'] = afficheMontant($_SESSION['Paie_affiche'], $montant_paie);
                                    $_SESSION['creditsoldetot'] = afficheMontant($_SESSION['Paie_affiche'], $soldetot);
                                    //Fin mise en session
                                    ?>
                                </table>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- nav-tabs-custom -->
                <?php } else { ?>
                    <input type="hidden" id="modef" value="Proformat" />
                    <table data-page="false" class="table table-bordered table-hover table-striped table-condensed t1 t2" data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE; ?>" data-page-previous-text="<?php echo LANG_PREVIOUS; ?>" data-page-next-text="<?php echo LANG_NEXT; ?>">
                        <thead>
                            <tr>
                                <th>Numero</th>
                                <th data-hide="phone,tablet">Edition</th>
                                <th data-hide="phone,tablet">Echéance</th>
                                <th data-hide="phone,tablet">Client</th>
                                <th data-hide="phone,tablet">Montant total</th>
                                <th data-hide="phone,tablet">Montant payé</th>
                                <th data-hide="phone,tablet">Solde</th>
                                <th data-sort-ignore="true"><?php echo LANG_ACTIONS; ?></th>
                            </tr>
                        </thead>
                        <tbody id="lignetabpro">
                            <?php include(APP_FOLDER . '/views/admin/t_facture/datalignesfact_proformat.php'); ?>
                        </tbody>
                        <tfoot id="majdataspaie1">
                            <tr>
                                <th colspan="4">TOTAL</th>
                                <th><?php echo afficheMontant($_SESSION['Paie_affiche'], $montant_tot); ?></th>
                                <th><?php echo afficheMontant($_SESSION['Paie_affiche'], $montant_paie); ?></th>
                                <th><?php echo afficheMontant($_SESSION['Paie_affiche'], $soldetot); ?></th>
                                <td></td>
                            </tr>
                        </tfoot>
                        <?php
                        //Mise en session pour impression
                        $_SESSION['datedebut_fact'] = date('d/m/Y');
                        $_SESSION['datefin_fact'] = date('d/m/Y');
                        $_SESSION['proformatmontant_tot'] = afficheMontant($_SESSION['Paie_affiche'], $montant_tot);
                        $_SESSION['proformatmontant_paie'] = afficheMontant($_SESSION['Paie_affiche'], $montant_paie);
                        $_SESSION['proformatsoldetot'] = afficheMontant($_SESSION['Paie_affiche'], $soldetot);
                        //Fin mise en session
                        ?>
                    </table>
                <?php } ?>

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
                    <h4 class="modal-title" id="myModalLabel">Filtrage liste factures</h4>
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
                    <input name="f" id="f" type="hidden" value="<?php echo $f; ?>">
                </div>
                <div class="modal-footer">
                    <div id="msg_popup" class="text-danger text-left col-md-10" style="display:none;">
                        <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
                        <span id="msg_alert_popup">Veuillez saisir les valeurs correctes dans tous les champs!</span>
                    </div>
                    <button class="btn btn-danger pull-right col-md-2" id="btnfiltrerfacture"><i class="fa fa-plus-circle fa-fw"></i>&nbsp;Valider
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