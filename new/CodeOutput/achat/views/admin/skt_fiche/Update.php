
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Update.php
	* DATE CREATED:  	29-11-2018
	* FOR TABLE:  		skt_fiche
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	?>
	
	 
	 <form action="<?php echo H_ADMIN_MAIN.'&view=skt_fiche&do=updatepro';?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
	<div class="col-12">
	<ul class="nav pull-right" style="margin-top:5px;">
	  <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD;?>" />
	 	 
	  <a href="<?php echo H_ADMIN;?>&view=skt_fiche&id_fiche=<?php echo $rows->id_fiche;?>&do=details" title="View Details" class="btn btn-default btn-sm tip"><i class="fa fa-th-list"></i> <?php echo LANG_DETAILS;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=skt_fiche&id_fiche=<?php echo $rows->id_fiche;?>&do=delete&dfile=" title="<?php echo LANG_TIP_DELETE;?>" class="btn btn-default btn-sm tip" data-confirm="<?php echo LANG_DELETE_AUTH;?>"><i class="fa fa-trash-o"></i> <?php echo LANG_DELETE;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=skt_fiche&do=viewall" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL;?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK;?></a>
	</ul>
	<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i> <?php echo LANG_UPDATE;?> Skt Fiche</h3></div>
  <div class="panel-body">
	
	 <div class="output"></div>
	  
	<input type="hidden" name="id_fiche" value="<?php echo $rows->id_fiche;?>">
	<div class="form-group">
    <label class="control-label" for="numero">Numero</label>
	<input id="numero" name="numero" type="text" maxlength="50"  value="<?php echo $rows->numero;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="type">Type</label>
	<input id="type" name="type" type="text" maxlength="20"  value="<?php echo $rows->type;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="motif">Motif</label>
	<input id="motif" name="motif" type="text" maxlength="20"  value="<?php echo $rows->motif;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="beneficiere">Beneficiere</label>
	<input id="beneficiere" name="beneficiere" type="text" maxlength="200"  value="<?php echo $rows->beneficiere;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="nbrprod">Nbrprod</label>
	<input id="nbrprod" name="nbrprod" type="text" maxlength="10"  value="<?php echo $rows->nbrprod;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="dte">Dte</label>
	<input name="dte" class="datepicker form-control styler" type="text" maxlength="10" value="<?php echo $rows->dte;?>" />
	</div>

	<div class="form-group">
    <label class="control-label" for="dte_time">Dte Time</label>
	<input name="dte_time" class="datepicker form-control styler" type="text" maxlength="10" value="<?php echo $rows->dte_time;?>" />
	</div>

	<div class="form-group">
    <label class="control-label" for="approuve">Approuve</label>
	<input id="approuve" name="approuve" type="text" maxlength="10"  value="<?php echo $rows->approuve;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="depot_id">Depot Id</label>
	<input id="depot_id" name="depot_id" type="text" maxlength="11"  value="<?php echo $rows->depot_id;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="user_id">User Id</label>
	<input id="user_id" name="user_id" type="text" maxlength="11"  value="<?php echo $rows->user_id;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="hotel_id">Hotel Id</label>
	<input id="hotel_id" name="hotel_id" type="text" maxlength="11"  value="<?php echo $rows->hotel_id;?>" class="form-control styler" />
	</div>

	 <div class="output"></div>
	  </div>
	   <div class="panel-footer" style="border-bottom:solid 2px #CCC;"> 
     <label for="hButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD;?>" />
	 	 </div>
	 	 
	  
	
 </div><!--/col-12-->
	
	</form>
	 