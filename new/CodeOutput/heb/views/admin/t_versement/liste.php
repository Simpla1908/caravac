<?php
/*
 * =======================================================================
 * FILE NAME:        View.php
 * DATE CREATED:     17-11-2017
 * FOR TABLE:        t_versement
 * PRODUCED BY:      HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:           Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">

            <div class="box-header with-border">
                <h3 class="box-title" id="titlevers">Versements du <?php echo dateAffiche($datedebut); ?> au <?php echo dateAffiche($datefin); ?></h3>
                <ul class="nav pull-right">
                    <?php //if (in_array('HENRVSM', $_SESSION['actions']['code_actions'])&& $_SESSION['type_user'] == 1) { 
                    ?>
                    <!-- <a href="#" data-toggle="modal" data-target="#myModal_versement2" class="btn btn-default btn-xs tip"><i class="fa fa-plus"></i> Verser</a> -->
                    <?php //} 
                    ?>
                    <?php if (in_array('HENRVSM', $_SESSION['actions']['code_actions'])) { ?>
                        <a href="#" class="btn btn-default btn-xs tip modal_versement"><i class="fa fa-plus"></i> Verser</a>
                    <?php } ?>
                    <a class="btn btn-default btn-xs tip" title="Filtrage des versements" data-toggle="modal" data-target="#modalfiltrerpaie"><i class="fa fa-sort"></i> Filtrer</a>
                    <a href="#" class="btn btn-primary btn-xs printversement"><i class="fa fa-print"></i> Imprimer </a>

                </ul>

            </div><!-- /.box-header -->
            <?php if (in_array('HLTVMT', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
                <div class="box-body" id="contentdatafilter">
                    <?php include('alldata.php'); ?>
                </div>
            <?php } ?>
            <!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->
<!-- Modal -->
<div class="modal fade" id="modalfiltrerpaie" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">

        <form class="form-inline frmfiltervers" id="frmfiltervers">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Filtrage des versement</h4>
                </div>
                <div class="modal-body text-center">
                    <div class="form-group">
                        <label for="dte1">Du</label>
                        <input name="dte1" id="dte1" type="text" value="<?php echo dateAffiche($datedebut); ?>" class="form-control datepicker2">
                    </div>
                    <div class="form-group">
                        <label for="dte2">au</label>
                        <input name="dte2" id="dte2" type="text" value="<?php echo dateAffiche($datefin); ?>" class="form-control datepicker2">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger pull-right col-md-2" id="btn_filtervers">
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
<?php
include 'popup_versement.php';
include 'popup_versement2.php';
?>