
<?php
/*
 * =======================================================================
 * FILE NAME:        Add.php
 * DATE CREATED:  	23-10-2017
 * FOR TABLE:  		resconge
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
?>


<form action="<?php echo H_ADMIN_MAIN . '&view=resconge&do=addpro'; ?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data" class="form_paie">
    <div class="col-12">
        <ul class="nav pull-right" style="margin-top:5px;">
            <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD; ?></label>
            <input type="submit" name="button" id="hButton" class="hidden btncg" value="<?php echo LANG_CREATE_RECORD; ?>" />

            <a href="<?php echo H_ADMIN; ?>&view=resconge&do=viewall" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL; ?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK; ?></a>
        </ul>
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i>  Congé</h3></div>
            <div class="panel-body">
                <div class="output"></div>
                <div class="form-horizontal">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group">
                                <label for="libelle" class="col-sm-3 control-label">Désignation</label>

                                <div class="col-sm-9">
                                    <input id="libelle" name="libelle" type="text" maxlength="245"  value="" class="form-control" />
                                </div>
                            </div>
                              <div class="form-group">
                            <label class="col-sm-3 control-label" for="libelle">Transport</label>
                            <div class="col-sm-9">
                            <div class="radio">
                              <label>
                                  <input type="radio" name="trans" id="trans" value="0" class="minimal updt_trans" checked>
                                  Non
                              </label>
                            </div>
                            <div class="radio">
                              <label>
                                  <input type="radio" name="trans" id="trans" class="minimal" value="1">
                                  Oui
                              </label>
                            </div>

                            </div>
                            </div>
                                 <div class="form-group">
                            <label class="col-sm-3 control-label" for="libelle">Type</label>
                            <div class="col-sm-9">
                          
                            <div class="radio">
                              <label>
                                  <input type="radio" name="type" id="type" class="minimal" value="0" checked>
                                  Congé de circonstance
                              </label>
                            </div>
                              <div class="radio">
                              <label>
                                  <input type="radio" name="type" id="type" value="1" class="minimal" >
                                  Congé annuel
                              </label>
                            </div>

                            </div>
                            </div>
                            <div class="form-group">
                                <label for="nbrjr" class="col-sm-3 control-label">Nombre de jour</label>

                                <div class="col-sm-9">
                                    <input id="nbrjr" name="nbrjr" type="text" maxlength="11"  value="" class="form-control" />
                                </div>
                            </div>
                              <div class="form-group texte">
                             <label class="col-sm-3 control-label" for="libelle">Contenu</label>
                              <div class="col-sm-9">
                              <textarea name="contenu" id="editor1">

                              </textarea>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input id="psedo" name="psedo" type="hidden" maxlength="11"  value="0"  />
                <input id="site_id" name="site_id" type="hidden" maxlength="11" value="<?php echo $_SESSION['idsite']; ?>" />
            </div>
            <div class="panel-footer" style="border-bottom:solid 2px #CCC;"> 
                <label for="hButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD; ?></label>
                <input type="submit" name="button" id="hButton" class="hidden btncg" value="<?php echo LANG_CREATE_RECORD; ?>" />
            </div>
        </div><!--/col-12-->
</form>
