
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


<form action="<?php echo H_ADMIN_MAIN . '&view=facconfig&do=updatepro2'; ?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
    <div class="col-12">
        <ul class="nav pull-right" style="margin-top:5px;margin-right:5px;">
            <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD; ?></label>
            <input type="submit" name="button" id="hButton" class="btnconfigfactrtn hidden" value="<?php echo LANG_UPDATE_RECORD; ?>" />
        </ul>
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i> Configuration annulation réservation</h3></div>
            <div class="panel-body">

                <div class="output"></div>

                <div class="form-horizontal">
                    <div class="row">
                        <div class="col-md-10">
                            <br>
                            <input type="hidden" name="id" value="<?php echo $rows->id; ?>">
                            <div class="form-group hidden">
                                <label for="nomcomp" class="col-sm-3 control-label">Entreprise</label>
                                <div class="col-sm-9">
                                     <input id="nomcomp" name="nomcomp" type="text"   value="<?php echo $rows->nom_hotel; ?>" class="form-control" />
                                </div>
                            </div>
                             <div class="form-group">
                                <label for="type" class="col-sm-3 control-label tip" title="Choisissez le logo de l'Entreprise">Type d'annulation</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label>
                                                <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="">
                                                 Sans pénalité
                                           </label>
                                        </div>
                                        <div class="col-sm-4">
                                           <label>
                                                <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                                 Avec pénalité
                                           </label> 
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
                            
                             
                            <div class="form-group">
                                <label for="tva" class="col-sm-3 control-label tip" >Jour d'annulation</label>
                                <div class="col-sm-9">
                                   <select id="liestock" name="liestock"  class="form-control choz">
                                        <option value="0">Même jour</option>     
                                        <option value="1">Après 24 heures</option>
                                        <option value="2">Après 48 heures</option>
                                         <option value="3">Après 72 heures</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="taux" class="col-sm-3 control-label tip" >Montant à retenir</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <select id="liestock" name="liestock"  class="form-control choz">
                                                <option value="nuite">en nuitee</option>     
                                                <option value="pourcentage">en pourcentage</option>
                                                <option value="chiffre">en chiffre</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-5">
                                             <div class="input-group">
                                                <input type="text" class="form-control">
                                                <span class="input-group-addon">.00</span>
                                              </div>
                                        </div>  
                                    </div>
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
                                <label for="salbase" class="col-sm-3 control-label">Monnaie facture</label>

                                <div class="col-sm-9">
                                    <select id="m_affich" name="m_affich"  class="form-control choz">
                                        <?php if ($rows->m_affich == "CDF") { ?>
                                            <option value="<?php echo $rows->m_affich; ?>"><?php echo $rows->m_affich; ?></option>
                                            <option value="USD">USD</option>
                                        <?php } else { ?>  
                                            <option value="<?php echo $rows->m_affich; ?>"><?php echo $rows->m_affich; ?></option>
                                            <option value="CDF">CDF</option>        
                                        <?php } ?> 
                                    </select>
                                </div>
                            </div>
                              <div class="form-group">
                                <label for="devise" class="col-sm-3 control-label tip" >Préfixe facture</label>
                                <div class="col-sm-9">
                                    <input id="prefsanct" name="prefsanct" type="text"   value="<?php echo $rows->prefsanct; ?>" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="devise" class="col-sm-3 control-label tip" >Préfixe reçu</label>
                                <div class="col-sm-9">
                                    <input id="prefconge" name="prefconge" type="text"   value="<?php echo $rows->prefconge; ?>" class="form-control" />
                                </div>
                            </div>
                                <div class="form-group hidden">
                                <label for="echeance" class="col-sm-3 control-label tip" >Echéance</label>
                                <div class="col-sm-9">
                                    <input id="echeance" name="echeance" type="text"   value="0" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group hidden">
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
                            <div class="form-group hidden">
                                <label for="infofact" class="col-sm-3 control-label tip" >Instructions importantes</label>
                                <div class="col-sm-9">
                                       <textarea id="editor" name="infofact"  class="form-control editor2" rows="5"><?php echo $rows->infofact; ?></textarea>
                                </div>
                            </div>
                            
                            <div class="form-group hidden">
                                <label for="sujetmail" class="col-sm-3 control-label tip" >Sujet du Mail</label>
                                <div class="col-sm-9">
                                     <input id="sujetmail" name="sujetmail" type="text"   value="<?php echo $rows->sujetmail; ?>" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group hidden">
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
                            <div class="form-group">
                                <label for="checkin" class="col-sm-3 control-label tip" >Heure d'entrée</label>
                                <div class="col-sm-9">
                                    <input id="checkin" name="checkin" type="time"   value="<?php echo $rows->checkin; ?>" class="form-control" />
                                </div>
                            </div>
                              <div class="form-group">
                                <label for="checkout" class="col-sm-3 control-label tip" >Heure de sortie</label>
                                <div class="col-sm-9">
                                    <input id="checkout" name="checkout" type="time"   value="<?php echo $rows->checkout; ?>" class="form-control" />
                                </div>
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
