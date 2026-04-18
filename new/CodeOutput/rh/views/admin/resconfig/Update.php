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
                            <div class="form-group hidden">
                                <label for="nomcomp" class="col-sm-3 control-label">Nom compagnie</label>
                                <div class="col-sm-9">
                                    <input id="nomcomp" name="nomcomp" type="text" value="<?php echo $rows->nomcomp; ?>" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group hidden">
                                <label for="adrcomp" class="col-sm-3 control-label tip" title="Adresse de la compagnie">Adresse</label>
                                <div class="col-sm-9">
                                    <input id="adrcomp" name="adrcomp" type="text" value="<?php echo $rows->adrcomp; ?>" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group hidden">
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
                            <div class="form-group hidden">
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
                            <div class="form-group hidden">
                                <label for="devise" class="col-sm-3 control-label tip" title="Taux utilisÃ© pour faire la paie">Taux</label>
                                <div class="col-sm-9">
                                    <input id="taux" name="taux" type="text" value="<?php echo $rows->taux; ?>" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="devise" class="col-sm-3 control-label tip" title="Age limite de l'enfant pour bÃ©nÃ©ficier des soins medicaux">Age</label>
                                <div class="col-sm-9">
                                    <input id="age" name="age" type="text" value="<?php echo $rows->age; ?>" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="penalite" class="col-sm-3 control-label">Pointage</label>
                                <div class="col-sm-9">
                                    <select id="pointage" name="pointage" class="form-control choz">
                                        <?php if ($rows->pointage == 1) { ?>
                                            <option value="0">journalier</option>
                                            <option value="1" selected="">mensuel</option>
                                        <?php } else { ?>
                                            <option value="0" selected="">journalier</option>
                                            <option value="1">mensuel</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="penalite" class="col-sm-3 control-label">Pénalité sur les absences</label>
                                <div class="col-sm-9">
                                    <select id="penalite" name="penalite" class="form-control choz">
                                        <option value="0">Ne rien faire</option>
                                        <option value="1">Retenue montant transport équivalent</option>
                                        <option value="2">Retenue montant salaire de base équivalent</option>
                                        <option value="3">Retenue montant salaire de base et transport équivalents</option>
                                        <option value="<?php echo $rows->penalite; ?>" selected="selected"><?php echo GetPenalite($rows->penalite); ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="devise" class="col-sm-3 control-label tip" title="Nom de l'hopital partenaire Ã  la compagnie">Hopital</label>
                                <div class="col-sm-9">
                                    <input id="hopital" name="hopital" type="text" value="<?php echo $rows->hopital; ?>" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="devise" class="col-sm-3 control-label tip" title="Préfixe de la sanction">Préfixe congé</label>
                                <div class="col-sm-9">
                                    <input id="prefconge" name="prefconge" type="text" value="<?php echo $rows->prefconge; ?>" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="devise" class="col-sm-3 control-label tip" title="Préfixe de la sanction">Préfixe sanction</label>
                                <div class="col-sm-9">
                                    <input id="prefsanct" name="prefsanct" type="text" value="<?php echo $rows->prefsanct; ?>" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="devise" class="col-sm-3 control-label">Fuseau horaire</label>
                                <div class="col-sm-9">
                                    <select id="fuseauhoraire" name="fuseauhoraire" class="form-control choz">
                                        <option value="<?php echo $rows->fuseauhoraire; ?>"><?php echo $rows->fuseauhoraire; ?></option>
                                        <?php foreach ($tmz as $tmz) { ?>
                                            <option value="<?php echo $tmz->timezone_detail; ?>"><?php echo $tmz->timezone_detail; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group hidden">
                                <label for="type" class="col-sm-3 control-label tip" title="Choisissez le logo de la compagnie">Logo</label>
                                <div class="col-sm-9">
                                    <input id="logo" name="logo" type="file" /><br><?php if (is_file(UPLOAD_FOLDER . $rows->logo)) { ?><a href="#"><img src="<?php echo THUMB_FOLDER . $rows->logo; ?>"></a><br><?php } ?>
                                    <?php if (is_file(UPLOAD_FOLDER . $rows->logo)) { ?>
                                        <a href="<?php echo H_ADMIN; ?>&view=resconfig&id=<?php echo $rows->id; ?>&dfile=<?php echo $rows->logo; ?>&do=delete&fdel=file" data-confirm="<?php echo LANG_DELETE_AUTH; ?>"><span class="btn btn-xs btn-danger"><i class="fa fa-remove"></i> <?php echo LANG_DELETE; ?></span></a><br><?php } ?>
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