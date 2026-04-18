
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Update.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_hotel
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	?>
	
	 
	 <form action="<?php echo H_ADMIN_MAIN.'&view=t_hotel&do=updatepro';?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
	<div class="col-12">
	<ul class="nav pull-right" style="margin-top:5px;">
	  <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD;?>" />
	 	 
	  <a href="<?php echo H_ADMIN;?>&view=t_hotel&id_hotel=<?php echo $rows->id_hotel;?>&do=details" title="View Details" class="btn btn-default btn-sm tip"><i class="fa fa-th-list"></i> <?php echo LANG_DETAILS;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=t_hotel&id_hotel=<?php echo $rows->id_hotel;?>&do=delete&dfile=" title="<?php echo LANG_TIP_DELETE;?>" class="btn btn-default btn-sm tip" data-confirm="<?php echo LANG_DELETE_AUTH;?>"><i class="fa fa-trash-o"></i> <?php echo LANG_DELETE;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=t_hotel&do=viewall" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL;?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK;?></a>
	</ul>
	<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i> <?php echo LANG_UPDATE;?> T Hotel</h3></div>
  <div class="panel-body">
	
	 <div class="output"></div>
	  
	<input type="hidden" name="id_hotel" value="<?php echo $rows->id_hotel;?>">
	<div class="form-group">
    <label class="control-label" for="nom_hotel">Nom Hotel</label>
	<input id="nom_hotel" name="nom_hotel" type="text" maxlength="50"  value="<?php echo $rows->nom_hotel;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="adresse_hotel">Adresse Hotel</label>
	<textarea rows="5" id="adresse_hotel" name="adresse_hotel" class="form-control editor2 styler" /><?php echo $rows->adresse_hotel;?></textarea>
	</div>

	<div class="form-group">
    <label class="control-label" for="province_hotel">Province Hotel</label>
	<input id="province_hotel" name="province_hotel" type="text" maxlength="20"  value="<?php echo $rows->province_hotel;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="ville_hotel">Ville Hotel</label>
	<input id="ville_hotel" name="ville_hotel" type="text" maxlength="20"  value="<?php echo $rows->ville_hotel;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="etat">Etat</label>
	<input id="etat" name="etat" type="text" maxlength="11"  value="<?php echo $rows->etat;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="default_site">Default Site</label>
	<input id="default_site" name="default_site" type="text" maxlength="11"  value="<?php echo $rows->default_site;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="company_id">Company Id</label>
	<input id="company_id" name="company_id" type="text" maxlength="11"  value="<?php echo $rows->company_id;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="statut_site">Statut Site</label>
	<input id="statut_site" name="statut_site" type="text" maxlength="20"  value="<?php echo $rows->statut_site;?>" class="form-control styler" />
	</div>

	 <div class="output"></div>
	  </div>
	   <div class="panel-footer" style="border-bottom:solid 2px #CCC;"> 
     <label for="hButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD;?>" />
	 	 </div>
	 	 
	  
	
 </div><!--/col-12-->
	
	</form>
	 