
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Update.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_operation
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	?>
	
	 
	 <form action="<?php echo H_ADMIN_MAIN.'&view=t_operation&do=updatepro';?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
	<div class="col-12">
	<ul class="nav pull-right" style="margin-top:5px;">
	  <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD;?>" />
	 	 
	  <a href="<?php echo H_ADMIN;?>&view=t_operation&idoperation=<?php echo $rows->idoperation;?>&do=details" title="View Details" class="btn btn-default btn-sm tip"><i class="fa fa-th-list"></i> <?php echo LANG_DETAILS;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=t_operation&idoperation=<?php echo $rows->idoperation;?>&do=delete&dfile=" title="<?php echo LANG_TIP_DELETE;?>" class="btn btn-default btn-sm tip" data-confirm="<?php echo LANG_DELETE_AUTH;?>"><i class="fa fa-trash-o"></i> <?php echo LANG_DELETE;?></a>
	
	<a href="<?php echo H_ADMIN;?>&view=t_operation&do=viewall" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL;?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK;?></a>
	</ul>
	<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i> <?php echo LANG_UPDATE;?> T Operation</h3></div>
  <div class="panel-body">
	
	 <div class="output"></div>
	  
	<input type="hidden" name="idoperation" value="<?php echo $rows->idoperation;?>">
	<div class="form-group">
    <label class="control-label" for="type">Type</label>
	<input id="type" name="type" type="text" maxlength="20"  value="<?php echo $rows->type;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="libelle">Libelle</label>
	<textarea rows="5" id="libelle" name="libelle" class="form-control editor2 styler" /><?php echo $rows->libelle;?></textarea>
	</div>

	<div class="form-group">
    <label class="control-label" for="date_bon">Date Bon</label>
	<input name="date_bon" class="datepicker form-control styler" type="text" maxlength="20" value="<?php echo $rows->date_bon;?>" />
	</div>

	<div class="form-group">
    <label class="control-label" for="date_heure_bon">Date Heure Bon</label>
	<input name="date_heure_bon" class="datepicker form-control styler" type="text" maxlength="20" value="<?php echo $rows->date_heure_bon;?>" />
	</div>

	<div class="form-group">
    <label class="control-label" for="beneficiaire">Beneficiaire</label>
	<input id="beneficiaire" name="beneficiaire" type="text" maxlength="100"  value="<?php echo $rows->beneficiaire;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="provenance">Provenance</label>
	<input id="provenance" name="provenance" type="text" maxlength="100"  value="<?php echo $rows->provenance;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="montantFC">MontantFC</label>
	<input id="montantFC" name="montantFC" type="text" maxlength="100"  value="<?php echo $rows->montantFC;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="montantUSD">MontantUSD</label>
	<input id="montantUSD" name="montantUSD" type="text" maxlength="100"  value="<?php echo $rows->montantUSD;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="numBon">NumBon</label>
	<input id="numBon" name="numBon" type="text" maxlength="50"  value="<?php echo $rows->numBon;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="indice_be">Indice Be</label>
	<input id="indice_be" name="indice_be" type="text" maxlength="11"  value="<?php echo $rows->indice_be;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="indice_bs">Indice Bs</label>
	<input id="indice_bs" name="indice_bs" type="text" maxlength="11"  value="<?php echo $rows->indice_bs;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="numBordereau">NumBordereau</label>
	<input id="numBordereau" name="numBordereau" type="text" maxlength="10"  value="<?php echo $rows->numBordereau;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="mode_operation">Mode Operation</label>
	<input id="mode_operation" name="mode_operation" type="text" maxlength="10"  value="<?php echo $rows->mode_operation;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="session_id">Session Id</label>
	<input id="session_id" name="session_id" type="text" maxlength="10"  value="<?php echo $rows->session_id;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="motif_id">Motif Id</label>
	<input id="motif_id" name="motif_id" type="text" maxlength="10"  value="<?php echo $rows->motif_id;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="user_vers">User Vers</label>
	<input id="user_vers" name="user_vers" type="text" maxlength="11"  value="<?php echo $rows->user_vers;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="user_id">User Id</label>
	<input id="user_id" name="user_id" type="text" maxlength="11"  value="<?php echo $rows->user_id;?>" class="form-control styler" />
	</div>

	<div class="form-group">
    <label class="control-label" for="hotel_id">Hotel Id</label>
	<input id="hotel_id" name="hotel_id" type="text" maxlength="10"  value="<?php echo $rows->hotel_id;?>" class="form-control styler" />
	</div>

	 <div class="output"></div>
	  </div>
	   <div class="panel-footer" style="border-bottom:solid 2px #CCC;"> 
     <label for="hButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_UPDATE_RECORD;?></label>
	 <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD;?>" />
	 	 </div>
	 	 
	  
	
 </div><!--/col-12-->
	
	</form>
	 