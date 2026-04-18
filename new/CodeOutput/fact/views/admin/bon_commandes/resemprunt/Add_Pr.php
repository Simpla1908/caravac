
<?php
/*
 * =======================================================================
 * FILE NAME:        Add.php
 * DATE CREATED:    17-11-2017
 * FOR TABLE:       rescategorie
 * PRODUCED BY:     HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:          Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
?>


     <form action="<?php echo H_ADMIN_MAIN.'&view=resemprunt&do=addpro_pr';?>" method="post" name="hezecomform" id="hezecomform" class="form_paie" enctype="multipart/form-data">
    <div class="col-12">
        <ul class="nav pull-right" style="margin-top:5px;">
            <label for="hButton" class="btn btn-primary btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_BTN_VALIDER; ?></label>
            <input type="submit" name="button" id="hButton" class="hidden btnpret" value="<?php echo LANG_CREATE_RECORD; ?>" />

            <a href="<?php echo H_ADMIN; ?>&view=resemprunt&do=view_pr" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL; ?>"><i class="fa fa-list"></i>  Liste Prêt</a>
        </ul>
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i> Prêt</h3></div>
            <div class="panel-body">
                <div class="output"></div>
                <div class="form-horizontal">
                    <div class="row">
                        <div class="col-md-10">
                            <br>
                           <input id="idlib" name="idlib" type="hidden" value="<?php echo $idlib; ?>">
                           <input id="nomemploye" name="nomemploye" type="hidden">

                            <div class="form-group">
                                <label for="devise" class="col-sm-3 control-label">Employé</label>
                                <div class="col-sm-9" id="employe_bloc">
                                    <select id="idagent" name="idagent"  class="form-control choz emply_emprnt">
                                        <option value="0">Employé</option>
                                        <?php
                                        foreach ($result as $rows) {
                                          ?>
                                          <option value="<?php echo $rows->id; ?>" nom="<?php echo ucfirst($rows->noms); ?>"><?php echo ucfirst($rows->noms); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group hidden">
                                <label for="libelle" class="col-sm-3 control-label">Date</label>

                                <div class="col-sm-9">
                                        <input id="dte" name="dte" type="text" class="form-control datepicker2" placeholder="Date" value="<?php echo date('d/m/Y'); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="salbase" class="col-sm-3 control-label">Montant prêt</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                    <input  id="mont" name="mont" type="text" class="form-control" placeholder="Montant prêt">
                                    <span class="input-group-addon"><?php echo $_SESSION['Paie_insert']; ?></span>
                                     </div>
                            </div>
                             </div>
                              <div class="form-group">
                                <label for="salbase" class="col-sm-3 control-label">Durée</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                    <input  id="duree" name="duree" type="text" class="form-control" placeholder="Durée">
                                    <span class="input-group-addon">mois</span>
                                     </div>
                            </div>
                             </div>
                            <div class="form-group">
                                <label for="devise" class="col-sm-3 control-label">Mois à déduire</label>
                                <div class="col-sm-9" id="mois_bloc">
                                    <select id="dte_deduct" name="dte_deduct" class="form-control choz">
                                    <option value="">Mois à déduire</option>
                                     <?php
                                    for ($i =0; $i < 12; $i++){
                                     ?>
                                    <option value="<?php echo suppr_accents($mois[$i].$annee); ?>" ><?php echo $mois[$i].' '.$annee; ?></option>
                                    <?php } ?>
                                    </select>
                                </div>
                            </div>
                            </div>
                    </div>
                </div>
                
            </div>
            <div class="panel-footer" style="border-bottom:solid 2px #CCC;"> 
             <label for="hButton" class="btn btn-primary btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_BTN_VALIDER; ?></label>
            <input type="submit" name="button" id="hButton" class="hidden btnpret" value="<?php echo LANG_CREATE_RECORD; ?>" />

         </div>
        </div><!--/col-12-->
       </form>
