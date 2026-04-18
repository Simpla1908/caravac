
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Update.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_responsable
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	?>
	
	 
	 <form action="<?php echo H_ADMIN_MAIN.'&view=t_responsable&do=updatepro';?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
	<div class="col-12">
	<ul class="nav pull-right" style="margin-top:5px;">
	  <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD;?>" />
	 	 
	  <a href="<?php echo H_ADMIN;?>&view=t_responsable&id_respo=<?php echo $rows->id_respo;?>&do=details" title="View Details" class="btn btn-default btn-sm tip"><i class="fa fa-th-list"></i> <?php echo LANG_DETAILS;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=t_responsable&id_respo=<?php echo $rows->id_respo;?>&do=delete&dfile=" title="<?php echo LANG_TIP_DELETE;?>" class="btn btn-default btn-sm tip" data-confirm="<?php echo LANG_DELETE_AUTH;?>"><i class="fa fa-trash-o"></i> <?php echo LANG_DELETE;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=t_responsable&do=viewall" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL;?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK;?></a>
	</ul>
	<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i> <?php echo LANG_UPDATE;?> T Responsable</h3></div>
  <div class="panel-body">
	
	 <div class="output"></div>
	  
	<input type="hidden" name="id_respo" value="<?php echo $rows->id_respo;?>">
	<div class="form-group">
    <label class="control-label" for="nom_respo">Nom Respo</label>
	<input id="nom_respo" name="nom_respo" type="text" maxlength="30"  value="<?php echo $rows->nom_respo;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="telephone_respo">Telephone Respo</label>
	<input id="telephone_respo" name="telephone_respo" type="text" maxlength="20"  value="<?php echo $rows->telephone_respo;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="adresse_respo">Adresse Respo</label>
	<input id="adresse_respo" name="adresse_respo" type="text" maxlength="100"  value="<?php echo $rows->adresse_respo;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="entreprise">Entreprise</label>
	<input id="entreprise" name="entreprise" type="text" maxlength="50"  value="<?php echo $rows->entreprise;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="filtre">Filtre</label>
	<input id="filtre" name="filtre" type="text" maxlength="11"  value="<?php echo $rows->filtre;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="company_id">Company Id</label>
	<input id="company_id" name="company_id" type="text" maxlength="11"  value="<?php echo $rows->company_id;?>" class="form-control styler" />
	</div>

	 <div class="output"></div>
	  </div>
	   <div class="panel-footer" style="border-bottom:solid 2px #CCC;"> 
     <label for="hButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD;?>" />
	 	 </div>
	 	 
	  
	
 </div><!--/col-12-->
	
	</form>
	 