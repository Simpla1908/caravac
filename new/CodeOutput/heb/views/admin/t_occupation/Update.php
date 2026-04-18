
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Update.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_occupation
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	?>
	
	 
	 <form action="<?php echo H_ADMIN_MAIN.'&view=t_occupation&do=updatepro';?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
	<div class="col-12">
	<ul class="nav pull-right" style="margin-top:5px;">
	  <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD;?>" />
	 	 
	  <a href="<?php echo H_ADMIN;?>&view=t_occupation&id_occ=<?php echo $rows->id_occ;?>&do=details" title="View Details" class="btn btn-default btn-sm tip"><i class="fa fa-th-list"></i> <?php echo LANG_DETAILS;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=t_occupation&id_occ=<?php echo $rows->id_occ;?>&do=delete&dfile=" title="<?php echo LANG_TIP_DELETE;?>" class="btn btn-default btn-sm tip" data-confirm="<?php echo LANG_DELETE_AUTH;?>"><i class="fa fa-trash-o"></i> <?php echo LANG_DELETE;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=t_occupation&do=viewall" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL;?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK;?></a>
	</ul>
	<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i> <?php echo LANG_UPDATE;?> T Occupation</h3></div>
  <div class="panel-body">
	
	 <div class="output"></div>
	  
	<input type="hidden" name="id_occ" value="<?php echo $rows->id_occ;?>">
	<div class="form-group">
    <label class="control-label" for="type_occ">Type Occ</label>
	<input id="type_occ" name="type_occ" type="text" maxlength="20"  value="<?php echo $rows->type_occ;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="date_occ">Date Occ</label>
	<input name="date_occ" class="datepicker form-control styler" type="text" maxlength="20" value="<?php echo $rows->date_occ;?>" />
	</div>

	<div class="form-group">
    <label class="control-label" for="heure_occ">Heure Occ</label>
	<input id="heure_occ" name="heure_occ" type="text" maxlength="20"  value="<?php echo $rows->heure_occ;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="id_ch">Id Ch</label>
	<input id="id_ch" name="id_ch" type="text" maxlength="10"  value="<?php echo $rows->id_ch;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="id_client">Id Client</label>
	<input id="id_client" name="id_client" type="text" maxlength="10"  value="<?php echo $rows->id_client;?>" class="form-control styler" />
	</div>

	 <div class="output"></div>
	  </div>
	   <div class="panel-footer" style="border-bottom:solid 2px #CCC;"> 
     <label for="hButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD;?>" />
	 	 </div>
	 	 
	  
	
 </div><!--/col-12-->
	
	</form>
	 