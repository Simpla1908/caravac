<?php
/*
 * =======================================================================
 * FILE NAME:        Update.php
 * DATE CREATED:  	08-02-2018
 * FOR TABLE:  		resconfig
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
?>


<form action="<?php echo H_ADMIN_MAIN . '&view=resconfig&do=updatepro'; ?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
    <div class="col-12">
        <ul class="nav pull-right" style="margin-top:5px;margin-right:5px;">
            <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD; ?></label>
            <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD; ?>" />
        </ul>
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-reorder"></i> Configuration de base</h3>
            </div>
            <div class="panel-body">

                <div class="output"></div>

                <div class="form-horizontal">
                    <div class="row">
                        <div class="col-md-10">
                            <br>
                            <input type="hidden" name="id" value="<?php echo $rows->id; ?>">
                            <div class="form-group">
                                <label for="libelle" class="col-sm-3 control-label">Monnaie insertion</label>

                                <div class="col-sm-9">
                                    <select id="m_insert" name="m_insert" class="form-control choz">
                                        <?php if ($rows->m_insert == "CDF") { ?>
                                            <option value="<?php echo $rows->m_insert; ?>"><?php echo $rows->m_insert; ?></option>
                                            <option value="USD">USD</option>
                                        <?php } else { ?>
                                            <option value="<?php echo $rows->m_insert; ?>"><?php echo $rows->m_insert; ?></option>
                                            <option value="CDF">CDF</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="salbase" class="col-sm-3 control-label">Monnaie affichage</label>

                                <div class="col-sm-9">
                                    <select id="m_affich" name="m_affich" class="form-control choz">
                                        <?php if ($rows->m_affich == "CDF") { ?>
                                            <option value="<?php echo $rows->m_insert; ?>"><?php echo $rows->m_affich; ?></option>
                                            <option value="USD">USD</option>
                                        <?php } else { ?>
                                            <option value="<?php echo $rows->m_insert; ?>"><?php echo $rows->m_affich; ?></option>
                                            <option value="CDF">CDF</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="devise" class="col-sm-3 control-label tip" title="Taux utilisÃ© pour faire la paie">Taux</label>
                                <div class="col-sm-9">
                                    <input id="taux" name="taux" type="text" value="<?php echo $rows->taux; ?>" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="devise" class="col-sm-3 control-label tip" title="Age limite de l'enfant pour bÃ©nÃ©ficier des soins medicaux">Remise</label>
                                <div class="col-sm-9">
                                    <input id="remise" name="remise" type="text" value="<?php echo $rows->age; ?>" class="form-control" />
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="devise" class="col-sm-3 control-label tip">Mention légale</label>
                                <div class="col-sm-9">
                                    <input id="mention" name="mention" type="text" value="<?php echo $rows->infofact; ?>" class="form-control" />
                                </div>
                            </div>



                            <div class="form-group hidden">
                                <label class="control-label" for="module_id">Module Id</label>
                                <input id="module_id" name="module_id" type="text" maxlength="11" value="<?php echo $rows->module_id; ?>" class="form-control"= />
                            </div>

                            <div class="form-group hidden">
                                <label class="control-label" for="site_id">Site Id</label>
                                <input id="site_id" name="site_id" type="text" maxlength="11" value="<?php echo $rows->site_id; ?>" class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="output"></div>
            </div>
            <div class="panel-footer" style="border-bottom:solid 2px #CCC;">
                <label for="hButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD; ?></label>
                <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD; ?>" />
            </div>



        </div>
        <!--/col-12-->

</form>