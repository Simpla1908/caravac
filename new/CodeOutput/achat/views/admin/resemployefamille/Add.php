
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Add.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		resemployefamille
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	?>
	
	 
	 <form action="<?php echo H_ADMIN_MAIN.'&view=resemployefamille&do=addpro';?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
	<div class="col-12">
	<ul class="nav pull-right" style="margin-top:5px;">
	  <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_CREATE_RECORD;?>" />
	 	 
	  <a href="<?php echo H_ADMIN;?>&view=resemployefamille&do=viewall" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL;?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK;?></a>
	</ul>
	<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i> <?php echo LANG_CREATE_NEW;?> Resemployefamille</h3></div>
  <div class="panel-body">
	
	 <div class="output"></div>
	  
	<div class="form-group">
    <label class="control-label" for="nom">Nom</label>
	<input id="nom" name="nom" type="text" maxlength="245"  value="" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="datenais">Datenais</label>
	<input name="datenais" class="datepicker form-control styler" type="text" maxlength="245" value="<?php echo date('Y-m-d');?>" />
	</div>

	<div class="form-group">
    <label class="control-label" for="type">Type</label>
	<input id="type" name="type" type="text" maxlength="20"  value="" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="image">Image</label>
	
	<input id="image" name="image"type="file" class="form-control styler"/>
	
	</div>

	<div class="form-group">
    <label class="control-label" for="employe_id">Employe Id</label>
	<input id="employe_id" name="employe_id" type="text" maxlength="11"  value="" class="form-control styler" />
	</div>

	 <div class="output"></div>
	  </div>
	   <div class="panel-footer" style="border-bottom:solid 2px #CCC;"> 
     <label for="hButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_CREATE_RECORD;?>" />
	 	 </div>
	 	 
	  
	
 </div><!--/col-12-->
	
	</form>
	 