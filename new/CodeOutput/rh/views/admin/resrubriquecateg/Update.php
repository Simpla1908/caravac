
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Update.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		resrubriquecateg
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	?>
	
	 
	 <form action="<?php echo H_ADMIN_MAIN.'&view=resrubriquecateg&do=updatepro';?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
	<div class="col-12">
	<ul class="nav pull-right" style="margin-top:5px;">
	  <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD;?>" />
	 	 
	  <a href="<?php echo H_ADMIN;?>&view=resrubriquecateg&id=<?php echo $rows->id;?>&do=details" title="View Details" class="btn btn-default btn-sm tip"><i class="fa fa-th-list"></i> <?php echo LANG_DETAILS;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=resrubriquecateg&id=<?php echo $rows->id;?>&do=delete&dfile=" title="<?php echo LANG_TIP_DELETE;?>" class="btn btn-default btn-sm tip" data-confirm="<?php echo LANG_DELETE_AUTH;?>"><i class="fa fa-trash-o"></i> <?php echo LANG_DELETE;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=resrubriquecateg&do=viewall" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL;?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK;?></a>
	</ul>
	<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i> <?php echo LANG_UPDATE;?> Resrubriquecateg</h3></div>
  <div class="panel-body">
	
	 <div class="output"></div>
	  
	<input type="hidden" name="id" value="<?php echo $rows->id;?>">
	<div class="form-group">
    <label class="control-label" for="rubrique_id">Rubrique Id</label>
	<input id="rubrique_id" name="rubrique_id" type="text" maxlength="10"  value="<?php echo $rows->rubrique_id;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="categorie_id">Categorie Id</label>
	<input id="categorie_id" name="categorie_id" type="text" maxlength="10"  value="<?php echo $rows->categorie_id;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="salbase">Salbase</label>
	<input id="salbase" name="salbase" type="text" maxlength="11"  value="<?php echo $rows->salbase;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="nbrenf">Nbrenf</label>
	<input id="nbrenf" name="nbrenf" type="text" maxlength="11"  value="<?php echo $rows->nbrenf;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="salbrut">Salbrut</label>
	<input id="salbrut" name="salbrut" type="text" maxlength="11"  value="<?php echo $rows->salbrut;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="manuel">Manuel</label>
	<input id="manuel" name="manuel" type="text" maxlength="11"  value="<?php echo $rows->manuel;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="pourcentage">Pourcentage</label>
	<input id="pourcentage" name="pourcentage" type="text" maxlength="11"  value="<?php echo $rows->pourcentage;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="imposable">Imposable</label>
	<input id="imposable" name="imposable" type="text" maxlength="11"  value="<?php echo $rows->imposable;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="valeur">Valeur</label>
	<input id="valeur" name="valeur" type="text" maxlength="11"  value="<?php echo $rows->valeur;?>" class="form-control styler" />
	</div>

	 <div class="output"></div>
	  </div>
	   <div class="panel-footer" style="border-bottom:solid 2px #CCC;"> 
     <label for="hButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD;?>" />
	 	 </div>
	 	 
	  
	
 </div><!--/col-12-->
	
	</form>
	 