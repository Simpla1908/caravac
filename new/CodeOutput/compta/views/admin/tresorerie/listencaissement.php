
<?php
/*
 * =======================================================================
 * FILE NAME:        View.php
 * DATE CREATED:  	18-04-2019
 * FOR TABLE:  		cptjournal
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
?>
<?php AjaxSearchSuggest('' . H_ADMIN_MAIN . '&view=cptjournal&do=autosearch'); 

?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">

            <div class="box-header with-border">
                <h3 class="box-title" id="titlecl">Encaissement du <?php echo dateAffiche($datedebut); ?> au <?php echo dateAffiche($datefin); ?></h3>
                &nbsp;&nbsp;<a class="btn btn-primary btn-flat"><b>SOLDE CDF <?php echo FormatChiffreCompta($solde_caisse_fc_normal); ?></b></a>
                &nbsp;&nbsp;<a class="btn btn-success btn-flat"><b>SOLDE USD <?php echo FormatChiffreCompta($solde_caisse_usd_normal); ?></b></a>
                <ul class="nav pull-right">
                    <?php if (in_array('CPTAJOUTTRES', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
                    <a href="<?php echo H_ADMIN; ?>&view=tresorerie&do=encaissement" class="btn btn-primary btn-flat" title="<?php echo LANG_TIP_ADD; ?>"><i class="fa fa-plus"></i> Encaisser</a>
                    <?php } ?>
                    <a href="#" title="Filtrage des encaissements" data-toggle="modal" data-target="#modalfiltrerencaisse" class="btn btn-danger btn-flat" ><i class="fa fa-table"></i> Filtrer </a>
                    <a href="./main.php?pg=admin&view=impression&do=encaissementliste" target="_blank" class="btn btn-success btn-flat" title="<?php echo LANG_TIP_PRINT; ?>"><i class="fa fa-print"></i> Imprimer</a>
                </ul>

            </div><!-- /.box-header -->
            <div class="box-body" id="contentdatafilter">
                <?php
                include 'datasencaissement.php';
                ?>

            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->


<div class="modal fade" id="modalfiltrerencaisse" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">

        <form id="frmfiltrerencaisse">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Filtrage des encaissements</h4>
                </div>
                <div class="modal-body text-center">
                    <div class="form-group">
                        <label for="monnaie">Monnaie</label>
                        <select name="monnaie" class="form-control select2" style="width: 300px;" id="monnaie">
                            <option value="CDF">CDF</option>
                            <option value="USD">USD</option>
                        </select>
                    </div>
                    <div class="form-inline">
                        <div class="form-group">
                            <label for="dte1">Du</label>
                            <input name="dte1" id="dte1"  type="text" value="<?php // echo dateAffiche($datedebut); ?>" class="form-control datepicker2"> 
                        </div>
                        <div class="form-group">
                            <label for="dte2">au</label>
                            <input name="dte2" id="dte2"  type="text" value="<?php // echo dateAffiche($datefin); ?>" class="form-control datepicker2">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button  class="btn btn-danger pull-right col-md-2" id="btnfiltrerencaisse">
                        <i class="fa fa-plus-circle fa-fw"></i>&nbsp;Valider
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </form>
    </div>
    <!-- /.modal-dialog -->
</div>