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
<form action="<?php echo H_ADMIN_MAIN . '&view=fidelite_programme&do=updatepro'; ?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
    <div class="col-12">

        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">
                <h3 class="panel-title">Programme de fidelité</h3>
            </div>

            <div class="panel-body">
                <div class="output"></div>
                <input type="hidden" name="id" value="<?php echo $rows->id; ?>">
                <input id="psedo" name="psedo" type="hidden" value="<?php echo $rows->psedo; ?>" />
                <input id="site_id" name="site_id" type="hidden" value="<?php echo $rows->site_id; ?>" />
                <div class="form-horizontal">
                    <div class="row">
                        <div class="col-md-10">
                            <br>
                            <div class="form-group">
                                <label for="libelle" class="col-sm-3 control-label">Désignation</label>
                                <div class="col-sm-9">
                                    <input id="des" name="des" value="<?php echo $rows->des; ?>" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="salbase" class="col-sm-3 control-label">Montant Depensé</label>
                                <div class="col-sm-9">
                                    <input id="montantdep" name="montantdep" value="<?php echo arrondir($rows->montantdep); ?>" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="salbase" class="col-sm-3 control-label">Equivalent en Point(s)</label>
                                <div class="col-sm-9">
                                    <input id="points" name="points" value="<?php echo $rows->points; ?>" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="salbase" class="col-sm-3 control-label">Montant Remise</label>
                                <div class="col-sm-9">
                                    <input id="montant" name="montant" value="<?php echo arrondir($rows->montant); ?>" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="devise" class="col-sm-3 control-label">Devise</label>
                                <div class="col-sm-9">
                                    <select id="devise" name="devise" class="form-control choz">
                                        <option value="USD">USD</option>
                                        <option value="CDF">CDF</option>
                                        <option value="<?php echo $rows->devise; ?>" selected=""><?php echo $rows->devise; ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="salbase" class="col-sm-3 control-label">Taux</label>
                                <div class="col-sm-9">
                                    <input id="taux" name="taux" value="<?php echo $rows->taux; ?>" type="text" class="form-control">
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
        </div>
        <!--/col-12-->
</form>