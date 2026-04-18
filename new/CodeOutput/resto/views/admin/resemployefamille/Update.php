
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Update.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		resemployefamille
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	?>
	
	 
	 <form action="<?php echo H_ADMIN_MAIN.'&view=resemployefamille&do=updatepro';?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
	<div class="col-12">
	<ul class="nav pull-right" style="margin-top:5px;">
	  <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD;?>" />
	 	 
	  <a href="<?php echo H_ADMIN;?>&view=resemployefamille&id=<?php echo $rows->id;?>&do=details" title="View Details" class="btn btn-default btn-sm tip"><i class="fa fa-th-list"></i> <?php echo LANG_DETAILS;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=resemployefamille&id=<?php echo $rows->id;?>&do=delete&dfile=<?php echo $rows->image;?>" title="<?php echo LANG_TIP_DELETE;?>" class="btn btn-default btn-sm tip" data-confirm="<?php echo LANG_DELETE_AUTH;?>"><i class="fa fa-trash-o"></i> <?php echo LANG_DELETE;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=resemployefamille&do=viewall" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL;?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK;?></a>
	</ul>
	<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i> <?php echo LANG_UPDATE;?> Resemployefamille</h3></div>
  <div class="panel-body">
	
	 <div class="output"></div>
	  
	<input type="hidden" name="id" value="<?php echo $rows->id;?>">
	<div class="form-group">
    <label class="control-label" for="nom">Nom</label>
	<input id="nom" name="nom" type="text" maxlength="245"  value="<?php echo $rows->nom;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="datenais">Datenais</label>
	<input name="datenais" class="datepicker form-control styler" type="text" maxlength="245" value="<?php echo $rows->datenais;?>" />
	</div>

	<div class="form-group">
    <label class="control-label" for="type">Type</label>
	<input id="type" name="type" type="text" maxlength="20"  value="<?php echo $rows->type;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="image">Image</label>
	<input id="image" name="image"type="file" class="styler"/><br><?php if(is_file(UPLOAD_FOLDER.$rows->image)){?><a href="#"><img src="<?php echo THUMB_FOLDER.$rows->image;?>"></a><br><?php }?>
	<?php if(is_file(UPLOAD_FOLDER.$rows->image)){?>
	<a href="<?php echo H_ADMIN;?>&view=resemployefamille&id=<?php echo $rows->id;?>&dfile=<?php echo $rows->image;?>&do=delete&fdel=file" data-confirm="<?php echo LANG_DELETE_AUTH;?>"><span class="btn btn-xs btn-danger"><i class="fa fa-remove"></i> <?php echo LANG_DELETE;?></span></a><br><?php }?>
	
	</div>

	<div class="form-group">
    <label class="control-label" for="employe_id">Employe Id</label>
	<input id="employe_id" name="employe_id" type="text" maxlength="11"  value="<?php echo $rows->employe_id;?>" class="form-control styler" />
	</div>

	 <div class="output"></div>
	  </div>
	   <div class="panel-footer" style="border-bottom:solid 2px #CCC;"> 
     <label for="hButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD;?>" />
	 	 </div>
	 	 
	  
	
 </div><!--/col-12-->
	
	</form>
	 