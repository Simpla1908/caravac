<?php
/*
 * =======================================================================
 * FILE NAME:        Add.php
 * DATE CREATED:    17-11-2017
 * FOR TABLE:       respointage
 * PRODUCED BY:     HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:          Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
?>


<div class="col-12">
    <ul class="nav pull-right hidden" style="margin-top:5px;">
        <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD; ?></label>
        <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_CREATE_RECORD; ?>" />
        <a href="<?php echo H_ADMIN; ?>&view=respointage&do=viewall" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL; ?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK; ?></a>
    </ul>
    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i> Pointage
            </h3></div>
        <div class="panel-body">
            <div class="output"></div>
            <div class="content">
                <!-- /.box -->
                <form action="<?php echo H_ADMIN_MAIN . '&view=respointage&do=addpro'; ?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="hidden" name="typepoint" id="typepoint" value="">
                            <input type="hidden" name="dte_in" id="dte_in" value="">
                            <input type="hidden" name="horaire_id" id="horaire_id" value="">
                            <input type="hidden" name="idpoint" id="idpoint" value="">
                            <input type="hidden" name="idpointprec" id="idpointprec" value="">
                            <input type="hidden" name="compteurshift" id="compteurshift" value="">
                            <input type="hidden" name="idtmppoint" id="idtmppoint" value="">
                            <input type="hidden" name="moischoisi" id="moischoisi" value="">
                            <input type="hidden" name="anchoisi" id="anchoisi" value="">
                            <input type="hidden" name="libmois" id="libmois" value="">
                            <div class="box-body">
                                <div class="form-group">
                                    <div class="form-group" id="employecombo">
                                       <?php include(APP_FOLDER . '/views/admin/respointage/employecombo.php'); ?>
                                    </div>
                                    <!-- /.input group -->
                                </div>
                                <!-- Agent -->
                                <!-- /.form group -->
                                <div class="form-group testslct">
                                    <label>Mois:</label>
                                    <div id="periode_bloc">
                                        <select id="periode" name="periode" class="form-control choz choixmois">
                                          
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Présence:</label>
                                    <div class="input-group">
                                        <input type="text" value="" class="form-control pull-right eff" name="presence">
                                        <div class="input-group-addon">
                                            <span>jour(s)</span>
                                        </div>
                                    </div>
                                    <!-- /.input group -->
                                </div>
                                <div class="form-group">
                                    <label>Absence:</label>
                                    <div class="input-group date">
                                        <input  type="text" value="" name="absence" class="form-control pull-right eff" >
                                        <div class="input-group-addon">
                                            <span>jour(s)</span>
                                        </div>
                                    </div>
                                    <!-- /.input group -->
                                </div>

                            </div>

                        </div>
                        <!-- /.col (left) -->
                        <div class="col-md-6">
                            <div class="box-body">
                                <div class="form-group">
                                    <label>Congé:</label>
                                    <div class="input-group">
                                        <input type="text" value="" class="form-control pull-right eff" name="conge">
                                        <div class="input-group-addon">
                                            <span>jour(s)</span>
                                        </div>
                                    </div>
                                    <!-- /.input group -->
                                </div>
                                <div class="form-group">
                                    <label>Malade:</label>
                                    <div class="input-group date">
                                        <input  type="text" value="" name="malade" class="form-control pull-right eff">
                                        <div class="input-group-addon">
                                            <span>jours</span>
                                        </div>
                                    </div>
                                    <!-- /.input group -->
                                </div>
                                <div class="form-group">
                                    <label>Heure supplémentaire:</label>
                                    <div class="input-group">
                                        <input type="text" value="" class="form-control pull-right eff" name="hrsupl">
                                        <div class="input-group-addon">
                                            <span>heure(s)</span>
                                        </div>
                                    </div>
                                    <!-- /.input group -->
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <!-- /.box -->
                        </div>
                        <button type="submit" class="btn btn-primary pull-right" name="btnvldptmens" value="1" id="btnvldptmens"><i class="fa fa-check-circle"></i> Valider</button>
                     </div>
                </form>
            <!-- /.row -->
        </div>
    </div>
    <div class="panel-footer hidden" style="border-bottom:solid 2px #CCC;">
        <label for="hButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD; ?></label>
        <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_CREATE_RECORD; ?>" />
    </div>
</div><!--/col-12-->
