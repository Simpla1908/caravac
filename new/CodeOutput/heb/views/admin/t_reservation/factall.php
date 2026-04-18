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
<div class="row">
    <div class="col-xs-12">
        <div class="box">

            <div class="box-header with-border">
                <h3 class="box-title titrepg">Factures du <span id="spdte"><?php echo dateAffiche($dte1) . ' au ' . dateAffiche($dte2); ?></span></h3>
                <ul class="nav pull-right">
                    <a class="btn btn-default btn-xs tip" title="Filtrage des factures" data-toggle="modal" data-target="#modalfiltrerpaie"><i class="fa fa-sort"></i> Filtrer</a>
                    <a href="./main.php?pg=admin&view=impression&do=pfact&f=cash" target="_blank" class="btn btn-default btn-xs tip" title="Imprimer la liste" id="factcash">
                        <i class="fa fa-print"></i> Imprimer
                    </a>
                    <a href="./main.php?pg=admin&view=impression&do=pfact&f=credit" target="_blank" class="btn btn-default btn-xs tip" title="Imprimer la liste" id="factcredit" style="display: none;">
                        <i class="fa fa-print"></i> Imprimer
                    </a>
                </ul>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active onglet_fact" id="cash"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Factures Cash</a></li>
                        <li class="onglet_fact" id="credit"><a href="#tab_2" data-toggle="tab" aria-expanded="false">Factures Crédit</a></li>
                        <li class="onglet_fact" id="don"><a href="#tab_3" data-toggle="tab" aria-expanded="false">Factures Don</a></li>
                        <li class="onglet_fact" id="resannul"><a href="#tab_4" data-toggle="tab" aria-expanded="false">Factures annulées</a></li>
                        <!--<li class="pull-right"><a href="#" title="Imprimer" class="text-muted tip"><i class="fa fa-print"></i></a></li>-->
                    </ul>
                    <div class="tab-content" id="contenu">
                        <?php include(APP_FOLDER . '/views/admin/t_reservation/datafacttout.php'); ?>
                    </div>
                    <!-- /.tab-content -->
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->
<!-- Modal -->
<div class="modal fade" id="modalfiltrerpaie" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="max-width:700px">

        <form class="form-inline frmfilterdte" id="frmfilterdte">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Filtrage des factures</h4>
                </div>
                <div class="modal-body text-center">
                    <div class="output"></div>
                    <div class="form-group">
                        <select class="form-control" name="respo_id" id="respo_id" style="width:150px;">
                            <option value="0">All</option>
                            <?php foreach ($responsables as $rows) { ?>
                                <option value="<?php echo $rows->id_respo ?>"><?php echo $rows->entreprise ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="dte1">Du</label>
                        <input name="dte1" id="dte1fct" type="text" value="<?php echo dateAffiche($dte1); ?>" class="form-control datepicker2">
                    </div>
                    <div class="form-group">
                        <label for="dte2">au</label>
                        <input name="dte2" id="dte2fct" type="text" value="<?php echo dateAffiche($dte2); ?>" class="form-control datepicker2">
                    </div>
                    <input name="view" id="view" type="hidden" value="t_reservation">
                    <input name="todo" id="todo" type="hidden" value="factallajx">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger pull-right col-md-2" id="filterfactbtn">
                        <i class="fa fa-plus-circle fa-fw"></i>&nbsp;Valider
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </form>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->