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
                <div class="row">
                    <div class="col-sm-7">
                        <h3 class="box-title titrepg">Recettes <span id="descrpt"> <?php echo $description; ?></span></h3>
                    </div>
                    <div class="col-sm-5">
                        <ul class="nav pull-right">
                            <input type="radio" name="choixrecette" id="optionsRadios1" value="jour" checked="">
                            par jour
                            <input type="radio" name="choixrecette" id="optionsRadios2" value="client">
                            par client
                            <a class="btn btn-default btn-xs tip" title="Filtrer les recettes" data-toggle="modal" data-target="#modalfiltrerpaie"><i class="fa fa-sort"></i> Filtrer</a>
                            <a style="margin-left:2px;margin-top:2.5px" href="#" id="printrecette" class="btn btn-default btn-xs pull-right printrecette"><i class="fa fa-print"></i> Imprimer</a>

                        </ul>
                    </div>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body" id='blcrctcl'>
                <?php include(APP_FOLDER . '/views/admin/t_reservation/datarecettejr.php'); ?>
            </div>
            <!--       <div class="col-xs-12" style="margin-top:10px">
                <a href="#" id="printrecette" class="btn btn-default pull-right printrecette"><i class="fa fa-print"></i> Imprimer</a>
            </div> -->
            <!-- /.box-body -->
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
                    <h4 class="modal-title" id="myModalLabel">Filtrage des récettes</h4>
                </div>
                <div class="modal-body text-center">
                    <div class="output"></div>
                    <input name="typerecette" id="typerecette" type="hidden" value="jour">
                    <div class="form-group">
                        <label for="dte1">Du</label>
                        <input name="datedebut" id="datedebut" type="text" value="<?php echo $dte1_af; ?>" class="form-control datepicker2">
                    </div>
                    <div class="form-group">
                        <label for="dte2">au</label>
                        <input name="datefin" id="datefin" type="text" value="<?php echo $dte2_af; ?>" class="form-control datepicker2">
                    </div>
                </div>
                <div class="modal-footer">
                    <div id="msg_popup" class="text-danger text-left col-md-10" style="display:none;">
                        <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
                        <span id="msg_alert_popup">Veuillez saisir les valeurs correctes dans tous les champs!</span>
                    </div>
                    <button class="btn btn-danger pull-right col-md-2" id="btnfilrecet2"><i class="fa fa-plus-circle fa-fw"></i>&nbsp;Valider
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