
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Update.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_versement
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	?>
	
	 
	 <form action="<?php echo H_ADMIN_MAIN.'&view=t_versement&do=updatepro';?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
	<div class="col-12">
	<ul class="nav pull-right" style="margin-top:5px;">
	  <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD;?>" />
	 	 
	  <a href="<?php echo H_ADMIN;?>&view=t_versement&id=<?php echo $rows->id;?>&do=details" title="View Details" class="btn btn-default btn-sm tip"><i class="fa fa-th-list"></i> <?php echo LANG_DETAILS;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=t_versement&id=<?php echo $rows->id;?>&do=delete&dfile=" title="<?php echo LANG_TIP_DELETE;?>" class="btn btn-default btn-sm tip" data-confirm="<?php echo LANG_DELETE_AUTH;?>"><i class="fa fa-trash-o"></i> <?php echo LANG_DELETE;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=t_versement&do=viewall" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL;?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK;?></a>
	</ul>
	<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i> <?php echo LANG_UPDATE;?> T Versement</h3></div>
  <div class="panel-body">
	
	 <div class="output"></div>
	  
	<input type="hidden" name="id" value="<?php echo $rows->id;?>">
	<div class="form-group">
    <label class="control-label" for="user_vers">User Vers</label>
	<input id="user_vers" name="user_vers" type="text" maxlength="11"  value="<?php echo $rows->user_vers;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="date_vers">Date Vers</label>
	<input name="date_vers" class="datepicker form-control styler" type="text" maxlength="11" value="<?php echo $rows->date_vers;?>" />
	</div>

	<div class="form-group">
    <label class="control-label" for="montant_vers">Montant Vers</label>
	<input id="montant_vers" name="montant_vers" type="text" maxlength="11"  value="<?php echo $rows->montant_vers;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="montantusd">Montantusd</label>
	<input id="montantusd" name="montantusd" type="text" maxlength="11"  value="<?php echo $rows->montantusd;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="monaie_vers">Monaie Vers</label>
	<input id="monaie_vers" name="monaie_vers" type="text" maxlength="10"  value="<?php echo $rows->monaie_vers;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="taux">Taux</label>
	<input id="taux" name="taux" type="text" maxlength="10"  value="<?php echo $rows->taux;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="motif">Motif</label>
	<input id="motif" name="motif" type="text" maxlength="20"  value="<?php echo $rows->motif;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="type_vers">Type Vers</label>
	<input id="type_vers" name="type_vers" type="text" maxlength="50"  value="<?php echo $rows->type_vers;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="paie_id">Paie Id</label>
	<input id="paie_id" name="paie_id" type="text" maxlength="11"  value="<?php echo $rows->paie_id;?>" class="form-control styler" />
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
	 