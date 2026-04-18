
<?php
/*
 * =======================================================================
 * FILE NAME:        Add.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		resrubrique
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
$titre=' Ajout Rubrique Paie';
$type=get('type');
$hidden='';
if($type==0){
   $titre='Ajout Rubrique emprunt'; 
   $hidden='hidden';
}
?>
<form action="<?php echo H_ADMIN_MAIN . '&view=resrubrique&do=addpro&rub='.$type; ?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
    <div class="col-12">
        <ul class="nav pull-right" style="margin-top:5px;">
            <label for="hButton" class="btn btn-primary btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD; ?></label>
            <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_CREATE_RECORD; ?>" />
            <a href="<?php echo H_ADMIN; ?>&view=resrubrique&do=viewall&type=<?php echo $type; ?>" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL; ?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK; ?></a>
        </ul>
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading"><h3 class="panel-title"><?php echo $titre; ?></h3></div>
            <div class="panel-body">
                <div class="output"></div>
                <div class="form-horizontal">
                    <div class="row">
                        <div class="col-md-10">
                            <br>
                            <div class="form-group">
                                <label for="libelle" class="col-sm-3 control-label">Désignation</label>

                                <div class="col-sm-9">
                                    <input id="libelle" name="libelle" type="text" class="form-control">
                                </div>
                            </div>
                          
                            <div class="form-group">
                                <label for="type" class="col-sm-3 control-label">Type</label>
                                <div class="col-sm-9">
                                    <select id="type" name="type"  class="form-control choz">
                                        <?php if($type==1){ ?>
                                        <option value="remuneration">Rémunération</option>
                                        <option value="retenue">Retenue</option>
                                        <option value="transport">Transport</option>
                                        <option value="prime">Prime</option>
                                        <?php }else{?>
                                        <option value="avance">Avance</option>
                                        <option value="pret">Prêt</option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group hidden">
                                <label for="affiche" class="col-sm-3 control-label">Visible sur Bulletin</label>
                                <div class="col-sm-9">
                                    <select id="affiche" name="affiche"  class="form-control choz">
                                         <?php if($type==1){ ?>
                                            <option value="1">Oui</option>
                                         <?php }else{?>
                                            <option value="0">Non</option>
                                         <?php }?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group <?php echo $hidden; ?>">
                                <label for="salbase" class="col-sm-3 control-label"></label>
                                <div class="col-sm-9">
                                    <div class="radio">
                                        <label>
                                            <input name="salaire" id="salbase" value="salbase" checked="" type="radio"> Calculer sur salaire de base
                                        </label>
                                    </div>
                                </div>
                            </div>
                           <div class="form-group <?php echo $hidden; ?>">
                                <label for="salbase" class="col-sm-3 control-label"></label>
                                <div class="col-sm-9">
                                    <div class="radio">
                                        <label>
                                            <input name="salaire" id="salbase" value="salbrut"  type="radio"> Calculer sur salaire brut
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group <?php echo $hidden; ?>">
                                <label for="inputPassword3" class="col-sm-3 control-label"></label>
                                <div class="col-sm-3">
                                    <input name="salaire" id="salbrut" value="manuel"  type="radio"> Montant
                                </div>
                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <input name="nombre" id="nombre" type="number" class="form-control" value="0" min="0">
                                        <span class="input-group-addon devise"><?php echo $_SESSION['Paie_insert']?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group <?php echo $hidden; ?>">
                                <label for="inputPassword3" class="col-sm-3 control-label"></label>
                                <div class="col-sm-3">
                                    <input name="pourcentage" id="pourcentage" value="1"  type="checkbox"> Taux
                                </div>
                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <input name="valpourcentage" id="valpourcentage" type="number" class="form-control" value="0" min="0">
                                        <span class="input-group-addon devise">%</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group <?php echo $hidden; ?>">
                                <label for="nbrenf" class="col-sm-3 control-label"></label>
                                <div class="col-sm-9">
                                    <div class="checkbox">
                                        <label>
                                            <input name="nbrenf" id="nbrenf" value="1" type="checkbox" class="flat-red"> Multiplier par nombre d'enfants
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group hidden <?php echo $hidden; ?>">
                                <label for="jrp" class="col-sm-3 control-label"></label>
                                <div class="col-sm-9">
                                    <div class="checkbox">
                                        <label>
                                            <input name="jrp" id="jrp" value="1" type="checkbox" class="flat-red"> Multiplier par jours prestés
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group <?php echo $hidden; ?>">
                                <label for="hrsup" class="col-sm-3 control-label"></label>
                                <div class="col-sm-9">
                                    <div class="checkbox">
                                        <label>
                                            <input name="hrsup" id="hrsup" value="1" type="checkbox" class="flat-red"> Multiplier par heures supplémentaires
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group hidden <?php echo $hidden; ?>">
                                <label for="imposable" class="col-sm-3 control-label"></label>
                                <div class="col-sm-9">
                                    <div class="checkbox">
                                        <label>
                                            <input name="imposable" id="imposable" value="1" type="checkbox" class="flat-red"> Imposable
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
                                                <tr>
                                                    <td>
                                                        <input name="categories[]" type="checkbox" value="<?php echo $r->id ?>">
                                                    </td>
                                                    <td><?php echo $r->libelle ?></td>
                                                </tr>
                                                <?php $i++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="output hidden"></div>
            </div>
            <input id="psedo" name="psedo" type="hidden" value="0">
            <input id="site_id" name="site_id" type="hidden" value="<?php echo $_SESSION['idsite'] ?>">
            <div class="panel-footer" style="border-bottom:solid 2px #CCC;"> 
                <label for="hButton" class="btn btn-primary" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD; ?></label>
                <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_CREATE_RECORD; ?>" />
            </div>
        </div><!--/col-12-->
</form>
