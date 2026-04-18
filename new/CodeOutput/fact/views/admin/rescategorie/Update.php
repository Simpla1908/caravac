
<?php
/*
 * =======================================================================
 * FILE NAME:        Update.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		rescategorie
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
?>


<form action="<?php echo H_ADMIN_MAIN . '&view=rescategorie&do=updatepro'; ?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
    <div class="col-12">
        <ul class="nav pull-right" style="margin-top:5px;">
            <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD; ?></label>
            <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD; ?>" />
            <a href="<?php echo H_ADMIN; ?>&view=rescategorie&id=<?php echo $rows->id; ?>&do=delete&dfile=" title="<?php echo LANG_TIP_DELETE; ?>" class="btn btn-default btn-sm tip" data-confirm="<?php echo LANG_DELETE_AUTH; ?>"><i class="fa fa-trash-o"></i> <?php echo LANG_DELETE; ?></a>
            <a href="<?php echo H_ADMIN; ?>&view=rescategorie&do=viewall" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL; ?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK; ?></a>
        </ul>
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading"><h3 class="panel-title">Modification catégorie</h3></div>

            <div class="panel-body">
                <div class="output"></div>
                <input type="hidden" name="id" value="<?php echo $rows->id; ?>">
                <input id="psedo" name="psedo" type="hidden"   value="<?php echo $rows->psedo; ?>" />
                <input id="site_id" name="site_id" type="hidden"   value="<?php echo $rows->site_id; ?>" />
                <div class="form-horizontal">
                    <div class="row">
                        <div class="col-md-10">
                            <br>
                            <div class="form-group">
                                <label for="libelle" class="col-sm-3 control-label">Désignation</label>
                                <div class="col-sm-9">
                                    <input id="libelle" name="libelle" value="<?php echo $rows->libelle; ?>" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="salbase" class="col-sm-3 control-label">Salaire de base</label>
                                <div class="col-sm-9">
                                    <input  id="salbase" name="salbase" value="<?php echo arrondir($rows->salbase); ?>" type="text" class="form-control" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="devise" class="col-sm-3 control-label">Monnaie</label>
                                <div class="col-sm-9">
                                    <select id="devise" name="devise"  class ="form-control choz">
                                       <option value="USD">USD</option>
                                        <option value="CDF">CDF</option>
                                        <option value="<?php echo $rows->devise; ?>" selected=""><?php echo $rows->devise; ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="type" class="col-sm-3 control-label">Type de paiement</label>
                                <div class="col-sm-9">
                                    <select id="type" name="type"  class="form-control choz">
                                        <option value="mensuel">mensuel</option>
                                        <option value="journalier">journalier</option>
                                        <option value="<?php echo $rows->type; ?>" selected=""><?php echo $rows->type; ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="type" class="col-sm-3 control-label">Préavis</label>
                                <div class="col-sm-9">
                                    <select id="preavis" name="preavis"  class="form-control choz">
                                        <option value="18">18 jours</option>
                                        <option value="26">26 jours</option>
                                         <option value="<?php echo $rows->preavis; ?>" selected=""><?php echo $rows->preavis.' jours'; ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer" style="border-bottom:solid 2px #CCC;"> 
                <label for="hButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD; ?></label>
                <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD; ?>" />
            </div>
        </div><!--/col-12-->
</form>
