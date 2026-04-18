
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
                <h3 class="box-title titrepg">Factures <span id="txt_fct">clients logés</span> </h3>
                <ul class="nav pull-right">
                    <a  class="btn btn-default btn-xs tip" title="Filtrage des factures" data-toggle="modal" data-target="#modalfiltrerpaie"><i class="fa fa-sort"></i> Filtrer</a>
                </ul>

            </div><!-- /.box-header -->
            <div class="box-body">

                <!--AUTO COMPLETE-->
                <div class="col-md-3 autosearch hidden">
                    <div class=" s-absolute">
                        <div class="input-group">
                            <input type="text" class="form-control input-sm styler" id="inputString" onkeyup="lookup(this.value);"  placeholder="search" autocomplete="off">
                            <span class="input-group-btn">
                                <button class="btn btn-default btn-sm" type="button"><span class="fa fa-search"></span></button>
                            </span>
                        </div><!-- /input-group -->
                        <div id="suggestions"></div>
                    </div>
                </div><!--/col-lg-3--> 
                <!--/AUTO COMPLETE-->

                <table data-page="false" class="table table-bordered table-hover table-striped table-condensed t1 t2" data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE; ?>" data-page-previous-text="<?php echo LANG_PREVIOUS; ?>" data-page-next-text="<?php echo LANG_NEXT; ?>">
                    <thead>
                        <tr>
                            <th>Numéro</th>
                            <th data-hide="phone,tablet">Client</th>
                            <th data-hide="phone,tablet">Responsable</th>
                             <th data-hide="phone,tablet">Edition</th>
                            <th data-hide="phone,tablet">Arrivée</th>
                            <th data-hide="phone,tablet">Départ</th>
                            <!--<th data-hide="phone,tablet">Nuitée</th>-->
                            <th data-hide="phone,tablet">Total TTC</th>
                            <th data-hide="phone,tablet">Total Payé</th>
                            <th data-hide="phone,tablet">Reste</th>
                            <th data-sort-ignore="true"><?php echo LANG_ACTIONS; ?></th>
                        </tr>
                    </thead>
                    <tbody id="contenu"> 
                       <?php  include(APP_FOLDER . '/views/admin/t_reservation/datafacture.php');?>
                    </tbody>

                </table>

            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->
<!-- Modal -->
<div class="modal fade" id="modalfiltrerpaie" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">

        <form class="form-inline frmfilterdte" id="frmfilterdte">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Filtrage des factures</h4>
                </div>
                <div class="modal-body text-center">
                    <div class="output"></div>

                    <div class="form-group">
                        <label for="dte1">Du</label>
                        <input name="dte1"  type="text" value="<?php echo dateAffiche($dte1); ?>" class="form-control datepicker2"> 
                    </div>
                    <div class="form-group">
                        <label for="dte2">au</label>
                        <input name="dte2"  type="text" value="<?php echo dateAffiche($dte2); ?>" class="form-control datepicker2">
                    </div>
                    <input name="view" id="view" type="hidden" value="t_reservation" >
                    <input name="todo" id="todo" type="hidden" value="factallajx" >
                </div>
                <div class="modal-footer">
                    <button  class="btn btn-danger pull-right col-md-2 btn_filterdte">
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