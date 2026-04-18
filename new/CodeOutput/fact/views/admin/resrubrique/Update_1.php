
<?php
/*
 * =======================================================================
 * FILE NAME:        Update.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		resrubrique
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
?>
<form action="<?php echo H_ADMIN_MAIN . '&view=resrubrique&do=updatepro'; ?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
    <div class="col-12">
        <ul class="nav pull-right" style="margin-top:5px;">
            <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD; ?></label>
            <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD; ?>" />

            <a href="<?php echo H_ADMIN; ?>&view=resrubrique&id=<?php echo $rows->id; ?>&do=details" title="View Details" class="btn btn-default btn-sm tip hidden"><i class="fa fa-th-list"></i> <?php echo LANG_DETAILS; ?></a>

            <a href="<?php echo H_ADMIN; ?>&view=resrubrique&id=<?php echo $rows->id; ?>&do=delete&dfile=" title="<?php echo LANG_TIP_DELETE; ?>" class="btn btn-default btn-sm tip" data-confirm="<?php echo LANG_DELETE_AUTH; ?>"><i class="fa fa-trash-o"></i> <?php echo LANG_DELETE; ?></a>

            <a href="<?php echo H_ADMIN; ?>&view=resrubrique&do=viewall" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL; ?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK; ?></a>
        </ul>
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i> Modification Rubrique paie</h3></div>
            <div class="panel-body">
                <div class="output"></div>
                <div class="form-horizontal">
                    <div class="row">
                        <div class="col-md-10">
                            <br>
                            <input type="hidden" name="id" value="<?php echo $rows->id; ?>">
                            <input id="psedo" name="psedo" type="hidden" value="<?php echo $rows->psedo; ?>">
                            <input id="site_id" name="site_id" type="hidden" value="<?php echo $rows->site_id; ?>">
                            <div class="form-group">
                                <label for="libelle" class="col-sm-3 control-label">Désignation</label>

                                <div class="col-sm-9">
                                    <input id="libelle" name="libelle" type="text" value="<?php echo $rows->libelle; ?>" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="type" class="col-sm-3 control-label">Type</label>
                                <div class="col-sm-9">
                                    <select id="type" name="type"  class="form-control choz">
                                        <option value="remuneration">Rémunération</option>
                                        <option value="retenue">Retenue</option>
                                        <option value="prime">Prime</option>
                                        <option value="<?php echo $rows->type; ?>" selected="selected"><?php echo ucfirst($rows->type); ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="salbase" class="col-sm-3 control-label"></label>
                                <div class="col-sm-9">
                                    <div class="radio">
                                        <label>
                                            <?php if ($paramsRubrique->salbase == 1) { ?>
                                                <input name="salaire" id="salbase" value="salbase" checked="checked" type="radio"> Calculer sur salaire de base
                                            <?php } else { ?>
                                                <input name="salaire" id="salbase" value="salbase"  type="radio"> Calculer sur salaire de base
                                            <?php } ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="salbrut" class="col-sm-3 control-label"></label>
                                <div class="col-sm-9">
                                    <div class="radio">
                                        <label>
                                            <?php if ($paramsRubrique->salbrut == 1) { ?>
                                                <input name="salaire" id="salbrut" value="salbrut" checked="checked" type="radio"> Calculer sur salaire brut
                                            <?php } else { ?>
                                                <input name="salaire" id="salbrut" value="salbrut"  type="radio"> Calculer sur salaire brut
                                            <?php } ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nbrenf" class="col-sm-3 control-label"></label>
                                <div class="col-sm-9">
                                    <div class="checkbox">
                                        <label>
                                            <?php if ($paramsRubrique->nbrenf == 1) { ?>
                                                <input name="nbrenf" id="nbrenf" value="1" type="checkbox" checked="checked" class="flat-red"> Multiplier par le nombre d'enfant
                                            <?php }else{ ?>
                                                <input name="nbrenf" id="nbrenf" value="1" type="checkbox" class="flat-red"> Multiplier par le nombre d'enfant
                                            <?php } ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-3 control-label"></label>

                                <div class="col-sm-3">
                                    <div class="checkbox">
                                        <label>
                                            <?php if ($paramsRubrique->manuel == 1) { ?>
                                                <input name="manuel" id="manuel" value="1" checked="checked" type="checkbox" class="flat-red"> Insérer manuellement
                                            <?php } else { ?>
                                                <input name="manuel" id="manuel" value="1" type="checkbox" class="flat-red"> Insérer manuellement
                                            <?php } ?>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <select id="sorte" name="sorte"  class="form-control choz">
                                        <?php if ($paramsRubrique->pourcentage == 0) { ?>
                                            <option value="valeur" selected="selected">Valeur</option>
                                            <option value="pourcentage">Pourcentage</option>
                                        <?php } elseif ($paramsRubrique->pourcentage == 1) { ?>
                                            <option value="valeur">Valeur</option>
                                            <option value="pourcentage" selected="selected">Pourcentage</option>
                                        <?php } ?>
                                    </select> 
                                </div>
                                <div class="col-sm-3">
                                    <input name="nombre" id="nombre" value="<?php echo arrondir($paramsRubrique->valeur)?>" type="number" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="imposable" class="col-sm-3 control-label"></label>
                                <div class="col-sm-9">
                                    <div class="checkbox">
                                        <label>
                                            <?php if ($paramsRubrique->imposable == 1){?>
                                                <input name="imposable" id="imposable" value="1" checked="1" type="checkbox" class="flat-red"> Imposable
                                            <?php }else{ ?>
                                                <input name="imposable" id="imposable" value="1" type="checkbox" class="flat-red"> Imposable
                                            <?php } ?>

                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label tip" title="Cocher les catégories qui vont contenir cette rubrique">Catégories</label>
                                <div class="col-sm-9">
                                    <ul class="todo-list">
                                        <?php foreach ($categories as $r) { ?>
                                            <?php if (in_array($r->id, $rubriquecategs['id'])){ ?>
                                                <li>
                                                    <!-- checkbox -->
                                                    <input name="categories[]" type="checkbox" value="<?php echo $r->id ?>" checked="checked">
                                                    <span class="text"><?php echo $r->libelle ?></span>
                                                </li>
                                            <?php }else{ ?>
                                                <li>
                                                    <!-- checkbox -->
                                                    <input name="categories[]" type="checkbox" value="<?php echo $r->id ?>">
                                                    <span class="text"><?php echo $r->libelle ?></span>
                                                </li>
                                            <?php } ?>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="output hidden"></div>
            </div>
            <div class="panel-footer" style="border-bottom:solid 2px #CCC;"> 
                <label for="hButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD; ?></label>
                <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD; ?>" />
            </div>

        </div><!--/col-12-->
</form>
