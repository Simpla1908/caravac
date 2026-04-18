
<?php
/*
 * =======================================================================
 * FILE NAME:        Add.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		ressalaire
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
?>
<form class="resiliation_frm" action="<?php echo H_ADMIN_MAIN . '&view=ressalaire&do=addecompte'; ?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
    <div class="col-12">
        <ul class="nav pull-right" style="margin-top:5px;">
            <label for="hButton" class="btn btn-info btn-sm hidden" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD; ?></label>
            <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_CREATE_RECORD; ?>" />
            <a href="<?php echo H_ADMIN; ?>&view=ressalaire&do=resiliation" class="btn btn-default btn-sm tip" title="<?php echo 'Voir la liste des résiliations'; ?>"></i> <?php echo 'Retour'; ?></a>
        </ul>
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">
                <h3 class="panel-title">Résiliation  
                </h3></div>
            <div class="panel-body">
                <div class="output"></div>
                <div class="form-horizontal">
                    <div class="row">
                        <div class="col-md-10">
                            <br>
                            <div class="form-group">
                                <label for="libelle" class="col-sm-3 control-label">Employé</label>
                                <div class="col-sm-9" id="employe_bloc">
                                    <?php include(APP_FOLDER . '/views/admin/ressalaire/Employescombo.php'); ?>
                                </div>
                            </div>
                            <input id="dte" name="dte" type="hidden" value="<?php echo date('Y-m-d'); ?>">
                            <input id="psedo" name="psedo" type="hidden" value="0">
                            <input id="libelle" name="libelle" type="hidden" value="">
                            <input id="site_id" name="site_id" type="hidden" value="<?php echo $_SESSION['idsite']; ?>">
                            <input id="salbase" name="salbase" type="hidden" value="0">
                            <input id="montantjr" name="montantjr" type="hidden" value="0">
                            <input id="dteng" name="dteng" type="hidden" value="">
                            <input id="devise" name="devise" type="hidden" >
                            <input id="idcat" name="idcat" type="hidden" >
                            <input id="matricule" name="matricule" type="hidden" >
                            <input id="fonction" name="fonction" type="hidden" >
                            <input id="nbrenf" name="nbrenf" type="hidden" >
                            <input id="nbjrtransport" name="nbjrtransport" type="hidden" >
                            <div class="form-group">
                                <label for="dteng" class="col-sm-3 control-label">Date d'engagement</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input  name="dteng" type="hidden" class="form-control datepicker2 dteng">
                                            <input  type="text" class="form-control presence nbre datepicker2 dteng2" disabled="">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label">Date de fin contrat</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input  name="dtfin" type="text" value="<?php echo date('d/m/Y'); ?>" class="form-control datepicker2">
                                        </div>
                                    </div> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="anciennete" class="col-sm-3 control-label">Ancienneté</label>
                                <div class="col-sm-9">
                                    <input  type="hidden" name="anciennete" value="" class="form-control anciennete " >
                                    <input  type="text" value="" class="form-control anciennete" disabled="">
                                    <input name="preavis" id="preavis"  type="hidden" value="" class="form-control preavis">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="periode" class="col-sm-3 control-label">Motif</label>
                                <div class="col-sm-9" id="lstmotif_bloc">
                                    <?php include(APP_FOLDER . '/views/admin/ressalaire/lstmotifdecompte.php'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label"></label>
                                <div class="col-sm-9" id="bloc_emprubrique">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="output"></div>
            </div>
            <div class="panel-footer" style="border-bottom:solid 2px #CCC;">
                <button type="submit" class="btn btn-info" id="btn_valider_decompte"><i class="fa fa-floppy-o"></i> Valider</button>
                <label for="hButton" class="btn btn-info hidden" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD; ?></label>
                <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_CREATE_RECORD; ?>" />
            </div>

        </div><!--/col-12-->
</form>
