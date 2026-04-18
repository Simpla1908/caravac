
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
    $titre=' Modification Rubrique Paie';
    $type=get('type');
    $hidden='';
    if($type==0){
       $titre='Modification Rubrique emprunt'; 
       $hidden='hidden';
    }
?>
<form action="<?php echo H_ADMIN_MAIN . '&view=resrubrique&do=updatepro&rub='.$type; ?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
    <div class="col-12">
        <ul class="nav pull-right" style="margin-top:5px;">
            <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD; ?></label>
            <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD; ?>" />
            <a href="<?php echo H_ADMIN; ?>&view=resrubrique&id=<?php echo $rows->id; ?>&do=delete&dfile=" title="<?php echo LANG_TIP_DELETE; ?>" class="btn btn-default btn-sm tip" data-confirm="<?php echo LANG_DELETE_AUTH; ?>"><i class="fa fa-trash-o"></i> <?php echo LANG_DELETE; ?></a>
            <a href="<?php echo H_ADMIN; ?>&view=resrubrique&do=viewall&type=<?php echo $type; ?>" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL; ?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK; ?></a>
        </ul>
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading"><h3 class="panel-title"><?php echo $titre; ?></h3></div>
            <div class="panel-body">
                <input type="hidden" name="id" value="<?php echo $rows->id; ?>">
                  <input id="psedo" name="psedo" type="hidden" value="<?php echo $rows->psedo; ?>">
                  <input id="site_id" name="site_id" type="hidden" value="<?php echo $rows->site_id; ?>">
                  <input id="sequence" name="sequence" type="hidden" value="<?php echo $rows->sequence; ?>">
                <div class="output"></div>
               <div class="form-horizontal">
                    <div class="row">
                        <div class="col-md-10">
                            <br>
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
                                        <?php if($type==1){ ?>
                                        <option value="base">Rémunération</option>
                                        <option value="retenue">Retenue</option>
                                        <option value="transport">Transport</option>
                                        <option value="prime">Prime</option>
                                        <?php }else{?>
                                        <option value="avance">Avance</option>
                                        <option value="pret">Prêt</option>
                                        <?php }?>
                                         <?php if($rows->type2=='transport'){?>
                                            <option value="<?php echo $rows->type; ?>" selected="selected"><?php echo ucfirst($rows->type2); ?></option>
                                        <?php }else{?>
                                            <option value="<?php echo $rows->type; ?>" selected="selected"><?php echo ucfirst($rows->type); ?></option>
                                         <?php }?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group hidden">
                                <label for="affiche" class="col-sm-3 control-label">Visible sur Bulletin</label>
                                <div class="col-sm-9">
                                    <select id="affiche" name="affiche"  class="form-control choz">
                                         <option value="<?php echo $rows->affiche ?>" selected=""><?php echo $rows->affiche ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group <?php echo $hidden; ?>">
                                <label for="salbase" class="col-sm-3 control-label"></label>
                                <div class="col-sm-9">
                                    <div class="radio">
                                        <label>
                                            <?php if ($paramsRubrique->salbase == 1) { ?>
                                                <input name="salaire" id="salbase" value="salbase" checked="checked" type="radio"> Calculer sur salaire de base
                                            <?php }else{ ?>
                                                <input name="salaire" id="salbase" value="salbase"  type="radio"> Calculer sur salaire de base
                                            <?php } ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                           <div class="form-group <?php echo $hidden; ?>">
                                <label for="salbase" class="col-sm-3 control-label"></label>
                                <div class="col-sm-9">
                                    <div class="radio">
                                        <label>
                                            <?php if ($paramsRubrique->salbrut == 1) { ?>
                                                <input name="salaire" id="salbase" value="salbrut" checked="checked" type="radio"> Calculer sur salaire brut
                                            <?php }else{ ?>
                                                <input name="salaire" id="salbase" value="salbrut"  type="radio"> Calculer sur salaire brut
                                            <?php } ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group <?php echo $hidden; ?>">
                                <label for="inputPassword3" class="col-sm-3 control-label"></label>
                                <div class="col-sm-3">
                                    <?php if ($paramsRubrique->manuel == 1) { ?>
                                                <input name="salaire" id="manuel" value="manuel" checked="checked" type="checkbox" class="flat-red"> Montant
                                    <?php }else{ ?>
                                        <input name="salaire" id="manuel" value="manuel" type="radio" class="flat-red"> Montant
                                    <?php } ?>
                                </div>
                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <?php
                                         $montant=montant_equivalent_bdd($paramsRubrique->monnaie,$_SESSION['Paie_insert'],$_SESSION['Paie_taux'],$paramsRubrique->valeur);
                                        ?>
                                        <input name="nombre" id="nombre" type="number" class="form-control" value="<?php echo arrondir($montant) ?>" min="0">
                                        <span class="input-group-addon devise"><?php echo $_SESSION['Paie_insert']?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group <?php echo $hidden; ?>">
                                <label for="inputPassword3" class="col-sm-3 control-label"></label>
                                <div class="col-sm-3">
                                    <?php if ($paramsRubrique->pourcentage ==1) { ?>
                                        <input name="pourcentage" id="pourcentage" value="1"  type="checkbox" checked=""> Taux
                                    <?php } else { ?>
                                      <input name="pourcentage" id="pourcentage" value="1"  type="checkbox"> Taux
                                    <?php }?>
                                </div>
                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <input name="valpourcentage" id="valpourcentage" type="number" class="form-control" value="<?php echo arrondir($paramsRubrique->valeur2) ?>" min="0">
                                        <span class="input-group-addon devise">%</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group <?php echo $hidden; ?>">
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
                            <div class="form-group <?php echo $hidden; ?>">
                                <label for="jrp" class="col-sm-3 control-label"></label>
                                <div class="col-sm-9">
                                    <div class="checkbox">
                                        <label>
                                            <?php if ($paramsRubrique->jrp == 1) { ?>
                                                <input name="jrp" id="jrp" value="1" type="checkbox" checked="checked" class="flat-red"> Multiplier par jours prestés
                                            <?php }else{ ?>
                                                <input name="jrp" id="jrp" value="1" type="checkbox" class="flat-red"> Multiplier par jours prestés
                                            <?php } ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group <?php echo $hidden; ?>">
                                <label for="hrsup" class="col-sm-3 control-label"></label>
                                <div class="col-sm-9">
                                    <div class="checkbox">
                                        <label>
                                            <?php if ($paramsRubrique->hrsup == 1) { ?>
                                                <input name="hrsup" id="hrsup" value="1" type="checkbox" checked="checked" class="flat-red"> Multiplier par heures supplémentaires
                                            <?php }else{ ?>
                                                <input name="hrsup" id="hrsup" value="1" type="checkbox" class="flat-red"> Multiplier par heures supplémentaires
                                            <?php } ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group <?php echo $hidden; ?>">
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
                            <div class="form-group <?php echo $hidden; ?>">
                                <label for="inputEmail3" class="col-sm-3 control-label tip" title="Cocher les catégories qui vont contenir cette rubrique"></label>
                                <div class="col-sm-9">
                                    <table class="table table-condensed table-bordered">
                                        <tbody>
                                            <tr>
                                                <th style="width: 20px"></th>
                                                <th>Catégories</th>
                                            </tr>
                                            <?php
                                            $i = 1;
                                            foreach ($categories as $r) {
                                                ?>
                                             <?php if (in_array($r->id, $rubriquecategs['id'])){ ?>
                                                <tr>
                                                    <td>
                                                        <input name="categories[]" type="checkbox" value="<?php echo $r->id ?>" checked="">
                                                    </td>
                                                    <td><?php echo $r->libelle ?></td>
                                                </tr>
                                            <?php }else{ ?>
                                                <tr>
                                                    <td>
                                                        <input name="categories[]" type="checkbox" value="<?php echo $r->id ?>">
                                                    </td>
                                                    <td><?php echo $r->libelle ?></td>
                                                </tr>
                                             <?php } ?>
                                            <?php $i++;} ?>
                                        </tbody>
                                    </table>
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
