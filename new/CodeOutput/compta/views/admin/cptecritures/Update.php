
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Update.php
	* DATE CREATED:  	18-04-2019
	* FOR TABLE:  		cptecritures
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	?>
	
	 
	 <form action="<?php echo H_ADMIN_MAIN.'&view=cptecritures&do=updatepro';?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
	<div class="col-12">
	<ul class="nav pull-right" style="margin-top:5px;">
	  <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD;?>" />
	 	 
	  <a href="<?php echo H_ADMIN;?>&view=cptecritures&id=<?php echo $rows->id;?>&do=details" title="View Details" class="btn btn-default btn-sm tip"><i class="fa fa-th-list"></i> <?php echo LANG_DETAILS;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=cptecritures&id=<?php echo $rows->id;?>&do=delete&dfile=" title="<?php echo LANG_TIP_DELETE;?>" class="btn btn-default btn-sm tip" data-confirm="<?php echo LANG_DELETE_AUTH;?>"><i class="fa fa-trash-o"></i> <?php echo LANG_DELETE;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=cptecritures&do=viewall" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL;?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK;?></a>
	</ul>
	<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i> <?php echo LANG_UPDATE;?> Cptecritures</h3></div>
  <div class="panel-body">
	
	 <div class="output"></div>
	  
	<input type="hidden" name="id" value="<?php echo $rows->id;?>">
	<div class="form-group">
    <label class="control-label" for="dte">Dte</label>
	<input name="dte" class="datepicker form-control styler" type="text" maxlength="11" value="<?php echo $rows->dte;?>" />
	</div>

	<div class="form-group">
    <label class="control-label" for="dtetime">Dtetime</label>
	<input name="dtetime" class="datepicker form-control styler" type="text" maxlength="11" value="<?php echo $rows->dtetime;?>" />
	</div>

	<div class="form-group">
    <label class="control-label" for="libelle">Libelle</label>
	<input id="libelle" name="libelle" type="text" maxlength="245"  value="<?php echo $rows->libelle;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="journal_id">Journal Id</label>
	<input id="journal_id" name="journal_id" type="text" maxlength="11"  value="<?php echo $rows->journal_id;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="psedo">Psedo</label>
	<input id="psedo" name="psedo" type="text" maxlength="11"  value="<?php echo $rows->psedo;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="user_id">User Id</label>
	<input id="user_id" name="user_id" type="text" maxlength="11"  value="<?php echo $rows->user_id;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="site_id">Site Id</label>
	<input id="site_id" name="site_id" type="text" maxlength="11"  value="<?php echo $rows->site_id;?>" class="form-control styler" />
	</div>

	 <div class="output"></div>
	  </div>
	   <div class="panel-footer" style="border-bottom:solid 2px #CCC;"> 
     <label for="hButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD;?>" />
	 	 </div>
	 	 
	  
	
 </div><!--/col-12-->
	
	</form>
	 