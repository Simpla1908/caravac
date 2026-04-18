
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Add.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_annule_reservation
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	?>
	
	 
	 <form action="<?php echo H_ADMIN_MAIN.'&view=t_annule_reservation&do=addpro';?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
	<div class="col-12">
	<ul class="nav pull-right" style="margin-top:5px;">
	  <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_CREATE_RECORD;?>" />
	 	 
	  <a href="<?php echo H_ADMIN;?>&view=t_annule_reservation&do=viewall" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL;?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK;?></a>
	</ul>
	<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i> <?php echo LANG_CREATE_NEW;?> T Annule Reservation</h3></div>
  <div class="panel-body">
	
	 <div class="output"></div>
	  
	<div class="form-group">
    <label class="control-label" for="id_res">Id Res</label>
	<input id="id_res" name="id_res" type="text" maxlength="11"  value="" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="id_ch">Id Ch</label>
	<input id="id_ch" name="id_ch" type="text" maxlength="11"  value="" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="id_user">Id User</label>
	<input id="id_user" name="id_user" type="text" maxlength="11"  value="" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="id_regl">Id Regl</label>
	<input id="id_regl" name="id_regl" type="text" maxlength="10"  value="" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="Montant_retirer">Montant Retirer</label>
	<input id="Montant_retirer" name="Montant_retirer" type="text" maxlength="15"  value="" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="monnaie">Monnaie</label>
	<input id="monnaie" name="monnaie" type="text" maxlength="10"  value="" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="poucentage">Poucentage</label>
	<input id="poucentage" name="poucentage" type="text" maxlength="10"  value="" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="mont_remb">Mont Remb</label>
	<input id="mont_remb" name="mont_remb" type="text" maxlength="12"  value="" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="date_annule_res">Date Annule Res</label>
	<input name="date_annule_res" class="datepicker form-control styler" type="text" maxlength="12" value="<?php echo date('Y-m-d');?>" />
	</div>

	<div class="form-group">
    <label class="control-label" for="date_annule">Date Annule</label>
	<input name="date_annule" class="datepicker form-control styler" type="text" maxlength="12" value="<?php echo date('Y-m-d');?>" />
	</div>

	 <div class="output"></div>
	  </div>
	   <div class="panel-footer" style="border-bottom:solid 2px #CCC;"> 
     <label for="hButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_CREATE_RECORD;?>" />
	 	 </div>
	 	 
	  
	
 </div><!--/col-12-->
	
	</form>
	 