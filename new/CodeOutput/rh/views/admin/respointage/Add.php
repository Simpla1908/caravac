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
    <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i> Pointage <?php //echo date('H:i:s'); ?>
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

            <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title"><i class="fa fa-navicon"></i>  Arrivée</h3>
                </div>
                <div class="box-body">
                  <!-- Agent -->
                  <div class="form-group">
                    <div class="form-group">
                      <label>Personnel:</label>
                      <select class="form-control  choz" name="employe_id">
                        <option value="0">Sélectionner un agent</option>
                        <?php
                        foreach ($result as $rows) {
                          //verification s'il est sanctionné
                          $bool1=VerifSanction($rows->id);
                          if($bool1==0){
                         //verification s'il est en congé
                          $bool2=VerifCG($rows->id);
                          if($bool2==0){
                          ?>
                          <option value="<?php echo $rows->id; ?>"><?php echo ucfirst($rows->noms); ?></option>
                        <?php 
                          }
                        //fin verification congeé
                        }
                        //fin verification sanction
                        } ?>
                      </select>
                      <!-- /.input group -->
                    </div>
                    <!-- /.input group -->
                  </div>
                  <!-- /.form group -->
                  <!-- Date -->
                  <div class="form-group">
                    <label>Date:</label>

                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" value="<?php echo date('d/m/Y'); ?>" class="form-control pull-right" name="dte" id="datepicker">
                    </div>
                    <!-- /.input group -->
                  </div>
                  <!-- /.form group -->
                  <!-- time Picker -->
                  <div class="bootstrap-timepicker">
                    <div class="form-group">
                      <label>Heure:</label>

                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-clock-o"></i>
                        </div>
                        <input type="text" class="form-control timepicker"  name="hr" value="<?php echo date('H:i:s'); ?>">
                      </div>
                      <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                  </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                  <button type="submit" class="btn btn-primary btnpoint" name="btnarrive" value="0"><i class="fa fa-check-circle"></i> Valider</button>
                </div>
              </div>
              <!-- /.box -->
          </div>
          <!-- /.col (left) -->
          <input type="hidden" name="type" >
          <div class="col-md-6">
            <div class="box box-primary">
              <div class="box-header">

                <h3 class="box-title"><i class="fa fa-navicon"></i>  Départ</h3>
              </div>
              <div class="box-body">
                             <!-- Agent -->
                <div class="form-group testslct">
                  <label>Personnel:</label>
                  <select class="form-control choz" name="employe_id1" id="employe_id1">
                    <option value="0">Sélectionner un agent</option>
                    <?php
                    foreach ($resultdprt as $rows) {
                      ?>
                      <option idtmppoint="<?php echo $rows->idtmppoint; ?>" idpoint="<?php echo $rows->point_id; ?>"  idpointprec="<?php echo $rows->idpointprec; ?>" compteurshift="<?php echo $rows->compteurshift; ?>" value="<?php echo $rows->id; ?>" dte_in="<?php echo $rows->dte_in; ?>" horaire_id="<?php echo $rows->horaire_id; ?>"><?php echo ucfirst($rows->noms); ?></option>
                    <?php } ?>
                  </select>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
                <!-- Date -->
                <div class="form-group">
                  <label>Date:</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input  type="text" value="<?php echo date('d/m/Y'); ?>" name="dte1" class="form-control pull-right" id="datepicker1">
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
                <!-- time Picker -->
                <div class="bootstrap-timepicker">
                  <div class="form-group">
                    <label>Heure:</label>

                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                      </div>
                      <input type="text" class="form-control timepicker" name="hr1" value="<?php echo date('H:i:s'); ?>">
                    </div>
                    <!-- /.input group -->
                  </div>
                  <!-- /.form group -->
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary btnpoint" name="btndepart" value="1"><i class="fa fa-check-circle"></i> Valider</button>
              </div>
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col (right) -->
          </form>
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
