
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Update.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_modulecompany
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	?>
	
	 
	 <form action="<?php echo H_ADMIN_MAIN.'&view=t_modulecompany&do=updatepro';?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
	<div class="col-12">
	<ul class="nav pull-right" style="margin-top:5px;">
	  <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD;?>" />
	 	 
	  <a href="<?php echo H_ADMIN;?>&view=t_modulecompany&id=<?php echo $rows->id;?>&do=details" title="View Details" class="btn btn-default btn-sm tip"><i class="fa fa-th-list"></i> <?php echo LANG_DETAILS;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=t_modulecompany&id=<?php echo $rows->id;?>&do=delete&dfile=" title="<?php echo LANG_TIP_DELETE;?>" class="btn btn-default btn-sm tip" data-confirm="<?php echo LANG_DELETE_AUTH;?>"><i class="fa fa-trash-o"></i> <?php echo LANG_DELETE;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=t_modulecompany&do=viewall" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL;?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK;?></a>
	</ul>
	<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i> <?php echo LANG_UPDATE;?> T Modulecompany</h3></div>
  <div class="panel-body">
	
	 <div class="output"></div>
	  
	<input type="hidden" name="id" value="<?php echo $rows->id;?>">
	<div class="form-group">
    <label class="control-label" for="nbreuser">Nbreuser</label>
	<input id="nbreuser" name="nbreuser" type="text" maxlength="11"  value="<?php echo $rows->nbreuser;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="nbre_user_maj">Nbre User Maj</label>
	<input id="nbre_user_maj" name="nbre_user_maj" type="text" maxlength="11"  value="<?php echo $rows->nbre_user_maj;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="etat_module">Etat Module</label>
	<input id="etat_module" name="etat_module" type="text" maxlength="11"  value="<?php echo $rows->etat_module;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="paye">Paye</label>
	<input id="paye" name="paye" type="text" maxlength="11"  value="<?php echo $rows->paye;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="montantmodule">Montantmodule</label>
	<input id="montantmodule" name="montantmodule" type="text" maxlength="11"  value="<?php echo $rows->montantmodule;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="prix_id">Prix Id</label>
	<input id="prix_id" name="prix_id" type="text" maxlength="11"  value="<?php echo $rows->prix_id;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="pack_id">Pack Id</label>
	<input id="pack_id" name="pack_id" type="text" maxlength="11"  value="<?php echo $rows->pack_id;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="company_id">Company Id</label>
	<input id="company_id" name="company_id" type="text" maxlength="11"  value="<?php echo $rows->company_id;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="module_id">Module Id</label>
	<input id="module_id" name="module_id" type="text" maxlength="11"  value="<?php echo $rows->module_id;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="souscription_id">Souscription Id</label>
	<input id="souscription_id" name="souscription_id" type="text" maxlength="11"  value="<?php echo $rows->souscription_id;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="date_sous">Date Sous</label>
	<input name="date_sous" class="datepicker form-control styler" type="text" maxlength="11" value="<?php echo $rows->date_sous;?>" />
	</div>

	<div class="form-group">
    <label class="control-label" for="date_activ">Date Activ</label>
	<input name="date_activ" class="datepicker form-control styler" type="text" maxlength="11" value="<?php echo $rows->date_activ;?>" />
	</div>

	<div class="form-group">
    <label class="control-label" for="date_echeance">Date Echeance</label>
	<input name="date_echeance" class="datepicker form-control styler" type="text" maxlength="11" value="<?php echo $rows->date_echeance;?>" />
	</div>

	<div class="form-group">
    <label class="control-label" for="dte_blocage">Dte Blocage</label>
	<input name="dte_blocage" class="datepicker form-control styler" type="text" maxlength="11" value="<?php echo $rows->dte_blocage;?>" />
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
	 