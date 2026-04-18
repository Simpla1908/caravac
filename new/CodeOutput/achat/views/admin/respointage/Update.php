
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Update.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		respointage
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	?>
	
	 
	 <form action="<?php echo H_ADMIN_MAIN.'&view=respointage&do=updatepro';?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
	<div class="col-12">
	<ul class="nav pull-right" style="margin-top:5px;">
	  <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD;?>" />
	 	 
	  <a href="<?php echo H_ADMIN;?>&view=respointage&id=<?php echo $rows->id;?>&do=details" title="View Details" class="btn btn-default btn-sm tip"><i class="fa fa-th-list"></i> <?php echo LANG_DETAILS;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=respointage&id=<?php echo $rows->id;?>&do=delete&dfile=" title="<?php echo LANG_TIP_DELETE;?>" class="btn btn-default btn-sm tip" data-confirm="<?php echo LANG_DELETE_AUTH;?>"><i class="fa fa-trash-o"></i> <?php echo LANG_DELETE;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=respointage&do=viewall" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL;?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK;?></a>
	</ul>
	<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i> <?php echo LANG_UPDATE;?> Respointage</h3></div>
  <div class="panel-body">
	
	 <div class="output"></div>
	  
	<input type="hidden" name="id" value="<?php echo $rows->id;?>">
	<div class="form-group">
    <label class="control-label" for="employe_id">Employe Id</label>
	<input id="employe_id" name="employe_id" type="text" maxlength="11"  value="<?php echo $rows->employe_id;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="dte_in">Dte In</label>
	<input name="dte_in" class="datepicker form-control styler" type="text" maxlength="11" value="<?php echo $rows->dte_in;?>" />
	</div>

	<div class="form-group">
    <label class="control-label" for="dte_out">Dte Out</label>
	<input name="dte_out" class="datepicker form-control styler" type="text" maxlength="11" value="<?php echo $rows->dte_out;?>" />
	</div>

	<div class="form-group">
    <label class="control-label" for="hr_in">Hr In</label>
	<input id="hr_in" name="hr_in" type="text" maxlength="11"  value="<?php echo $rows->hr_in;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="hr_out">Hr Out</label>
	<input id="hr_out" name="hr_out" type="text" maxlength="11"  value="<?php echo $rows->hr_out;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="motif">Motif</label>
	<input id="motif" name="motif" type="text" maxlength="20"  value="<?php echo $rows->motif;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="justification">Justification</label>
	<input id="justification" name="justification" type="text" maxlength="245"  value="<?php echo $rows->justification;?>" class="form-control styler" />
	</div>

	 <div class="output"></div>
	  </div>
	   <div class="panel-footer" style="border-bottom:solid 2px #CCC;"> 
     <label for="hButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD;?>" />
	 	 </div>
	 	 
	  
	
 </div><!--/col-12-->
	
	</form>
	 