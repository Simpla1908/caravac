
<?php
/*
 * =======================================================================
 * FILE NAME:        View.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		rescategorie
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">

            <div class="box-header with-border">
                <h3 class="box-title">Congé</h3>
                <ul class="nav pull-right">

                </ul>

            </div><!-- /.box-header -->
            <div class="box-body">
                 <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab" class="btnemployeeligble">Employés éligibles au congé annuel</a></li>
              <li><a href="#tab_2" data-toggle="tab" class="btndetailcgrtrn">Situation congé employés</a></li>
              <li><a href="#tab_3" data-toggle="tab">Exécution congé</a></li>
            
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
               <?php 
              include('eligibl.php');
              ?>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
              <?php 
              include('situatcg.php');
              ?>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3">
              <?php 
              include('executcg.php');
              ?>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->
<?php include('modalexeccg.php');?>