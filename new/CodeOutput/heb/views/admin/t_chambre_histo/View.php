
	<?php
	/*
	* =======================================================================
	* FILE NAME:        View.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		stk_famille
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
  
 

	?>
	
	<div class="row">
            <div class="col-xs-12">
              <div class="box">
              
               <div class="box-header with-border">
               <h3 class="box-title" id="titledn">Détails vente du <?php echo dateAffiche($datedebut); ?> au <?php echo dateAffiche($datefin); ?></h3>
                <ul class="nav pull-right">
       <a  class="btn btn-default btn-xs tip" title="Filtrage détails vente" data-toggle="modal" data-target="#modalfiltrerdn"><i class="fa fa-sort"></i> Filtrer</a>
         <a  href="./main.php?pg=admin&view=impression&do=detailnuite&t=prod" target="_blank"  class="btn btn-default btn-xs tip prod" title="Imprimer la liste">
                            <i class="fa fa-print"></i> Imprimer
        </a>
        <a  href="./main.php?pg=admin&view=impression&do=detailnuite&t=serv" target="_blank"  class="btn btn-default btn-xs tip serv" title="Imprimer la liste" style="display:none;">
                            <i class="fa fa-print"></i> Imprimer
        </a>
		</ul>
	
	 </div><!-- /.box-header -->
   <div class="box-body">
         <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active onglet_chambre"><a href="#tab_1" data-toggle="tab" aria-expanded="true">CHAMBRES</a></li>
              <li class="onglet_service"><a href="#tab_2" data-toggle="tab" aria-expanded="false">SERVICES</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <?php
              include 'contentdatafiltered.php';
                ?>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                  <?php
              include 'contentdatafiltered2.php';
                ?>
              </div>
            </div>
            <!-- /.tab-content -->
          </div>
  </div><!-- /.box-body -->
  </div><!-- /.box -->
  </div><!-- /.col -->
  </div><!-- /.row -->
  <!-- Modal -->
<div class="modal fade" id="modalfiltrerdn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">

        <form class="form-inline" id="frmfilterdn">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Filtrage détails vente</h4>
                </div>
                <div class="modal-body text-center">
             <input name="onglet" id="onglet"  type="hidden" value="0"> 
                    <div class="form-group">
                        <label for="dte1">Du</label>
                        <input name="dte1" id="dte1"  type="text" value="<?php echo dateAffiche($datedebut); ?>" class="form-control datepicker2"> 
                    </div>
                    <div class="form-group">
                        <label for="dte2">au</label>
                        <input name="dte2" id="dte2"  type="text" value="<?php echo dateAffiche($datefin); ?>" class="form-control datepicker2">
                    </div>
                </div>
                <div class="modal-footer">
                    <button  class="btn btn-danger pull-right col-md-2" id="btn_filterdn">
                        <i class="fa fa-plus-circle fa-fw"></i>&nbsp;Valider
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </form>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->