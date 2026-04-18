
<?php
/*
 * =======================================================================
 * FILE NAME:        View.php
 * DATE CREATED:    17-11-2017
 * FOR TABLE:       t_client
 * PRODUCED BY:     HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:          Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
?>
<?php // AjaxSearchSuggest(''.H_ADMIN_MAIN.'&view=t_client&do=autosearch');  ?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">

            <div class="box-header with-border">
                <h3 class="box-title" id="titlecl">Liste des reservations du <?php echo dateAffiche($datedebut); ?> au <?php echo dateAffiche($datefin); ?></h3>
                <ul class="nav pull-right">
                <a href="<?php echo H_ADMIN; ?>&view=t_client&do=viewall" class="btn btn-default btn-xs tip hidden" title="Liste des clients"><i class="fa fa-users"></i> Liste des clients</a>
                <a href="<?php echo H_ADMIN; ?>&view=t_client&do=reservation" class="btn btn-default btn-xs tip hidden" title="Liste des reservations"><i class="fa fa-users"></i> Reservations</a>
                <a href="<?php echo H_ADMIN; ?>&view=t_client&do=occupation" class="btn btn-default btn-xs tip hidden" title="Liste des occupations"><i class="fa fa-users"></i> Occupations</a>
                <a href="<?php echo H_ADMIN; ?>&view=t_client&do=liberation" class="btn btn-default btn-xs tip hidden" title="Liste des libérations"><i class="fa fa-users"></i> Libérations</a>
                <a  class="btn btn-default btn-xs tip" title="Filtrage des reservations" data-toggle="modal" data-target="#modalfiltrerr"><i class="fa fa-sort"></i> Filtrer</a>
                <a  href="./main.php?pg=admin&view=impression&do=listereservations" target="_blank"  class="btn btn-default btn-xs tip" title="Imprimer la liste">
                            <i class="fa fa-print"></i> Imprimer
                </a>
                </ul>

            </div><!-- /.box-header -->
            <div class="box-body" id="contentdatafilter">
               <?php
                include 'datasreservation.php';
                ?>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->
<div class="modal fade" id="modalfiltrerr" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">

        <form class="form-inline frmfiltrerr" id="frmfiltrerr">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Filtrage des reservations</h4>
                </div>
                <div class="modal-body text-center">
                    <div class="form-group">
                        <label for="dte1">Du</label>
                        <input name="dte1" id="dte1"  type="text" value="<?php echo dateAffiche($datedebut); ?>" class="form-control datepicker2"> 
                    </div>
                    <div class="form-group">
                        <label for="dte2">au</label>
                        <input name="dte2" id="dte2"  type="text" value="<?php echo dateAffiche($datefin); ?>" class="form-control datepicker2">
                    </div>
                </div>
                <div class="modal-footer">
                    <button  class="btn btn-danger pull-right col-md-2" id="btnfiltrerr">
                        <i class="fa fa-plus-circle fa-fw"></i>&nbsp;Valider
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </form>
    </div>
    <!-- /.modal-dialog -->
</div>