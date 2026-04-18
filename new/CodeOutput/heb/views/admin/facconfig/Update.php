
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


<form action="<?php echo H_ADMIN_MAIN . '&view=facconfig&do=updatepro'; ?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
    <div class="col-12">
        <ul class="nav pull-right" style="margin-top:5px;margin-right:5px;">
            <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD; ?></label>
            <input type="submit" name="button" id="hButton" class="btnconfigfactrtn hidden" value="<?php echo LANG_UPDATE_RECORD; ?>" />
        </ul>
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i> Configurations</h3></div>
            <div class="panel-body">

                <div class="output"></div>

                <div class="form-horizontal">
                    <div class="row">
                        <div class="col-md-10">
                            <br>
                            <input type="hidden" name="id" value="<?php echo $rows->id; ?>">
                            <div class="form-group">
                                <label for="nomcomp" class="col-sm-3 control-label">Entreprise</label>
                                <div class="col-sm-9">
                                     <input id="nomcomp" name="nomcomp" type="text"   value="<?php echo $rows->nom_hotel; ?>" class="form-control" />
                                </div>
                            </div>
                             <div class="form-group">
                                <label for="type" class="col-sm-3 control-label tip" title="Choisissez le logo de l'Entreprise">Logo</label>
                                <div class="col-sm-9">
                                    <input id="logo" name="logo" type="file"/><br><?php if (is_file(UPLOAD_FOLDER . $rows->logo)) { ?><a href="#"><img src="<?php echo THUMB_FOLDER . $rows->logo; ?>"></a><br><?php } ?>
                                        <?php if (is_file(UPLOAD_FOLDER . $rows->logo)) { ?>
                                        <a href="<?php echo H_ADMIN; ?>&view=resconfig&id=<?php echo $rows->id; ?>&dfile=<?php echo $rows->logo; ?>&do=delete&fdel=file" data-confirm="<?php echo LANG_DELETE_AUTH; ?>"><span class="btn btn-xs btn-danger"><i class="fa fa-remove"></i> <?php echo LANG_DELETE; ?></span></a><br><?php } ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="adrcomp" class="col-sm-3 control-label tip" title="Adresse de la compagnie">Adresse</label>
                                <div class="col-sm-9">
                                     <input id="adrcomp" name="adrcomp" type="text"   value="<?php echo $rows->adresse_hotel; ?>" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tel" class="col-sm-3 control-label tip">Télephone</label>
                                <div class="col-sm-9">
                                     <input id="tel" name="tel" type="text"   value="<?php echo $rows->phone; ?>" class="form-control" />
                                </div>
                            </div>
                             <div class="form-group">
                                <label for="mail" class="col-sm-3 control-label tip" >Email</label>
                                <div class="col-sm-9">
                                     <input id="mail" name="mail" type="text"   value="<?php echo $rows->mail; ?>" class="form-control" />
                                </div>
                            </div>
                             <div class="form-group">
                                <label for="idnat" class="col-sm-3 control-label tip" >ID.Nat.</label>
                                <div class="col-sm-9">
                                     <input id="idnat" name="idnat" type="text"   value="<?php echo $rows->idnat; ?>" class="form-control" />
                                </div>
                            </div>
                              <div class="form-group">
                                <label for="rccm" class="col-sm-3 control-label tip" >RCCM</label>
                                <div class="col-sm-9">
                                     <input id="rccm" name="rccm" type="text"   value="<?php echo $rows->rccm; ?>" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="fuseauhoraire" class="col-sm-3 control-label">Fuseau horaire</label>
                                <div class="col-sm-9">
                                    <select id="fuseauhoraire" name="fuseauhoraire"  class="form-control choz">
                                        <option value="<?php echo $rows->fuseauhoraire; ?>"><?php echo $rows->fuseauhoraire; ?></option>
                                    </select>
                                </div>
                            </div>
                             <div class="form-group">
                                <label for="taux" class="col-sm-3 control-label tip" >Taux</label>
                                <div class="col-sm-9">
                                    <input id="taux" name="taux" type="text"   value="<?php echo $rows->taux; ?>" class="form-control" />
                                </div>
                            </div>
                             <div class="form-group">
                                <label for="tva" class="col-sm-3 control-label tip" >TVA</label>
                                <div class="col-sm-9">
                                    <input id="tva" name="tva" type="text"   value="<?php echo $rows->tva; ?>" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="libelle" class="col-sm-3 control-label">Monnaie insertion</label>

                                <div class="col-sm-9">
                                    <select id="m_insert" name="m_insert"  class="form-control choz">
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
                                    <select id="m_affich" name="m_affich"  class="form-control choz">
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
                                <label for="devise" class="col-sm-3 control-label tip" >Préfixe reçu</label>
                                <div class="col-sm-9">
                                    <input id="prefconge" name="prefconge" type="text"   value="<?php echo $rows->prefconge; ?>" class="form-control" />
                                </div>
                            </div>
                              <div class="form-group">
                                <label for="devise" class="col-sm-3 control-label tip" >Préfixe facture</label>
                                <div class="col-sm-9">
                                    <input id="prefsanct" name="prefsanct" type="text"   value="<?php echo $rows->prefsanct; ?>" class="form-control" />
                                </div>
                            </div>
                                <div class="form-group hidden">
                                <label for="echeance" class="col-sm-3 control-label tip" >Echéance</label>
                                <div class="col-sm-9">
                                    <input id="echeance" name="echeance" type="text"   value="0" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="liestock" class="col-sm-3 control-label">Lier avec le Module Stock</label>

                                <div class="col-sm-9">
                                    <select id="liestock" name="liestock"  class="form-control choz">
                                        <?php if ($rows->liestock ==1) { ?>
                                            <option value="1">Oui</option>
                                            <option value="0">Non</option>
                                        <?php } else { ?>  
                                        <option value="0">Non</option>     
                                        <option value="1">Oui</option>
                                        <?php } ?> 
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="infofact" class="col-sm-3 control-label tip" >Instructions importantes</label>
                                <div class="col-sm-9">
                                       <textarea id="editor" name="infofact"  class="form-control editor2" rows="5"><?php echo $rows->infofact; ?></textarea>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="sujetmail" class="col-sm-3 control-label tip" >Sujet du Mail</label>
                                <div class="col-sm-9">
                                     <input id="sujetmail" name="sujetmail" type="text"   value="<?php echo $rows->sujetmail; ?>" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="msgmail" class="col-sm-3 control-label tip" >Message du Mail</label>
                                <div class="col-sm-9">
                                   <textarea id="editor2" name="msgmail"  class="form-control editor2" rows="5"><?php echo $rows->msgmail; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group hidden">
                                <label class="control-label" for="module_id">Module Id</label>
                                <input id="module_id" name="module_id" type="text" maxlength="11"  value="<?php echo $rows->module_id; ?>" class="form-control" =/>
                            </div>

                            <div class="form-group hidden">
                                <label class="control-label" for="site_id">Site Id</label>
                                <input id="site_id" name="site_id" type="text" maxlength="11"  value="<?php echo $rows->site_id; ?>" class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="output"></div>
            </div>
            <div class="panel-footer" style="border-bottom:solid 2px #CCC;"> 
                <label for="hButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD; ?></label>
                <input type="submit" name="button" id="hButton" class="btnconfigfactrtn hidden" value="<?php echo LANG_UPDATE_RECORD; ?>" />
            </div>



        </div><!--/col-12-->

</form>
