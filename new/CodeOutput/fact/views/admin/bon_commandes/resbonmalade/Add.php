
<?php
/*
 * =======================================================================
 * FILE NAME:        Add.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		rescategorie
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
?>


<form action="<?php echo H_ADMIN_MAIN . '&view=resbonmalade&do=addpro'; ?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
    <div class="col-12">
        <ul class="nav pull-right" style="margin-top:5px;">
            <label for="hButton" class="btn btn-primary btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_BTN_VALIDER; ?></label>
            <input type="submit" name="button" id="hButton" class="bnmld hidden" value="<?php echo LANG_CREATE_RECORD; ?>" />
            <a href="<?php echo H_ADMIN; ?>&view=resbonmalade&do=viewall" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL; ?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK; ?></a>
        </ul>
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i> Bons de malades</h3></div>
            <div class="panel-body">
                <div class="output"></div>
                <div class="form-horizontal">
                     <div class="row">
                        <div class="col-xs-10">
                                <div class="row">
                                <div class="col-xs-3">
                                </div>
                                <div class="col-xs-7">
                               <div class="form-group">
                               <input type="hidden" name="emplyprisencharg" id="emplyprisencharg" value="">
                               <div id="employe_bloc">
                               <select class="form-control choz" name="employe" id="employe">
                               <option value="0">Choisir employé</option>
                                <?php
                                foreach ($result as $rows) {
                                    ?>
                                    <option value="<?php echo $rows->id; ?>"><?php echo ucfirst($rows->noms); ?></option>
                                <?php } ?>
                                  </select>
                                    </div>
                              </br></br>
                                   <label class="control-label" for="inputError"><input type="radio" name="idmalade" id="employeradio" value="" checked>
                                    </i>Employé</label>
                                </div>

                                </div>
                            </div>
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-xs-10">
                                <div class="row">
                                <div class="col-xs-3">
                                </div>
                                <div class="col-xs-7">
                              <div class="form-group bloc_membre">
                               
                            </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="panel-footer" style="border-bottom:solid 2px #CCC;"> 
                <label for="hButton" class="btn btn-primary" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD; ?></label>
                <input type="submit" name="button" id="hButton" class="bnmld hidden" value="<?php echo LANG_CREATE_RECORD; ?>" />
            </div>
        </div><!--/col-12-->
       <input id="psedo" name="psedo" type="hidden" maxlength="11"  value="0"  />
       <input id="site_id" name="site_id" type="hidden" maxlength="11" value="<?php echo $_SESSION['idsite']; ?>" />
</form>
