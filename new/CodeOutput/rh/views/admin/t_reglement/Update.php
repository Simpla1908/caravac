
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Update.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_reglement
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	?>
	
	 
	 <form action="<?php echo H_ADMIN_MAIN.'&view=t_reglement&do=updatepro';?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
	<div class="col-12">
	<ul class="nav pull-right" style="margin-top:5px;">
	  <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD;?>" />
	 	 
	  <a href="<?php echo H_ADMIN;?>&view=t_reglement&id_regl=<?php echo $rows->id_regl;?>&do=details" title="View Details" class="btn btn-default btn-sm tip"><i class="fa fa-th-list"></i> <?php echo LANG_DETAILS;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=t_reglement&id_regl=<?php echo $rows->id_regl;?>&do=delete&dfile=" title="<?php echo LANG_TIP_DELETE;?>" class="btn btn-default btn-sm tip" data-confirm="<?php echo LANG_DELETE_AUTH;?>"><i class="fa fa-trash-o"></i> <?php echo LANG_DELETE;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=t_reglement&do=viewall" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL;?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK;?></a>
	</ul>
	<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i> <?php echo LANG_UPDATE;?> T Reglement</h3></div>
  <div class="panel-body">
	
	 <div class="output"></div>
	  
	<input type="hidden" name="id_regl" value="<?php echo $rows->id_regl;?>">
	<div class="form-group">
    <label class="control-label" for="numero">Numero</label>
	<input id="numero" name="numero" type="text" maxlength="20"  value="<?php echo $rows->numero;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="montant_dollar">Montant Dollar</label>
	<input id="montant_dollar" name="montant_dollar" type="text" maxlength="20"  value="<?php echo $rows->montant_dollar;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="montant_fc">Montant Fc</label>
	<input id="montant_fc" name="montant_fc" type="text" maxlength="20"  value="<?php echo $rows->montant_fc;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="reste">Reste</label>
	<input id="reste" name="reste" type="text" maxlength="20"  value="<?php echo $rows->reste;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="id_mode_regl">Id Mode Regl</label>
	<input id="id_mode_regl" name="id_mode_regl" type="text" maxlength="11"  value="<?php echo $rows->id_mode_regl;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="date_regl">Date Regl</label>
	<input name="date_regl" class="datepicker form-control styler" type="text" maxlength="11" value="<?php echo $rows->date_regl;?>" />
	</div>

	<div class="form-group">
    <label class="control-label" for="dte">Dte</label>
	<input name="dte" class="datepicker form-control styler" type="text" maxlength="11" value="<?php echo $rows->dte;?>" />
	</div>

	<div class="form-group">
    <label class="control-label" for="rejete">Rejete</label>
	<input id="rejete" name="rejete" type="text" maxlength="11"  value="<?php echo $rows->rejete;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="id_fact">Id Fact</label>
	<input id="id_fact" name="id_fact" type="text" maxlength="11"  value="<?php echo $rows->id_fact;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="id_monnaie">Id Monnaie</label>
	<input id="id_monnaie" name="id_monnaie" type="text" maxlength="11"  value="<?php echo $rows->id_monnaie;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="id_user">Id User</label>
	<input id="id_user" name="id_user" type="text" maxlength="11"  value="<?php echo $rows->id_user;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="id_hotel">Id Hotel</label>
	<input id="id_hotel" name="id_hotel" type="text" maxlength="11"  value="<?php echo $rows->id_hotel;?>" class="form-control styler" />
	</div>

	 <div class="output"></div>
	  </div>
	   <div class="panel-footer" style="border-bottom:solid 2px #CCC;"> 
     <label for="hButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD;?>" />
	 	 </div>
	 	 
	  
	
 </div><!--/col-12-->
	
	</form>
	 